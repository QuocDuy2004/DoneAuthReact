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
    $valid = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
    ]);

    if ($valid->fails()) {
        return response()->json([
            'errors' => $valid->errors(),
        ], 422);
    }

    $user = User::where('email', $request->email)->where('domain', getDomain())->first();
    if ($user) {
        $token = Str::random(60);
        $check = PasswordReset::where('email', $request->email)->where('domain', getDomain())->first();
        if ($check) {
            $check->update(['token' => $token]);
        } else {
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'domain' => getDomain()
            ]);
        }
        Mail::to($request->email)->send(new MailForgotPassword(route('reset.password', $token)));

        return response()->json(['message' => 'Vui lòng kiểm tra email để lấy lại mật khẩu'], 200);
    } else {
        return response()->json(['message' => 'Email không tồn tại'], 404);
    }
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
    // Tìm mã thông báo
    $passwordReset = PasswordReset::where('token', $token)
                                  ->where('domain', getDomain())
                                  ->first();
    
    // Nếu không tìm thấy mã thông báo, chuyển hướng với thông báo lỗi
    if (!$passwordReset) {
        return redirect()->route('forgot.password')->with('error', 'Token không hợp lệ hoặc đã hết hạn');
    }

    // Xác thực mật khẩu
    $valid = Validator::make($request->all(), [
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Nếu xác thực thất bại, trả về trang trước với thông báo lỗi
    if ($valid->fails()) {
        return redirect()->back()->withErrors($valid)->withInput();
    }

    // Tìm người dùng và cập nhật mật khẩu
    $user = User::where('email', $passwordReset->email)->first();
    
    if (!$user) {
        return redirect()->route('forgot.password')->with('error', 'Không tìm thấy người dùng với email này');
    }

    // Cập nhật mật khẩu
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Xóa token sau khi đổi mật khẩu thành công
    $passwordReset->delete();

    // Chuyển hướng đến trang đăng nhập với thông báo thành công
    return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công.');
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
                'user' => $user, // Trả về thông tin người dùng
                'api_token' => $user->api_token, // Trả về api_token
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
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
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
        if (env('PARENT_SITE') == getDomain()) {
            $valid = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            } else {
                $token = Str::random(80);
                $newUser = User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => strtolower($request->email),
                    'password' => Hash::make($request->password),
                    'balance' => 0,
                    'lang' => 'vi',
                    'total_recharge' => 0,
                    'avatar' => 'https://ui-avatars.com/api/?background=random&name=' . $request->name,
                    'total_deduct' => 0,
                    'referral_money' => 0,
                    'position' => 'admin',
                    'api_token' => $token,
                    'domain' => getDomain(),
                ]);

                if ($newUser) {

                    $site = SiteData::where('domain', getDomain())->first();
                    if (!$site) {
                        SiteData::create([
                            'namesite' => getDomain(),
                            'is_admin' => json_encode($newUser->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                            'token_web' => $newUser->api_token,
                            'username_web' => $newUser->username,
                            'status' => 'Active',
                            'domain' => getDomain(),
                        ]);
                    } else {
                        if ($site->status === 'Active') {
                            return redirect()->back()->with('error', 'Anh cho phép em bug lại phát nữa');
                        } else {
                            $site->update([
                                'is_admin' => json_encode($newUser->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                                'token_web' => $newUser->api_token,
                                'username_web' => $newUser->username,
                                'status' => 'Active',
                                'domain' => getDomain(),
                            ]);
                        }
                    }

                    return redirect()->route('login')->with('success', 'Đăng ký thành công')->withInput(['username' => $request->username]);
                } else {
                    return redirect()->back()->with('error', 'Đăng kí thất bại');
                }
            }
        } else {
            $valid = Validator::make($request->all(), [
                'api_token' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            } else {
                $userdomain = SiteCon::where('domain_name', getDomain())->first();
                $userParent = User::where('api_token', $request->api_token)->where('domain', $userdomain['domain'])->first();
                if ($userParent) {
                    $site = SiteData::where('domain', getDomain())->first();
                    if ($site) {
                        $site->update([
                            'is_admin' => json_encode($userParent->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                            'token_web' => $userParent->api_token,
                            'username_web' => $userParent->username,
                            'status' => 'Active',
                            'domain' => getDomain(),
                        ]);
                    } else {
                        SiteData::create([
                            'namesite' => getDomain(),
                            'is_admin' => json_encode($userParent->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                            'token_web' => $userParent->api_token,
                            'username_web' => $userParent->username,
                            'status' => 'Active',
                            'domain' => getDomain(),
                        ]);
                    }
                    $token = encrypt($request->email . '|', $request->username . '|' . Str::random(32));
                    $newUser = User::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => strtolower($request->email),
                        'password' => Hash::make($request->password),
                        'balance' => 0,
                        'total_recharge' => 0,
                        'avatar' => 'https://ui-avatars.com/api/?background=random&name=' . $request->name,
                        'total_deduct' => 0,
                        'referral_money' => 0,
                        'position' => 'admin',
                        'api_token' => $token,
                        'domain' => getDomain(),
                    ]);

                    if ($newUser) {
                        return redirect()->route('login')->with('success', 'Đăng ký thành công')->withInput(['username' => $request->username]);
                    } else {
                        return redirect()->back()->with('error', 'Đăng kí thất bại');
                    }
                } else {
                    return redirect()->back()->with('error', 'API Token không hợp lệ');
                }
            }
        }
    }
}
