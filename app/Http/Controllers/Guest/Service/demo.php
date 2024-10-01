<?php

namespace App\Http\Controllers\Guest\Service;

use App\Curl\SmmApi;
use App\Http\Controllers\Api\Serivce\Hacklike17Controller;
use App\Http\Controllers\Api\Serivce\MuaflController;
use App\Http\Controllers\Api\Serivce\OneDgController;
use App\Http\Controllers\APi\Serivce\SainpanelController;
use App\Http\Controllers\Api\Serivce\SubgiareController;
use App\Http\Controllers\Api\Serivce\TrumsubreController;
use App\Http\Controllers\Api\Serivce\SubmetaController;
use App\Http\Controllers\Api\Serivce\TraodoisubController;
use App\Http\Controllers\Api\Serivce\TwoMxhController;
use App\Http\Controllers\Api\Serivce\TwoFourController;
use App\Http\Controllers\Api\Serivce\TrumvipController;


use App\Http\Controllers\Api\Serivce\MSVController;
use App\Http\Controllers\Api\Service\SmmController;
use App\Http\Controllers\Api\Service\SubmeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TeleCustomController as TelegramCustomController;
use App\Http\Controllers\Custom\TeleconCustomController;
use App\Models\DataHistory;
use App\Models\HistoryOrder;
use App\Models\Orders;
use App\Models\Provider;
use App\Models\Smm;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\ServiceSocial;
use App\Models\SiteCon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\PHP;


