<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Http\Controllers\Custom\TeleCustomController;
use App\Models\PasswordReset;
use App\Models\SiteData;
use App\Models\SiteCon;
use App\Models\DataHistory;
use App\Models\HistoryLogin;
use App\Models\User;
use App\Models\LogRef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailForgotPassword;
use App\Models\LinkClick;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;

class AuthClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('xss');
    }

    public function LoginPage()
    {
        return view('Auth.login');
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }
    public function RegisterPageWithReferral($referral_code)
    {
        $referrer = User::where('referral_code', $referral_code)->first();

        if ($referrer) {
            // Cập nhật lượt truy cập cho người giới thiệu
            $referrer->clicks_count += 1;
            $referrer->save();

            // Hoặc lưu vào bảng link_clicks
            LinkClick::create([
                'user_id' => $referrer->id,
                'referral_code' => $referral_code,
            ]);

            // Lưu mã giới thiệu vào session
            Session::put('ref', $referrer->username);
        } else {
            // Nếu không tìm thấy người giới thiệu, xóa session ref
            Session::forget('ref');
        }

        // Chuyển hướng đến trang đăng ký
        return redirect()->route('register');
    }


    public function ForgotPasswordPage()
    {
        return view('Auth.forgot-password');
    }

    public function LoginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function LoginGoogleCallback(Request $requsest)
    {
        $user = Socialite::driver('google')->user();
        $check = User::where('email', $user->email)->where('domain', getDomain())->first();
        if ($check) {
            Auth::login($check);
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'username' => $user->id,
                'email' => strtolower($user->email),
                'password' => Hash::make(Str::random(8)),
                'balance' => 0,
                'type_balance' => 'VND',
                'lang' => 'vi',
                'total_recharge' => 0,
                'total_deduct' => 0,
                'referral_money' => 0,
                'position' => 'user',
                'avatar' => $user->avatar,
                'api_token' => encrypt($user->email . '|', $user->name . '|' . Str::random(32)),
                'domain' => getDomain(),
            ]);

            if ($newUser) {
                if (Auth::attempt(['email' => $user->email, 'password' => $user->password], true)) {
                    HistoryLogin::create([
                        'username' => $user->id,
                        'action' => 'Đăng nhập google',
                        'data' => 0,
                        'old_data' => 0,
                        'new_data' => 0,
                        'ip' => $request->ip(),
                        'description' => "Thực hiện đăng nhập tài khoản bằng phương thức google địa chỉ ip " . $request->ip(),
                        'dangnhap' => "Đăng nhập tài khoản bằng phương thức google địa chỉ ip " . $request->ip(),
                        'data_json' => '',
                        'domain' => getDomain(),
                    ]);
                    return redirect()->route('home')->with('success', 'Đăng nhập thành công');
                } else {
                    return redirect()->back()->with('error', 'Đăng nhập thất bại');
                }
            } else {
                return redirect()->back()->with('error', 'Đăng kí thất bại');
            }
        }
    }

    public function ForgotPassword(Request $request)
{
    // Validate the email input
    $valid = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
    ]);

    // Return validation errors as JSON if validation fails
    if ($valid->fails()) {
        return response()->json([
            'message' => 'Dữ liệu không hợp lệ',
            'errors' => $valid->errors()
        ], 422); // Unprocessable Entity
    }

    // Find the user by email and domain
    $user = User::where('email', $request->email)
                ->where('domain', getDomain())
                ->first();

    // If user exists
    if ($user) {
        // Generate a password reset token
        $token = Str::random(60);
        $token = Hash::make($token); // Mã hóa token để tăng cường bảo mật

        // Create or update password reset request
        PasswordReset::updateOrCreate(
            ['email' => $request->email, 'domain' => getDomain()],
            ['token' => $token]
        );

        // Send the password reset email
        Mail::to($request->email)->send(new MailForgotPassword(route('reset.password', $token)));

        // Return success response
        return response()->json([
            'message' => 'Vui lòng kiểm tra email để lấy lại mật khẩu'
        ], 200); // OK
    }

    // Return generic message to avoid revealing whether the email exists
    return response()->json([
        'message' => 'Khôi phục thành công. Vui lòng kiểm tra Email'
    ], 200); // OK, không tiết lộ thông tin người dùng
}



    public function ResetPasswordPage($token)
    {
        $token = PasswordReset::where('token', $token)->where('domain', getDomain())->first();
        if ($token) {
            return view('Auth.reset-password', compact('token'));
        } else {
            return redirect()->route('forgot.password')->with('error', 'Token không hợp lệ');
        }
    }

    public function ResetPassword($token, Request $request)
    {
        $token = PasswordReset::where('token', $token)->where('domain', getDomain())->first();
        if ($token) {
            $valid = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            } else {
                $user = User::where('email', $token->email)->where('domain', getDomain())->first();
                if ($user) {
                    $user->update([
                        'password' => Hash::make($request->password)
                    ]);
                    $token->delete();
                    return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công');
                } else {
                    return redirect()->route('forgot.password')->with('error', 'Email không tồn tại');
                }
            }
        } else {
            return redirect()->route('forgot.password')->with('error', 'Token không hợp lệ');
        }
    } 

    public function Login(Request $request)
{
    // Validate input
    $valid = Validator::make($request->all(), [
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    if ($valid->fails()) {
        return response()->json([
            'message' => 'Dữ liệu không hợp lệ',
            'errors' => $valid->errors(),
        ], 422); // 422 Unprocessable Entity
    }

    // Tìm người dùng dựa vào username
    $user = User::where('username', $request->username)->first();

    if ($user) {
        // Kiểm tra mật khẩu băm (hash) bằng cách sử dụng Hash::check
        if (Hash::check($request->password, $user->password)) {
            // Đăng nhập thành công
            Auth::login($user); // Đăng nhập người dùng

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công, xin chào ' . $request->username,
                'user' => $user, // Trả về thông tin người dùng nếu cần
            ], 200);
        } else {
            // Mật khẩu không khớp
            return response()->json([
                'success' => false,
                'message' => 'Sai mật khẩu'
            ], 401); // 401 Unauthorized
        }
    } else {
        // Không tìm thấy tài khoản
        return response()->json([
            'success' => false,
            'message' => 'Tài khoản không tồn tại'
        ], 404); // 404 Not Found
    }
}

    
    public function RefPage($id)
    {
        $user = User::where('id', $id)->where('domain', getDomain())->first();
        if ($user) {
            Session::put('ref', $user->id);
        }

        return redirect()->route('landing');
    }

    public function Register(Request $request)
    {
        // Validate input
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);
    
        if ($valid->fails()) {
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $valid->errors(),
            ], 422); // 422 Unprocessable Entity
        }
    
        if ($request->username == $request->password) {
            return response()->json([
                'message' => 'Tài khoản và mật khẩu không được giống nhau'
            ], 400); // 400 Bad Request
        }
    
        // Tạo mã giới thiệu ngẫu nhiên cho người dùng
        $referral_code = Str::random(10);
    
        // Tạo đường dẫn liên kết tiếp thị
        $referral_link = url('auth/john/' . $referral_code);
    
        // Tạo người dùng mới
        $newUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'api_token' => encrypt($request->email . '|' . $request->username . '|' . Str::random(32)),
            'balance' => 0,
            'type_balance' => 'VND',
            'lang' => 'vi',
            'avatar' => 'https://ui-avatars.com/api/?background=random&name=' . $request->name,
            'total_recharge' => 0,
            'total_deduct' => 0,
            'ref_id' => Session::get('ref') ?? '',
            'referral_money' => 0,
            'domain' => getDomain(),
            'referral_code' => $referral_code,
            'referral_link' => $referral_link,
        ]);
    
        // Cập nhật balance cho người giới thiệu nếu có
        if (Session::has('ref')) {
            $referrer = User::where('username', Session::get('ref'))->first();
            if ($referrer) {
                // Cộng thêm 1000 vào balance và total_recharge của người giới thiệu
                $reward = 1000;
                $referrer->balance += $reward;
                $referrer->total_recharge += $reward;
                $referrer->save();
            }
        }
    
        return response()->json(['message' => 'Đăng ký tài khoản thành công', 'user' => $newUser], 201);
    }
    

    public function Logout()
    {
        Session::flush();
        Auth::logout(Auth::user());
        return redirect()->route('login')->with('success', 'Đăng xuất tài khoản thành công');
    }
    public function RefCountPage($id)
    {
        $count = User::where('ref_id', $id)->count();


        return $data = [
            'status' => 'success',
            'count' => $count
        ];
    }
    public function InstallPage()
    {
        Auth::logout(Auth::user());
        return view('Auth.install');
    }

    public function Install(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ];

        if (env('PARENT_SITE') != getDomain()) {
            $rules['api_token'] = 'required|string';
        }

        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();

        try {
            if (env('PARENT_SITE') == getDomain()) {
                $token = Str::random(80);
                $newUser = User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => strtolower($request->email),
                    'password' => Hash::make($request->password),
                    'balance' => '0',
                    'type_balance' => 'default',
                    'total_recharge' => '0',
                    'total_deduct' => '0',
                    'referral_money' => '0',
                    'level' => '1',
                    'position' => 'admin',
                    'api_token' => $token,
                    'domain' => getDomain(),
                    'avatar' => 'https://ui-avatars.com/api/?background=random&name=' . $request->name,
                    'lang' => 'vi',
                ]);

                SiteData::updateOrCreate(
                    ['domain' => getDomain()],
                    [
                        'namesite' => getDomain(),
                        'is_admin' => json_encode($newUser->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                        'token_web' => $newUser->api_token,
                        'username_web' => $newUser->username,
                        'status' => 'Active',
                        'domain' => getDomain(),
                        'effect' => 'default_value'
                    ]
                );
            } else {
                $userdomain = SiteCon::where('domain_name', getDomain())->first();
                if (!$userdomain) {
                    return redirect()->back()->with('error', 'Domain không hợp lệ');
                }

                $userParent = User::where('api_token', $request->api_token)
                    ->where('domain', $userdomain['domain'])
                    ->first();

                if (!$userParent) {
                    return redirect()->back()->with('error', 'API Token không hợp lệ');
                }

                $token = encrypt($request->email . '|', $request->username . '|' . Str::random(32));
                $newUser = User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => strtolower($request->email),
                    'password' => Hash::make($request->password),
                    'balance' => '0',
                    'type_balance' => 'default',
                    'total_recharge' => '0',
                    'total_deduct' => '0',
                    'referral_money' => '0',
                    'level' => '1',
                    'position' => 'admin',
                    'api_token' => $token,
                    'domain' => getDomain(),
                    'avatar' => 'https://ui-avatars.com/api/?background=random&name=' . $request->name,
                    'lang' => 'vi',
                ]);

                SiteData::updateOrCreate(
                    ['domain' => getDomain()],
                    [
                        'namesite' => getDomain(),
                        'is_admin' => json_encode($userParent->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                        'token_web' => $userParent->api_token,
                        'username_web' => $userParent->username,
                        'status' => 'Active',
                        'domain' => getDomain(),
                        'logo_mini' => $userParent->logo_mini ?: '/assets/images/logo.jpg',
                    ]
                );                
            }

            DB::commit();
            return redirect()->route('login')->with('success', 'Kích hoạt tài khoản thành công')->withInput(['username' => $request->username]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đăng kí thất bại: ' . $e->getMessage());
        }
    }
}
