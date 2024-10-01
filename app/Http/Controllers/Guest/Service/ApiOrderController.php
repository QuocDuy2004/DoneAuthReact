<?php

namespace App\Http\Controllers\Guest\Service;
use App\Curl\SmmApi;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TeleCustomController as TelegramCustomController;
use App\Models\DataHistory;
use App\Models\HistoryOrder;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\ServiceSocial;
use App\Models\SiteCon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\PHP;

class ApiOrderController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('xss');
    } */

    public function createOrder(Request $request)
    {
        $api_token = $request->input('key');
        $serviceid = $request->input('service');
        $action = $request->input('action');
        $link = $request->input('link');
        $quantity = $request->input('quantity');
        $minutes = $request->input('minutes');
        $comments = $request->input('comments');
        if (empty($api_token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ]);
        } elseif (empty($action)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid action'
            ]);
        } else {

            if ($action == 'add') {
                if (empty($serviceid)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid Service ID'
                    ]);
                } elseif (empty($link)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid link'
                    ]);
                } elseif (empty($quantity)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid quantity'
                    ]);
                } else {
                    $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                    if ($user) {


                        $server1 = ServerService::where('domain', getDomain())->where('id', $serviceid)->first();
                        if ($server1) {
                            $social_service = ServiceSocial::where('domain', getDomain())->where('id', $server1->social_id)->first();
                            if ($social_service) {
                                $service_ = Service::where('domain', getDomain())->where('id', $server1->service_id)->where('service_social', $social_service->slug)->first();
                                if ($service_) {

                                    $server = ServerService::where('domain', getDomain())->where('social_id', $social_service->id)->where('service_id', $service_->id)->where('server', $server1->server)->first();
                                    $orderday = Orders::where('domain', getDomain())->where('service_id', $service_->id)->where('server_service', $server1->server)->whereDate('created_at', Carbon::today())->count();
                                    if ($server) {
                                        if ($server->status != 'Active') {
                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Sever is busy !'
                                            ]);
                                            die();
                                        } else {



                                            if ($service_->category == 'comment') {
                                                $quantity = count(explode("\n", $comments));
                                                $request->merge(['quantity' => $quantity]);
                                            }

                                            if ($server->min > $quantity) {
                                                return response()->json([
                                                    'status' => 'error',
                                                    'message' => 'Min is ' . $server->min
                                                ]);
                                            } elseif ($server->max < $quantity) {
                                                return response()->json([
                                                    'status' => 'error',
                                                    'message' => 'Max is ' . $server->max
                                                ]);
                                            } elseif ($server->limitDay != 0 && $server->limitDay != '' && $orderday >= $server->limitDay) {

                                                return response()->json([
                                                    'status' => 'error',
                                                    'message' => 'Máy chủ hiện tại đã ngừng tiếp nhận đơn hàng do quá tải hệ thống'
                                                ]);
                                                die();
                                            } else {
                                                $price = priceServer($server->id, $user->level);
                                                $total_payment = 0;
                                                if ($service_->category == 'minutes') {
                                                    $total_payment = $price * $quantity * $minutes;
                                                } elseif ($service_->category == 'viplike') {
                                                    $total_payment = $price * $quantity * $request->days * $request->post;
                                                } elseif ($service_->category == 'viplike-kcx') {
                                                    $total_payment = $price * $quantity * $request->days * $request->post;
                                                } else {
                                                    $total_payment = $price * $quantity;
                                                }

                                                if ($user->balance < $total_payment) {
                                                    return response()->json([
                                                        'status' => 'error',
                                                        'message' => 'Balance not enough !'
                                                    ]);
                                                } else {

                                                    if (env('IS_ORDER') == true) {
                                                        $data_send = false;
                                                        $actual_path = $server->actual_path;
                                                        $actual_server = $server->actual_server;

                                                        $order_link = $link;
                                                        if ($server->actual_service == 'app.subme.vn') {
                                                            $tuongtacsale = new SubmeController();

                                                            $tuongtacsale->data = [
                                                                'order_link' => $order_link,
                                                                'quantity' => $quantity,
                                                                'speed' => $request->speed ?? '0',
                                                                'comment' => $comments ?? '',
                                                                'minutes' => $minutes ?? '',
                                                                'time' => $request->time ?? '',
                                                                'reaction' => $request->reaction ?? '',
                                                                'server_order' => $actual_server,

                                                            ];
                                                            $result = $tuongtacsale->CreateOrder();
                                                            if ($result['status'] == true) {
                                                                $order_history[] = [
                                                                    'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                    'status' => 'info',
                                                                    'title' => "Đơn hàng đã hoạt động",
                                                                ];
                                                                $order = Orders::create([
                                                                    'username' => $user->username,
                                                                    'service_id' => $service_->id,
                                                                    'service_name' => $service_->name,
                                                                    'server_service' => $server->server,
                                                                    'price' => $price,
                                                                    'quantity' => $quantity,
                                                                    'total_payment' => $total_payment,
                                                                    'order_code' => '',
                                                                    'order_link' => $link,
                                                                    'start' => 0,
                                                                    'buff' => 0,
                                                                    'actual_service' => $server->actual_service,
                                                                    'actual_path' => $server->actual_path,
                                                                    'actual_server' => $server->actual_server,
                                                                    'status' => 'Active',
                                                                    'action' => json_encode([
                                                                        'link_order' => $link,
                                                                        'server_service' => $server->server,
                                                                        'quantity' => $quantity,
                                                                        'reaction' => $request->reaction ?? '',
                                                                        'speed' => $request->speed ?? '',
                                                                        'comment' => $comments ?? '',
                                                                        'minutes' => $minutes ?? '',
                                                                        'time' => $request->time ?? '',
                                                                    ]),
                                                                    'dataJson' => '',
                                                                    'isShow' => 1,
                                                                    'history' => json_encode([
                                                                        [
                                                                            'status' => 'primary',
                                                                            'title' => "Thời gian tạo đơn hàng",
                                                                            'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                        ]
                                                                    ]),
                                                                    'note' => $request->note ?? '',
                                                                    'domain' => getDomain(),
                                                                ]);

                                                                if ($order) {
                                                                    $order_history = json_decode($order->history, true);
                                                                    $order_history[] = [
                                                                        'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                        'status' => 'info',
                                                                        'title' => "Đơn hàng đang hoạt động",
                                                                    ];
                                                                    $order->order_code = $result['data'];

                                                                    $order->buff = 0;
                                                                    $order->status = 'Active';
                                                                    $order->dataJson = json_encode($result['data']);
                                                                    $order->history = json_encode($order_history);
                                                                    $order->save();

                                                                    if (DataSite('notice_order') == 'on') {
                                                                        if (DataSite('telegram_chat_id')) {
                                                                            $tele = new TelegramCustomController();
                                                                            $bot = $tele->bot();
                                                                            $bot->sendMessage([
                                                                                'chat_id' => DataSite('telegram_chat_id'),
                                                                                'text' => "🔔 Đơn hàng mới \n Từ " . $user->username . "\nDịch vụ MXH: " . $social_service->name . "\nDịch vụ: " . $service_->name . "\nServer: " . $server->server . "\nSố lượng: " . $quantity . "\nGiá: " . number_format($total_payment) . "đ\nLink: " . $link,
                                                                            ]);
                                                                        }
                                                                    }
                                                                    $balance = $user->balance;
                                                                    $user->balance = $user->balance - $total_payment;
                                                                    $user->total_deduct = $user->total_deduct + $total_payment;
                                                                    $user->save();
                                                                    DataHistory::create([
                                                                        'username' => $user->username,
                                                                        'action' => 'Tạo đơn',
                                                                        'data' => $total_payment,
                                                                        'old_data' => $balance,
                                                                        'new_data' => $user->balance,
                                                                        'ip' => $request->ip(),

                                                                        'description' => "" . $order->order_code . " | " . $service_->service_social . " | Tăng " . $quantity . " " . $service_->slug . " ở máy chủ [" . $server->server . "] cho ID " . $service_->service_social . ": " . $link . ", trừ " . number_format($total_payment) . " vnd trong tài khoản",
                                                                        'data_json' => '',
                                                                        'domain' => getDomain(),
                                                                    ]);
                                                                    return response()->json([
                                                                        'status' => 'success',
                                                                        'message' => 'Order successful',
                                                                        'order' => $order->id,
                                                                    ]);
                                                                } else {
                                                                    return response()->json([
                                                                        'status' => 'error',
                                                                        'message' => 'Đặt hàng thất bại',
                                                                    ]);
                                                                }
                                                            } else {
                                                                return response()->json([
                                                                    'status' => 'error',
                                                                    'message' => $result['message'],
                                                                ]);
                                                            }
                                                        } else {
                                                            return response()->json([
                                                                'status' => 'error',
                                                                'message' => 'Dữ liệu không hợp lệ vui lòng thử lại sau'
                                                            ]);
                                                        }
                                                    } else {
                                                        $orders = Orders::where('status', 'Pending')->get();
                                                        foreach ($orders as $order) {
                                                            // Kiểm tra điều kiện nếu cần thiết, ví dụ:
                                                            if ($order->actual_service == $server->actual_service) {
                                                                // Thực hiện các hành động cần thiết cho mỗi đơn hàng
                                                                $smm = SmmApi::get();
                                                                foreach ($smm as $smms) {
                                                                    if ($server->actual_service == $smms['name']) {
                                                                        $path = $smms['name'];
                                                                        $post = array(
                                                                            'key' => $smms['token'],
                                                                            'action' => 'add',
                                                                            'service' => $order->actual_server,
                                                                            'link' => $order->order_link,
                                                                            'quantity' => $order->quantity,
                                                                            'comments' => $order->action['comment'],
                                                                            'reaction' => strtolower($order->action['reaction']) ?? 'like'
                                                                        );
                                                                        $result = curl_smm($path, $post);
                                                                        if (isset($result['order']) && !empty($result['order'])) {
                                                                            // Cập nhật đơn hàng
                                                                            $order_history = json_decode($order->history, true);
                                                                            $order_history[] = [
                                                                                'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                                'status' => 'info',
                                                                                'title' => "Đơn hàng đang hoạt động",
                                                                            ];
                                                                            $order->order_code = $result['order'];
                                                                            $order->status = 'Active';
                                                                            $order->dataJson = json_encode($result['order']);
                                                                            $order->history = json_encode($order_history);
                                                                            $order->save();
                                                                            
                                                                            // Gửi thông báo nếu cần thiết
                                                                            if (DataSite('notice_order') == 'on') {
                                                                                if (DataSite('telegram_chat_id')) {
                                                                                    $tele = new TelegramCustomController();
                                                                                    $bot = $tele->bot();
                                                                                    $bot->sendMessage([
                                                                                        'chat_id' => DataSite('telegram_chat_id'),
                                                                                        'text' => "🔔 Đơn hàng mới \n Từ " . $order->username . "\nDịch vụ MXH: " . $order->service_name . "\nDịch vụ: " . $order->service_name . "\nServer: " . $order->server_service . "\nSố lượng: " . $order->quantity . "\nGiá: " . number_format($order->total_payment) . "đ\nLink: " . $order->order_link,
                                                                                    ]);
                                                                                }
                                                                            }
                                                                            
                                                                            // Cập nhật số dư người dùng
                                                                            $user = $order->user;
                                                                            $balance = $user->balance;
                                                                            $user->balance -= $order->total_payment;
                                                                            $user->total_deduct += $order->total_payment;
                                                                            $user->save();
                                                        
                                                                            // Lưu lịch sử giao dịch
                                                                            DataHistory::create([
                                                                                'username' => $user->username,
                                                                                'action' => 'Tạo đơn',
                                                                                'data' => $order->total_payment,
                                                                                'old_data' => $balance,
                                                                                'new_data' => $user->balance,
                                                                                'ip' => $request->ip(),
                                                                                'description' => "" . $order->order_code . " | " . $order->service_name . " | Tăng " . $order->quantity . " " . $order->service_name . " ở máy chủ [" . $order->server_service . "] cho ID " . $order->service_name . ": " . $order->order_link . ", trừ " . number_format($order->total_payment) . " vnd trong tài khoản",
                                                                                'data_json' => '',
                                                                                'domain' => getDomain(),
                                                                            ]);
                                                        
                                                                            // Trả về phản hồi thành công
                                                                            return response()->json([
                                                                                'status' => 'success',
                                                                                'message' => 'Order successful',
                                                                                'order' => $order->id,
                                                                            ]);
                                                                        } else {
                                                                            return response()->json([
                                                                                'status' => 'error',
                                                                                'message' => $result['error'],
                                                                            ]);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => 'Invalid Service'
                                    ]);
                                    die();
                                }
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Invalid Service'
                                ]);
                                die();
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Invalid Service'
                            ]);
                            die();
                        }
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Invalid API key!'
                        ]);
                    }
                }
            }

            #status
            elseif ($action == 'status') {


                $idorder = $request->input('order');

                if (empty($idorder)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid Order ID'
                    ]);
                } else {


                    $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                    if ($user) {
                        $order = Orders::where('username', $user->username)->where('id', $idorder)->first();
                        if ($order) {
                            return response()->json([
                                'charge' => $order->price,
                                'start_count' => $order->start,
                                'status' => $order->status,
                                'remains' => $order->quantity - $order->buff
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => "Không tìm thấy đơn hàng!",
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Invalid API key!'
                        ]);
                    }
                }
            }
            #balance
            elseif ($action == 'balance') {

                $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                if ($user) {
                    return response()->json([
                        'balance' => round(($user->balance / 25000), 2),
                        'currency' => 'USD'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid API key!'
                    ]);
                }
            }

            #get service
            elseif ($action == 'services') {
                $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();

                $server_service = ServerService::where('domain', getDomain())->get();
                $arr = [];
                foreach ($server_service as $sv) {
                    $arr[] = [
                        "service" => $sv->id,
                        "name" => Service::find($sv->service_id)->name,
                        "type" => 'Default',
                        "category" => ucfirst($sv->socialll),
                        "rate" => priceServer($sv->id, $user->level) / 25,
                        "min" => $sv->min,
                        "max" => $sv->max,
                    ];
                }
                return response()->json(

                    $arr
                );
            }
        }
    }
}