class OrderServiceController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('xss');
    } */

    public function createOrder($social, $service, Request $request)
    {
        $api_token = $request->header('Api-token');
        if (empty($api_token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Api token is required'
            ]);
        } else {
            if (getDomain() == env('PARENT_SITE')) {
                $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                if ($user) {
                    $valid = Validator::make($request->all(), [
                        'link_order' => 'required',

                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'status' => 'error',
                            'message' => $valid->errors()->first()
                        ]);
                    } else {
                        $orders = Orders::where('domain', getDomain())->where('host', '!=', '')->first();
                        $social_service = ServiceSocial::where('domain', getDomain())->where('slug', $social)->first();
                        if ($social_service) {
                            $service_ = Service::where('domain', getDomain())->where('slug', $service)->where('service_social', $social_service->slug)->first();
                            if ($service_) {
                                if ($service_->category != 'bot') {
                                    $server = ServerService::where('domain', getDomain())->where('social_id', $social_service->id)->where('service_id', $service_->id)->where('server', $request->server_service)->first();
                                    $orderday = Orders::where('domain', getDomain())->where('service_id', $service_->id)->where('server_service', $request->server_service)->whereDate('created_at', Carbon::today())->count();
                                    if ($server) {
                                        if ($server->status != 'Active') {
                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Server đang bảo trì hoặc ngừng nhận đơn'
                                            ]);
                                            die();
                                        } elseif ($server->limitDay != 0 && $server->limitDay != '' && $orderday >= $server->limitDay) {

                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Máy chủ hiện tại đã ngừng tiếp nhận đơn hàng do quá tải hệ thống'
                                            ]);
                                            die();
                                        } else {
                                            switch ($service_->category) {
                                                case 'default':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                                case 'reaction':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'reaction' => 'required',
                                                    ];
                                                    break;
                                                case 'reaction-speed':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'reaction' => 'required',
                                                        'speed' => 'required',
                                                    ];
                                                    break;
                                                case 'comment':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'comment' => 'required',
                                                    ];
                                                    break;
                                                case 'comment-quantity':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'comment' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                                case 'minutes':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'minutes' => 'required',
                                                    ];
                                                    break;
                                                case 'time':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'time' => 'required',
                                                    ];
                                                    break;
                                                case 'proxy':
                                                    $validator = [
                                                        'link_order' => 'required|string',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'timebuy' => 'required',

                                                    ];
                                                    break;

                                                default:
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                            }

                                            $valid = Validator::make($request->all(), $validator);
                                            if ($valid->fails()) {
                                                return response()->json([
                                                    'status' => 'error',
                                                    'message' => $valid->errors()->first()
                                                ]);
                                            } else {
                                                if ($service_->category == 'comment') {
                                                    $quantity = count(explode("\n", $request->comment));
                                                    $request->merge(['quantity' => $quantity]);
                                                }

                                                if ($server->min > $request->quantity) {
                                                    return response()->json([
                                                        'status' => 'error',
                                                        'message' => 'Số lượng tối thiểu là ' . $server->min
                                                    ]);
                                                } elseif ($server->max < $request->quantity) {
                                                    return response()->json([
                                                        'status' => 'error',
                                                        'message' => 'Số lượng tối đa là ' . $server->max
                                                    ]);
                                                } else {
                                                    $price = priceServer($server->id, $user->level);
                                                    $total_payment = 0;
                                                    if ($service_->category == 'minutes') {
                                                        $total_payment = $price * $request->quantity * $request->minutes;
                                                    } elseif ($service_->category == 'viplike') {
                                                        $total_payment = $price * $request->quantity * $request->days * $request->post;
                                                    } elseif ($service_->category == 'viplike-kcx') {
                                                        $total_payment = $price * $request->quantity * $request->days * $request->post;
                                                    } else {
                                                        $total_payment = $price * $request->quantity;
                                                    }

                                                    if ($user->balance < $total_payment) {
                                                        return response()->json([
                                                            'status' => 'error',
                                                            'message' => 'Bạn không đủ ' . number_format($total_payment) . 'đ để mua dịch vụ'
                                                        ]);
                                                    } else {
                                                        $smm = Provider::all();
                                                        foreach ($smm as $smms) {
                                                            if (env('IS_ORDER') == true) {
                                                                $actual_path = $server->actual_path;
                                                                $actual_server = $server->actual_server;
                                                                $quantity = $request->quantity;
                                                                $order_link = $request->link_order;
                                                                $key = $smms['key'];
                                                                $urls = $smms['url'];

                                                                // Phân tích URL và lấy host
                                                                $host = parse_url($urls, PHP_URL_HOST);
                                                                $hostParts = explode('.', $host);

                                                                // Lấy hai phần cuối của tên miền nếu có hơn hai phần
                                                                $url_name = count($hostParts) > 2 ? implode('.', array_slice($hostParts, -2)) : $host;

                                                                // So khớp actual_service với tên miền
                                                                if ($server->actual_service == $host) {
                                                                    $smmpanel = new \App\Http\Controllers\Api\Service\SmmController($urls, $key);
                                                                    $smmpanel->data = [
                                                                        'order_link' => $order_link,
                                                                        'quantity' => $quantity,
                                                                        'speed' => $request->speed ?? '0',
                                                                        'comment' => $request->comment ?? '',
                                                                        'minutes' => $request->minutes ?? '',
                                                                        'time' => $request->time ?? '',
                                                                        'reaction' => $request->reaction ?? '',
                                                                        'server_order' => $actual_server,
                                                                    ];

                                                                    // Gửi yêu cầu tạo đơn hàng
                                                                    $result = $smmpanel->CreateOrder();
                                                                    if ($result['status'] == true) {
                                                                        // Xử lý khi đơn hàng được tạo thành công
                                                                        $order_history[] = [
                                                                            'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                            'status' => 'info',
                                                                            'title' => "Đơn hàng đã hoạt động",
                                                                        ];
                                                                        $order = Orders::create([
                                                                            'username' => $user->username,
                                                                            'service_id' => $service_->id,
                                                                            'service_name' => $service_->name,
                                                                            'server_service' => $request->server_service,
                                                                            'price' => $price,
                                                                            'quantity' => $quantity,
                                                                            'total_payment' => $total_payment,
                                                                            'order_code' => '',
                                                                            'order_link' => $order_link,
                                                                            'start' => 0,
                                                                            'buff' => 0,
                                                                            'actual_service' => $server->actual_service,
                                                                            'actual_path' => $server->actual_path,
                                                                            'actual_server' => $server->actual_server,
                                                                            'status' => 'Active',
                                                                            'action' => json_encode([
                                                                                'link_order' => $order_link,
                                                                                'server_service' => $request->server_service,
                                                                                'quantity' => $quantity,
                                                                                'reaction' => $request->reaction ?? '',
                                                                                'speed' => $request->speed ?? '',
                                                                                'comment' => $request->comment ?? '',
                                                                                'minutes' => $request->minutes ?? '',
                                                                                'time' => $request->time ?? '',
                                                                            ]),
                                                                            'dataJson' => '',
                                                                            'isShow' => 1,
                                                                            'history' => json_encode([
                                                                                [
                                                                                    'status' => 'primary',
                                                                                    'title' => "Đơn hàng đã được tạo",
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

                                                                            // Thông báo đơn hàng mới qua Telegram
                                                                            if (DataSite('notice_order') == 'on' && DataSite('telegram_chat_id')) {
                                                                                $tele = new TelegramCustomController();
                                                                                $bot = $tele->bot();
                                                                                $bot->sendMessage([
                                                                                    'chat_id' => DataSite('telegram_chat_id'),
                                                                                    'text' => "🔔 Đơn hàng mới \n Từ " . $user->username . "\nDịch vụ MXH: " . $social_service->name . "\nDịch vụ: " . $service_->name . "\nServer: " . $request->server_service . "\nSố lượng: " . $quantity . "\nGiá: " . number_format($total_payment) . "đ\nLink: " . $order_link,
                                                                                ]);
                                                                            }

                                                                            // Cập nhật số dư
                                                                            $balance = $user->balance;
                                                                            $user->balance -= $total_payment;
                                                                            $user->total_deduct += $total_payment;
                                                                            $user->save();

                                                                            DataHistory::create([
                                                                                'username' => $user->username,
                                                                                'action' => 'Tạo đơn',
                                                                                'data' => $total_payment,
                                                                                'old_data' => $balance,
                                                                                'new_data' => $user->balance,
                                                                                'ip' => $request->ip(),
                                                                                'description' => $order->order_code . " | " . $service_->service_social . " | Tăng " . $quantity . " " . $service_->slug . " ở máy chủ [" . $request->server_service . "] cho ID " . $service_->service_social . ": " . $order_link . ", trừ " . number_format($total_payment) . " vnd trong tài khoản",
                                                                                'data_json' => '',
                                                                                'domain' => getDomain(),
                                                                            ]);

                                                                            return response()->json([
                                                                                'status' => 'success',
                                                                                'message' => 'Đặt hàng thành công, vui lòng kiểm tra lịch sử đơn',
                                                                                'order_id' => $order->id,
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
                                                                            'message' => $result['error'],
                                                                        ]);
                                                                    }
                                                                }
                                                            } else {
                                                                Log::error('IS_ORDER is not enabled.');
                                                                return response()->json([
                                                                    'status' => 'error',
                                                                    'message' => 'Order placement is disabled.',
                                                                ]);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => 'Server không tồn tại'
                                        ]);
                                        die();
                                    }
                                } else {
                                    switch ($service_->category) {

                                        case 'bot':
                                            $validator = [
                                                'link_order' => 'required|string',
                                                'proxy' => 'required',

                                                'timebuy' => 'required',

                                            ];
                                            break;
                                        default:
                                            $validator = [
                                                'link_order' => 'required|string',
                                                'proxy' => 'required',

                                                'timebuy' => 'required',
                                            ];
                                            break;
                                    }

                                    $valid = Validator::make($request->all(), $validator);
                                    if ($valid->fails()) {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => $valid->errors()->first()
                                        ]);
                                    } else {


                                        $price = 1000;


                                        $total_payment = $price * $request->timebuy;


                                        if ($user->balance < $total_payment) {
                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Bạn không đủ ' . number_format($total_payment) . 'đ để mua dịch vụ'
                                            ]);
                                        } else {

                                            if (env('IS_ORDER') == true) {
                                                $data_send = false;





                                                $actual_path = 'bot/create';


                                                $order_link = $request->link_order;
                                                $trumvip = new TrumvipController();
                                                $trumvip->path = $actual_path;
                                                $trumvip->data = [


                                                    'token' => $request->link_order ?? '',
                                                    'proxy' => $request->proxy ?? '',
                                                    'cookie' => $request->cookie ?? '',
                                                    'speed_to' => $request->speed_to ?? '',
                                                    'period' => $request->timebuy ?? '',
                                                    'limit_per_day' => $request->limit_per_day ?? '',
                                                    'user_id' => $request->user_id ?? '',
                                                    'country' => $request->country ?? '',


                                                    'quantity' => $request->quantity ?? '',
                                                    'target' => $request->target ?? '',
                                                    'time_end' => $request->time_end ?? '',
                                                    'time_start' => $request->time_start ?? '',
                                                    'uids[profile]' =>  $request->uidsprofile ?? '',
                                                    'uids[group]' =>  $request->uidsgroup ?? '',
                                                    'uids[page]' =>  $request->uidspage ?? '',
                                                    'timebuy' => $request->timebuy ?? '',
                                                    'limit_post' => $request->limit_post ?? '',
                                                    'speed_from' => $request->speed_from ?? '',

                                                    'black_list'   => $request->black_list ?? '',
                                                    'reaction_type'   => $request->reaction ?? '',
                                                    'stories_enable'   => $request->stories_enable ?? '',
                                                    'story_reaction_type'   => $request->story_reaction_type ?? '',
                                                    'comment_enable'   => $request->comment_enable ?? '',
                                                    'content'   => $request->content ?? '',
                                                    'sticker'   => $request->sticker ?? '',
                                                    'images'   => $request->images ?? '',
                                                    'image_link'   => $request->image_link ?? '',
                                                    'image_auto_custom_text'   => $request->image_auto_custom_text ?? '',
                                                    'notes'   => $request->notes ?? '',
                                                    'order_link' => $order_link,


                                                ];
                                                $trumvip->apiToken = DataSite1('trumvip');
                                                $result = $trumvip->CreateOrder();
                                                if ($result['status'] == true) {
                                                    $start_date = getdate1();
                                                    $days_to_add = $request->timebuy;
                                                    $order_id = $result['data']['order_id'];

                                                    $start_date_obj = Carbon::parse($start_date);

                                                    // Thêm số ngày cần thêm
                                                    $result_date = $start_date_obj->addDays($days_to_add);

                                                    // Lấy ngày kết quả dưới định dạng Y-m-d
                                                    $result_date_formatted = $result_date->format('Y-m-d');
                                                    $order = Orders::create([
                                                        'username' => $user->username,



                                                        'price' => $price,

                                                        'total_payment' => $total_payment,
                                                        'order_code' => $order_id,
                                                        'order_link' => $request->link_order,
                                                        'start' => 0,
                                                        'buff' => 0,

                                                        'service_id' =>  $service_->id,
                                                        'service_name' =>  $service_->name,
                                                        'speed' => 'ok',
                                                        'name' => $request->name,
                                                        'user_id' => $request->user_id,
                                                        'timebuy' => $request->timebuy,
                                                        'timeend' => $result_date_formatted,
                                                        'timestart' => $start_date,
                                                        'actual_service' => 'trumvip',
                                                        'proxy' => $request->proxy,
                                                        'status' => 'Active',
                                                        'action' => json_encode([
                                                            'link_order' => $request->link_order,


                                                            'reaction' => $request->reaction ?? '',

                                                        ]),
                                                        'dataJson' => '',
                                                        'isShow' => 1,
                                                        'history' => json_encode([
                                                            [
                                                                'status' => 'primary',
                                                                'title' => "Đơn hàng đã được tạo",
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
                                                        $order->order_code = $result['data']['order_id'];

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
                                                                    'text' => "🔔 Đơn hàng mới \n Từ " . $user->username . "\nDịch vụ MXH: " . $social_service->name . "\nDịch vụ: " . $service_->name . "\nServer: " . $request->server_service . "\nSố lượng: " . $request->quantity . "\nGiá: " . number_format($total_payment) . "đ\nLink: " . $request->link_order,
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
                                                            'description' => "Mua bot",
                                                            'data_json' => '',
                                                            'domain' => getDomain(),
                                                        ]);
                                                        return response()->json([
                                                            'status' => 'success',
                                                            'message' => 'Đặt hàng thành công, vui lòng kiểm tra lịch sử đơn',
                                                            'order_id' => $order->id,
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
                                                $order = Orders::create([
                                                    'username' => $user->username,



                                                    'price' => $price,

                                                    'total_payment' => $total_payment,
                                                    'order_code' => $order_id,
                                                    'order_link' => $request->link_order,
                                                    'start' => 0,
                                                    'buff' => 0,

                                                    'service_id' =>  $service_->id,
                                                    'service_name' =>  $service_->name,
                                                    'speed' => 'ok',
                                                    'name' => $request->name,
                                                    'user_id' => $request->user_id,
                                                    'timebuy' => $request->timebuy,
                                                    'timeend' => $result_date_formatted,
                                                    'timestart' => $start_date,
                                                    'actual_service' => 'trumvip',
                                                    'proxy' => $request->proxy,
                                                    'status' => 'Active',
                                                    'action' => json_encode([
                                                        'link_order' => $request->link_order,


                                                        'reaction' => $request->reaction ?? '',

                                                    ]),
                                                    'dataJson' => '',
                                                    'isShow' => 1,
                                                    'history' => json_encode([
                                                        [
                                                            'status' => 'primary',
                                                            'title' => "Đơn hàng đã được tạo",
                                                            'time' => Carbon::now()->format('H:i d/m/Y'),
                                                        ]
                                                    ]),
                                                    'note' => $request->note ?? '',
                                                    'domain' => getDomain(),
                                                ]);

                                                if ($order) {
                                                    return response()->json([
                                                        'status' => 'success',
                                                        'message' => 'Đặt hàng thành công, vui lòng kiểm tra lịch sử đơn',
                                                        'order_id' => $order->id,
                                                    ]);
                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Dịch vụ không tồn tại'
                                ]);
                                die();
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Dịch vụ Social không tồn tại'
                            ]);
                            die();
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Người dùng không tồn tại'
                    ]);
                }
            } else {
                $userdomain = SiteCon::where('domain_name', getDomain())->first();
                $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                if ($user) {
                    $valid = Validator::make($request->all(), [
                        'link_order' => 'required',
                        'server_service' => 'required',
                    ]);
                    if ($valid->fails()) {
                        return response()->json([
                            'status' => 'error',
                            'message' => $valid->errors()->first()
                        ]);
                    } else {
                        $admin = User::where('username', DataSite('username_web'))->where('domain', $userdomain['domain'])->first();
                        if ($admin) {
                            // $server_s = ServerService::where('domain', getDomain())->where('id', $request->server_service)->first();
                            $social_service = ServiceSocial::where('domain', env('PARENT_SITE'))->where('slug', $social)->first();
                            if ($social_service) {
                                $service_ = Service::where('domain', env('PARENT_SITE'))->where('slug', $service)->where('service_social', $social_service->slug)->first();
                                if ($service_) {
                                    $server = ServerService::where('domain', getDomain())->where('social_id', $social_service->id)->where('service_id', $service_->id)->where('server', $request->server_service)->first();
                                    $server_admin = ServerService::where('domain', $userdomain['domain'])->where('social_id', $social_service->id)->where('service_id', $service_->id)->where('server', $server->server)->first();

                                    if ($server && $server_admin) {
                                        if ($server->status != 'Active') {
                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Server đang bảo trì hoặc ngừng nhận đơn'
                                            ]);
                                            die();
                                        } elseif ($server_admin->status != 'Active') {
                                            return response()->json([
                                                'status' => 'error',
                                                'message' => 'Server đang bảo trì hoặc ngừng nhận đơn'
                                            ]);
                                            die();
                                        } else {
                                            switch ($service_->category) {
                                                case 'default':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                                case 'reaction':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'reaction' => 'required',
                                                    ];
                                                    break;
                                                case 'reaction-speed':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'reaction' => 'required',
                                                        'speed' => 'required',
                                                    ];
                                                    break;
                                                case 'comment':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'comment' => 'required',
                                                    ];
                                                    break;
                                                case 'comment-quantity':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'comment' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                                case 'minutes':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'minutes' => 'required',
                                                    ];
                                                    break;
                                                case 'time':
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                        'time' => 'required',
                                                    ];
                                                    break;
                                                default:
                                                    $validator = [
                                                        'link_order' => 'required',
                                                        'server_service' => 'required',
                                                        'quantity' => 'required|numeric',
                                                    ];
                                                    break;
                                            }
                                            $valid = Validator::make($request->all(), $validator);
                                            if ($valid->fails()) {
                                                return response()->json([
                                                    'status' => 'error',
                                                    'message' => $valid->errors()->first()
                                                ]);
                                            } else {
                                                if ($service_->category == 'comment') {
                                                    $quantity = count(explode("\n", $request->comment));
                                                    $request->merge(['quantity' => $quantity]);
                                                }

                                                if ($server->min > $request->quantity) {
                                                    return response()->json([
                                                        'status' => 'error',
                                                        'message' => 'Số lượng tối thiểu là ' . $server->min
                                                    ]);
                                                } elseif ($server->max < $request->quantity) {
                                                    return response()->json([
                                                        'status' => 'error',
                                                        'message' => 'Số lượng tối đa là ' . $server->max
                                                    ]);
                                                } else {
                                                    $price = priceServer($server->id, $user->level);
                                                    $price_admin = priceServer($server_admin->id, $admin->level);
                                                    $total_payment = 0;
                                                    if ($service_->category == 'minutes') {
                                                        $total_payment = $price * $request->quantity * $request->minutes;
                                                        $total_payment_admin = $price_admin * $request->quantity * $request->minutes;
                                                    } else {
                                                        $total_payment = $price * $request->quantity;
                                                        $total_payment_admin = $price_admin * $request->quantity;
                                                    }
                                                    if ($user->balance < $total_payment) {
                                                        return response()->json([
                                                            'status' => 'error',
                                                            'message' => 'Bạn không đủ ' . number_format($total_payment) . 'đ để mua dịch vụ'
                                                        ]);
                                                    } elseif ($admin->balance < $total_payment_admin) {
                                                        return response()->json([
                                                            'status' => 'error',
                                                            'message' => 'Bạn không đủ ' . number_format($total_payment) . 'đ để mua dịch vụ'
                                                        ]);
                                                    } else {
                                                        $dataArr = [
                                                            'link_order' => $request->link_order,
                                                            'server_service' => $server_admin->server,
                                                            'quantity' => $request->quantity,
                                                            'reaction' => $request->reaction ?? '',
                                                            'speed' => $request->speed ?? '',
                                                            'comment' => $request->comment ?? '',
                                                            'minutes' => $request->minutes ?? '',
                                                            'time' => $request->time ?? '',
                                                        ];
                                                        $curl = curl_init();
                                                        curl_setopt_array($curl, array(
                                                            CURLOPT_URL => 'https://' . $userdomain['domain'] . '/api/service/' . $social_service->slug . '/' . $service_->slug . '/order',
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_ENCODING => '',
                                                            CURLOPT_MAXREDIRS => 10,
                                                            CURLOPT_TIMEOUT => 0,
                                                            CURLOPT_FOLLOWLOCATION => true,
                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                            CURLOPT_CUSTOMREQUEST => 'POST',
                                                            CURLOPT_POSTFIELDS => array('link_order' => $request->link_order, 'server_service' => $server_admin->server, 'quantity' => $request->quantity, 'speed' => $request->speed, 'reaction' => $request->reaction, 'comment' => $request->comment, 'minutes' => $request->minutes),
                                                            CURLOPT_HTTPHEADER => array(
                                                                'Api-Token: ' . $admin->api_token,
                                                            ),
                                                        ));
                                                        $response1 = curl_exec($curl);
                                                        curl_close($curl);
                                                        $response = json_decode($response1, true);

                                                        if ($response['status'] == 'success') {
                                                            $order1 = Orders::create([
                                                                'username' => $user->username,
                                                                'service_id' => $service_->id,
                                                                'service_name' => $service_->name,
                                                                'server_service' => $request->server_service,
                                                                'price' => $price,
                                                                'quantity' => $request->quantity,
                                                                'total_payment' => $total_payment,
                                                                'order_code' => $response['order_id'],
                                                                'order_link' => $request->link_order,
                                                                'start' => 0,
                                                                'buff' => 0,
                                                                'actual_service' => env('PARENT_SITE'),
                                                                'actual_path' => $server_admin->actual_path,
                                                                'actual_server' => $server_admin->actual_server,
                                                                'status' => 'Active',
                                                                'action' => json_encode([
                                                                    'link_order' => $request->link_order,
                                                                    'server_service' => $request->server_service,
                                                                    'quantity' => $request->quantity,
                                                                    'reaction' => $request->reaction ?? '',
                                                                    'speed' => $request->speed ?? '',
                                                                    'comment' => $request->comment ?? '',
                                                                    'minutes' => $request->minutes ?? '',
                                                                    'time' => $request->time ?? '',
                                                                ]),
                                                                'dataJson' => '',
                                                                'isShow' => 1,
                                                                'history' => json_encode([
                                                                    [
                                                                        'status' => 'primary',
                                                                        'title' => "Đơn hàng đã được tạo",
                                                                        'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                    ]
                                                                ]),
                                                                'note' => $request->note ?? '',
                                                                'domain' => getDomain(),
                                                            ]);
                                                            if (isset($order1)) {
                                                                if ($order1) {
                                                                    $balance = $user->balance;
                                                                    $user->balance = $user->balance - $total_payment;
                                                                    $user->total_deduct = $user->total_deduct + $total_payment;
                                                                    $user->save();

                                                                    $order_history = json_decode($order1->history, true);
                                                                    $order_history[] = [
                                                                        'time' => Carbon::now()->format('H:i d/m/Y'),
                                                                        'status' => 'info',
                                                                        'title' => "Đơn hàng đang hoạt động",
                                                                    ];
                                                                    $order1->history = json_encode($order_history);
                                                                    $order1->save();
                                                                    DataHistory::create([
                                                                        'username' => $user->username,
                                                                        'action' => 'Tạo đơn',
                                                                        'data' => $total_payment,
                                                                        'old_data' => $balance,
                                                                        'new_data' => $user->balance,
                                                                        'ip' => $request->ip(),
                                                                        'description' => "" . $order1->order_code . " | " . $service_->service_social . " | Tăng " . $request->quantity . " " . $service_->slug . " ở máy chủ [" . $request->server_service . "] cho ID " . $service_->service_social . ": " . $request->link_order . ", trừ " . number_format($total_payment_admin) . " vnd trong tài khoản",
                                                                        'data_json' => '',
                                                                        'domain' => getDomain(),
                                                                    ]);
                                                                    $balance_admin = $admin->balance;
                                                                    $balance_admin = $admin->balance;
                                                                    $admin->balance = $admin->balance - $total_payment_admin;
                                                                    $admin->total_deduct = $admin->total_deduct + $total_payment_admin;
                                                                    $admin->save();

                                                                    if (DataSite('notice_order') == 'on') {
                                                                        if (DataSite('telegram_chat_id')) {
                                                                            $tele = new TelegramCustomController();
                                                                            $bot = $tele->bot();
                                                                            $bot->sendMessage([
                                                                                'chat_id' => DataSite('telegram_chat_id'),
                                                                                'text' => "🔔 Đơn hàng mới \n Từ " . $user->username . "\nDịch vụ MXH: " . $social_service->name . "\nDịch vụ: " . $service_->name . "\nServer: " . $request->server_service . "\nSố lượng: " . $request->quantity . "\nGiá: " . number_format($total_payment) . "đ\nLink: " . $request->link_order,
                                                                            ]);
                                                                        }
                                                                    }
                                                                    return response()->json([
                                                                        'status' => 'success',
                                                                        'message' => 'Đặt hàng thành công',
                                                                        'order_id' => $order1->id,
                                                                    ]);
                                                                } else {
                                                                    return response()->json([
                                                                        'status' => 'error',
                                                                        'message' => $response['message'],
                                                                    ]);
                                                                }
                                                            } else {
                                                                return response()->json([
                                                                    'status' => 'error',
                                                                    'message' => $response['message'],
                                                                ]);
                                                            }
                                                        } else {

                                                            return response()->json([
                                                                'status' => 'error',
                                                                'message' => $response['message'],
                                                            ]);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => 'Dịch vụ không tồn tại!'
                                        ]);
                                    }
                                }
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Máy chủ không tồn tại!'
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Đã có lỗi xảy ra vui lòng liên hệ admin!'
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Người dùng không tồn tại'
                    ]);
                }
            }
        }
    }
}
