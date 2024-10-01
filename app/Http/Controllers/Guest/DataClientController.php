<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Models\DataHistory;
use App\Models\HistoryOrder;
use App\Models\HistoryLogin;
use App\Models\HistoryCard;
use App\Models\HistoryRecharge;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\OrderTainguyen;
use App\Models\Service;
use App\Models\SiteCon;
use App\Models\LogRef;
use App\Models\SiteData;
use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class DataClientController extends Controller
{

    // public function CreateSupport(Request $request)
    // {
    //     $throttleKey = 'anti_cheat';
    //     $lastRequestTime = Cache::get($throttleKey);

    //     if ($lastRequestTime && now()->diffInSeconds($lastRequestTime) < 30) {
    //         return redirect()->back()->with('error', "Bạn đã thao tác quá nhanh, thử lại sau vài giây...")->withInput();
    //     }

    //     Cache::put($throttleKey, now(), 30);
    //     $valid = Validator::make($request->all(), [
    //         'text' => 'required',
    //     ],[
    //         'text.required' => 'Nội dung tin nhắn không được bỏ trống.',
    
           
    //     ]);

    //     if ($valid->fails()) {
    //         return redirect()->back()->with('error', $valid->errors()->first());
    //     } else {
            
               
    //                $lam =  Support::create([
    //                     'username' => Auth::user()->username,
    //                     'text' => $request->text,
    //                     'status' => 'Pending',
    //                     'domain' => getDomain(),
    //                 ]);
               
    //             if($lam){
    //           return redirect()->back()->with('success', "Tạo hỗ trợ thành công, vui lòng chờ");
    //             }
    //     }
    // }

    public function createTickets(Request $request)
{
    $throttleKey = 'anti_cheat';
    $lastRequestTime = Cache::get($throttleKey);

    if ($lastRequestTime && now()->diffInSeconds($lastRequestTime) < 30) {
        return redirect()->back()->with('error', "Bạn đã thao tác quá nhanh, thử lại sau vài giây...")->withInput();
    }

    Cache::put($throttleKey, now(), 30);

    $valid = Validator::make($request->all(), [
        'text' => 'required',
    ], [
        'text.required' => 'Nội dung tin nhắn không được bỏ trống.',
    ]);

    if ($valid->fails()) {
        return redirect()->back()->with('error', $valid->errors()->first());
    } else {
        try {
            $lam = Tickets::create([
                'username' => Auth::user()->username,
                'text' => $request->text,
                'status' => 'Pending',
                'domain' => getDomain(),
            ]);

            if ($lam) {
                return redirect()->back()->with('success', "Tạo hỗ trợ thành công, vui lòng chờ");
            } else {
                return redirect()->back()->with('error', "Có lỗi xảy ra, vui lòng thử lại.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Lỗi: " . $e->getMessage());
        }
    }
}

    public function __construct()
    {
        $this->middleware('xss');
    }

    public function Card(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'telco' => 'required',
            'amount' => 'required|numeric',
            'serial' => 'required|numeric',
            'code' => 'required|numeric',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $telco = strtoupper($request->telco);
            $sign = md5(DataSite('partner_key') . $request->code . $request->serial);
            $request_id = rand(100000, 999999);
            $data = gachthe1s(DataSite('partner_id'), $telco, $request->code, $request->serial, $request->amount, $request_id, $sign);
            // echo $data;
            // print_r($data);
            if (isset($data)) {
                if ($data['status'] == 99) {
                    HistoryCard::create([
                        'username' => Auth::user()->username,
                        'card_type' => $telco,
                        'card_amount' => $request->amount,
                        'card_code' => $request->code,
                        'card_serial' => $request->serial,
                        'card_real_amount' => $request->amount,
                        'status' => 'Pending',
                        'note' => 'Đang chờ xử lý',
                        'tranid' => $data['trans_id'],
                        'domain' => request()->getHost()
                    ]);
                    return resApi('success', "Nạp thẻ thành công, vui lòng chờ xử lý");
                } else {
                    return resApi('error', $data['message']);
                }
            } else {
                return resApi('error', "Có lỗi gì đó");
            }
        }
    }



    public function UpdateProfile($type, Request $request)
{
    if ($type == 'profile') {
        $user = Auth::user();
        $user->name = $request->name ?? $user->name;
        $user->avatar = $request->image ?? $user->avatar;
        $user->facebook = $request->facebook ?? $user->facebook;
        $user->save();
        return resApi('success', "Cập nhật thành công");
    }

    if ($type == 'send-mail') {
        $valid = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            return resApi('error', "Chức năng đang được phát triển");
        }
    }

    if ($type == 'change-token') {
        $user = Auth::user();
        $user->api_token = encrypt($user->email . '|' . $user->username . '|' . Str::random(32));
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật access_token thành công',
            'api_token' => $user->api_token
        ]);
    }

    if ($type == 'change-password') {
        $valid = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return resApi('success', "Đổi mật khẩu thành công vui lòng đăng nhập lại");
            } else {
                return resApi('error', "Mật khẩu cũ không đúng");
            }
        }
    }

    if ($type == 'update-telegram') {
        $user = Auth::user();
        $user->telegram_chat_id = $request->telegram_id ?? $user->telegram_chat_id; // Update the telegram_chat_id
        $user->telegram_notice = $request->isNotice === 'on' ? 'on' : 'no'; // Update the notification status if needed
        $user->save();
        return resApi('success', "Cập nhật thành công");
    }
}


    public function CreateWebsite(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'api_token' => 'required',
            'domain' => 'required|unique:site_cons,domain_name',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            if (Auth::user()->level >= 2) {
                $check = SiteCon::where('username', Auth::user()->username)->first();
                if ($check) {
                    $check->domain_name = formatDomain($request->domain);
                    $check->status = 'Pending';
                    $check->save();
                } else {
                    SiteCon::create([
                        'username' => Auth::user()->username,
                        'domain_name' => formatDomain($request->domain),
                        'status' => 'Pending',
                        'domain' => getDomain(),
                    ]);
                }

                return redirect()->back()->with('success', "Tạo website thành công");
            } else {
                return redirect()->back()->with('error', "Cấp bậc bạn chưa đủ để thực hiện tạo website");
            }
        }
    }

    public function ListAction($action, Request $request)
    {
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $search = $request->search['value'] ?? '';
        $order = $request->order[0] ?? [];
        $dir = $request->order[0]['dir'] ?? 'DESC';

        if ($action == 'history-user') {
            if (!empty($search)) {
                $data = DataHistory::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('action', 'like', "%$search%")
                        ->orWhere('data', 'like', "%$search%")
                        ->orWhere('old_data', 'like', "%$search%")
                        ->orWhere('new_data', 'like', "%$search%")
                        ->orWhere('dongia', 'like', "%$search%")
                        ->orWhere('donhang', 'like', "%$search%")
                        ->orWhere('linkorder', 'like', "%$search%")
                        ->orWhere('maychu', 'like', "%$search%")
                        ->orWhere('soluong', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = DataHistory::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = DataHistory::where('domain', getDomain())->where('username', Auth::user()->username)->count();
            }
            $data = $data->map(function ($item) {
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        } {

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $search = $request->search['value'] ?? '';
            $order = $request->order[0] ?? [];
            $dir = $request->order[0]['dir'] ?? 'DESC';

            if ($action == 'history-order') {
                if (!empty($search)) {
                    $data = HistoryOrder::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('username', 'like', "%$search%")
                            ->orWhere('taodon', 'like', "%$search%")
                            ->orWhere('thaydoi', 'like', "%" . base64_encode($search) . "%")
                            ->orWhere('sodu', 'like', "%$search%")
                            ->orWhere('soduhientai', 'like', "%$search%")
                            ->orWhere('dongia', 'like', "%$search%")
                            ->orWhere('dichvu', 'like', "%$search%")
                            ->orWhere('donhang', 'like', "%$search%")
                            ->orWhere('linkorder', 'like', "%$search%")
                            ->orWhere('maychu', 'like', "%$search%")
                            ->orWhere('soluong', 'like', "%$search%")
                            ->orWhere('created_at', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = HistoryOrder::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = HistoryOrder::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {
                    return $item;
                });

                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }

           
            
            if ($action == 'history-tickets') {
                if (!empty($search)) {
                    $data = Tickets::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('id', 'like', "%$search%")
                 
                            ->orWhere('comment', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = Tickets::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = Tickets::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {
                    $item->status = statusTickets($item->status);
                    return $item;
                });
    
                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }

            if ($action == 'tainguyen-order') {
                if (!empty($search)) {
                    $data = OrderTainguyen::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('order_codes', 'like', "%$search%")
                            ->orWhere('id', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = OrderTainguyen::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = OrderTainguyen::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {
                   
                    return $item;
                });
    
                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }

            if ($action == 'history-login') {
                if (!empty($search)) {
                    $data = HistoryLogin::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('username', 'like', "%$search%")
                            ->orWhere('action', 'like', "%$search%")
                            ->orWhere('dangnhap', 'like', "%$search%")
                            ->orWhere('created_at', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = HistoryLogin::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = HistoryLogin::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {
                    return $item;
                });

                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }

            if ($action == 'history-transfer') {
                if (!empty($search)) {
                    $data = HistoryRecharge::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('name_bank', 'like', "%$search%")
                            ->orWhere('type_bank', 'like', "%$search%")
                            ->orWhere('tranid', 'like', "%" . base64_encode($search) . "%")
                            ->orWhere('amount', 'like', "%$search%")
                            ->orWhere('real_amount', 'like', "%$search%")
                            ->orWhere('note', 'like', "%$search%")
                            ->orWhere('created_at', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = HistoryRecharge::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = HistoryRecharge::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {

                    return $item;
                });

                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }
            if ($action == 'history-ref') {
                if (!empty($search)) {
                    $data = LogRef::where('domain', getDomain())->where('ref_id', Auth::user()->id)->where(function ($query) use ($search) {
                        $query->where('id', 'like', "%$search%")

                            ->orWhere('username', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = LogRef::where('domain', getDomain())->where('ref_id', Auth::user()->id)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = LogRef::where('domain', getDomain())->where('ref_id', Auth::user()->id)->count();
                }
                $data = $data->map(function ($item) {

                    return $item;
                });

                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }
            if ($action == 'history-card') {
                if (!empty($search)) {
                    $data = HistoryCard::where('domain', getDomain())->where('username', Auth::user()->username)->where(function ($query) use ($search) {
                        $query->where('card_type', 'like', "%$search%")
                            ->orWhere('card_amount', 'like', "%$search%")
                            ->orWhere('card_serial', 'like', "%$search%")
                            ->orWhere('card_code', 'like', "%$search%")
                            ->orWhere('card_real_amount', 'like', "%$search%")
                            ->orWhere('created_at', 'like', "%$search%");
                    })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = $data->count();
                } else {
                    $data = HistoryCard::where('domain', getDomain())->where('username', Auth::user()->username)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                    $total = HistoryCard::where('domain', getDomain())->where('username', Auth::user()->username)->count();
                }
                $data = $data->map(function ($item) {
                    $item->status = statusCard($item->status);
                    return $item;
                });

                return response()->json([
                    'data' => $data,
                    'recordsTotal' => $total,
                    'recordsFiltered' => $total
                ]);
            }
        }
    }
    public function UserAction($action, Request $request)
    {
        if ($action == 'level-user') {
            $user = Auth::user();
            if (DataSite('collaborator') == 0 || DataSite('agency') == 0 || DataSite('distributor') == 0) {
                return resApi('error', "Chức năng đang được phát triển");
            } else {
                if ($request->user == 1) {
                    if ($user->total_recharge >= DataSite('collaborator')) {
                        $user->level = 2;
                        $user->save();
                        return resApi('success', "Chúc mừng bạn đã lên cấp bậc Cộng tác viên");
                    }
                }
                if ($request->user == 2) {
                    if ($user->total_recharge >= DataSite('agency')) {
                        $user->level = 3;
                        $user->save();
                        return resApi('success', "Chúc mừng bạn đã lên cấp bậc Đại lý");
                    }
                }

                if ($request->user == 3) {
                    if ($user->total_recharge >= DataSite('distributor')) {
                        $user->level = 4;
                        $user->save();
                        return resApi('success', "Chúc mừng bạn đã lên cấp bậc Nhà phân phối");
                    }
                }
            }
        }

        if ($action == 'change-token') {
            $user = Auth::user();
            $user->api_token = encrypt($user->email . '|', $user->username . '|' . Str::random(32));
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Đổi token thành công',
                'api_token' => $user->api_token
            ]);
        }
    }

    public function ServiceGetOrder(Request $request)
    {
        $order = Orders::where('domain', getDomain())->where('id', $request->id)->first();
        if ($order) {
            unset($order->actual_server);
            unset($order->actual_service);
            unset($order->actual_path);
            unset($order->username);
            return resApi('success', "Lấy thông tin đơn hàng thành công", $order);
        }
        return resApi('error', 'Không tìm thấy đơn hàng');
    }

    public function ToolGetUid($action1, Request $request)
    {
        if ($action1 == 'get-uid') {
            $valid = Validator::make($request->all(), [
                'link' => 'required|string'
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', 'Vui lòng nhập đúng định dạng link')->withInput();
            } else {
                $link = getUid($request->link);
                if ($link['status'] == true) {

                    return redirect()->back()->with(['success' => 'Lấy UID thành công', 'link' => $link['id']])->withInput();
                } else {
                    return redirect()->back()->with('error', 'Không lấy được UID')->withInput();
                }
            }
        }
    }
    public function ServiceGetToken(Request $request)
    {

        $token = checktoken($request->token);
        if ($token['status'] == true) {
            return resApi('success', "Token Live", $token);
            // return redirect()->back()->with(['success' => 'Token Live', 'token' => $request->token, 'user_id' => $token['user_id'], 'name' =>$token['name']])->withInput();
        } else {
            return resApi('error', 'Token Invalid');
        }
    }
    public function getAuthenTwo($action, Request $request)
    {
        if ($action == 'get-2fa') {
            $valid = Validator::make($request->all(), [
                'key' => 'required|string'
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', 'Vui lòng nhập đúng định dạng link')->withInput();
            } else {
                $key = getAuthenTwo($request->key);
                if ($key['status'] == true) {
                    return redirect()->back()->with(['success' => 'Get 2FA CODE thành công', 'token' => $key['token']])->withInput();
                } else {
                    return redirect()->back()->with('error', 'Không Get được 2FA CODE')->withInput();
                }
            }
        }
    }
    public function ToolWhiosDomain($action, Request $request)
    {
        if ($action == 'whios-domain') {
            $valid = Validator::make($request->all(), [
                'domaincheck' => 'required|string'
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', 'Vui lòng nhập đúng tên miền')->withInput();
            } else {
                $domaincheck1 = whois($request->domaincheck);
                if ($domaincheck1['status'] == true) {
                    return redirect()->back()->with(['success' => $domaincheck1['message'], 'status' => $domaincheck1['status'], 'domaincheck' => $domaincheck1['domain'], 'registrar' => $domaincheck1['registrar'], 'statusdomain' => $domaincheck1['statusdomain'], 'creationDate' => $domaincheck1['creationDate'], 'expirationDate' => $domaincheck1['expirationDate'], 'nameServer1' => $domaincheck1['nameServer1'], 'nameServer2' => $domaincheck1['nameServer2']])->withInput();
                } else {
                    return redirect()->back()->with('error', 'Tên miền chưa được đăng kí')->withInput();
                }
            }
        }
    }

    public function OrderAction($social, $action, Request $request)
    {
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $search = $request->search['value'] ?? '';
        $order = $request->order[0] ?? [];
        $dir = $request->order[0]['dir'] ?? 'desc';

        $service = Service::where('domain', env('PARENT_SITE'))->where('slug', $action)->where('service_social', $social)->first();
        if ($service) {
            if (!empty($search)) {
                $data = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('service_id', $service->id)->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('order_link', 'like', "%$search%")
                        ->orWhere('server_service', 'like', "%$search%")
                        ->orWhere('quantity', 'like', "%$search%")
                        ->orWhere('total_payment', 'like', "%$search%")
                        ->orWhere('price', 'like', "%$search%")
                        ->orWhere('start', 'like', "%$search%")
                        ->orWhere('buff', 'like', "%$search%")
                        ->orWhere('note', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('service_id', $service->id)->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('service_id', $service->id)->count();
            }

            $data = $data->map(function ($item) {
                $item->status_order = statusOrder($item->status);
                $item->order_type = ServerService::where('id', $item->server_service)->first()->order_type ?? "Không tìm thấy";
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        } else {
            return response()->json([
                'data' => [],
                'recordsTotal' => 0,
                'recordsFiltered' => 0
            ]);
        }
    }
}
