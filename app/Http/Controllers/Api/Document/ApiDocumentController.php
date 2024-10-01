<?php

namespace App\Http\Controllers\Api\Document;

use App\Http\Controllers\Api\Serivce\Hacklike17Controller;
use App\Http\Controllers\Api\Serivce\OneDgController;
use App\Http\Controllers\Api\Serivce\SaintPanelController;
use App\Http\Controllers\Api\Serivce\SubmetaController;
use App\Http\Controllers\Api\Serivce\TwoMxhController;
use App\Http\Controllers\Api\Serivce\TrumsubreController;
use App\Http\Controllers\Api\Serivce\SubgiareController;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetOrderResource;
use App\Http\Resources\ServicePriceResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Custom\TeleCustomController;
use App\Models\DataHistory;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\Service;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiDocumentController extends Controller
{
    public $user;

    // public function __construct(Request $request)
    // {
    //     $this->user = $request->user;
    // }

    public function me(Request $request)
    {
        return new UserResource($request->user);
        // var_dump($request->user);
    }

    public function servicePrices(Request $request)
    {
        $server_service = ServerService::where('domain', env('PARENT_SITE'))->get();
        $arr = [];
        foreach ($server_service as $sv) {
            $arr[] = [
                'id' => $sv->id,
                'name' => Service::find($sv->service_id)->name,
                'server' => $sv->server,
                'price' => priceServer($sv->id, $request->user->level),
                'min' => $sv->min,
                'max' => $sv->max,
                'title' => $sv->title,
                'description' => $sv->description,
                'status' => $sv->status,
            ];
        }
        return response()->json([
            'status' => 'success',
            'message' => "Lấy dữ liệu thành công!",
            'data' => $arr
        ]);
    }

    public function getOrders(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
            ]);
        } else {
            $order = Orders::where('username', $request->user->username)->where('id', $request->order_id)->first();
            if ($order) {
                return new GetOrderResource($order);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tìm thấy đơn hàng!",
                ]);
            }
        }
    }
    
    public function orderSpeed(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
            ]);
        } else {
            $order = Orders::where('username', $request->user->username)->where('id', $request->order_id)->first();
          
            if ($order) {
               
                    if ($order->status == 'Refunded') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã được bảo hành!",
                        ]);
                    }elseif ($order->status == 'Failed') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã thất bại không thể bảo hành!",
                        ]);
                    } elseif ($order->status == 'Cancelled') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hủy không thể bảo hành!",
                        ]);
                    } elseif ($order->status == 'Success') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hoàn thành không thể tăng tốc!",
                        ]);
                    } else {
                        if ($request->user->balance < 1500) {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => "Số dư không đủ để tăng tốc đơn!",
                                ]);
                            } else {
                   
                            if ($order->actual_service == 'trumsubre') {
                                $w = new TrumsubreController();
                        $actual_path = $order->actual_path;
                               $actual_server = $order->actual_server;
                                $w->path = $actual_path;
                                $data = $w->speed($order->order_code);
                                    if (isset($data['status'])){
                                if ($data['status'] == 200 || $data['status'] == true ) {
                                    $order->status = 'Active';
                                    $order->save();
                                    $user = User::find($request->user->id);
                               
                                        $user->balance = $user->balance - 1500;
                                        $user->total_deduct = $user->total_deduct + 1500;
                                        $user->save();
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => $data['message'],
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' =>  $data['message'],
                                    ]);
                                }
                                    }
                                    else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => 'Vui lòng thử lại sau',
                                    ]);
                                }
                            }
                            elseif ($order->actual_service == 'subgiare') {
                                $w = new SubgiareController();
                             $actual_path = $order->actual_path;
                               $actual_server = $order->actual_server;
                                $w->path = $actual_path;
                                $data = $w->speed($order->order_code);
                                    if (isset($data['status'])){
                                if ($data['status'] == true ) {
                                    $order->status = 'Active';
                                    $order->save();
                                         $user = User::find($request->user->id);
                               
                                        $user->balance = $user->balance - 1500;
                                        $user->total_deduct = $user->total_deduct + 1500;
                                        $user->save();
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => $data['message'],
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' =>  $data['message'],
                                    ]);
                                }
                                    }
                                    else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => 'Vui lòng thử lại sau ',
                                    ]);
                                }
                            }
                           
                            }
                    }
                
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tìm thấy đơn hàng!",
                ]);
            }
        }
    }
    
    public function orderGiahan(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
            ]);
        } else {
            $order = Orders::where('username', $request->user->username)->where('id', $request->order_id)->first();
            if ($order) {
                
                
                    
                            if ($request->user->balance < 1000) {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => "Số dư không đủ để hoàn tiền!",
                                ]);
                            } else {
                                if ($order->actual_service == 'trumvip') {
                                    $trumvip = new TrumvipController();
                                    $data = $trumvip->giahanbot($order->order_code);
                                    if ($data['success'] == true) {
                                        $start_date=$order->timeend;
                                        $days_to_add = 30;
                                        

                                        $start_date_obj = Carbon::parse($start_date);

                                                        // Thêm số ngày cần thêm
                                        $result_date = $start_date_obj->addDays($days_to_add);
                                                        
                                                        // Lấy ngày kết quả dưới định dạng Y-m-d
                                        $result_date_formatted = $result_date->format('Y-m-d');
                                        $quantity = 30;
                                         
                                        $price = 1000;
                                       
                                        $giahan = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance - $giahan;
                                         
                                       
                                       
                                        $user->total_deduct = $user->total_deduct + $giahan;
                                        $user->save();
                                         
                                        $order->timeend = $result_date_formatted;
                                        $order->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => "Gia hạn bot thêm 30 ngày thành công!",
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Gia hạn bot thêm 30 ngày thất bại!",
                                        ]);
                                    }
                                }  
                                  else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => "Gia hạn bot thêm 30 ngày thất bại!",
                                    ]);
                                }
                            }
                        
                    
                
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tìm thấy đơn hàng!",
                ]);
            }
        }
    }
    public function orderRefund(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
            ]);
        } else {
            $order = Orders::where('username', $request->user->username)->where('id', $request->order_id)->first();
            if ($order) {
                $server_service = ServerService::find($order->server_service);
                if ($server_service) {
                    if ($order->status == 'Refunded') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã được hoàn tiền!",
                        ]);
                    } elseif ($order->status == 'Success') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hoàn thành không thể hoàn tiền!",
                        ]);
                    } elseif ($order->status == 'Failed') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã thất bại không thể hoàn tiền!",
                        ]);
                    } elseif ($order->status == 'Cancelled') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hủy không thể hoàn tiền!",
                        ]);
                    } elseif ($order->status == 'Completed') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hoàn thành không thể hoàn tiền!",
                        ]);
                    } else {
                        if ($server_service->order_type == 'refund') {
                            if ($request->user->balance <= 10) {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => "Số dư không đủ để hoàn tiền!",
                                ]);
                            } else {
                                if ($order->actual_service == 'hacklike17') {
                                    $hacklike = new Hacklike17Controller();
                                    $data = $hacklike->refundOrder($order->order_code);
                                    if ($data['status']) {
                                        $quantity = $order->quantity;
                                        $buff = $order->buff;
                                        $price = $order->price;
                                        $quantity = $quantity - $buff;
                                        $refund = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                        $user->balance = $user->balance - 0;
                                        $user->total_deduct = $user->total_deduct + 0;
                                        $user->save();
                                        $order->status = 'Refunded';
                                        $order->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => "Đơn hàng hoàn tiền thành công!",
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Đơn hàng hoàn tiền thất bại!",
                                        ]);
                                    }
                                } elseif ($order->actual_service == '2mxh') {
                                    $mxh = new TwoMxhController();
                                $mxh->path = $order->actual_path;
                                $mxh->apiToken = DataSite1('twomxh');
                                $order_code = $order->order_code;
                                $data1 = $mxh->order($order_code);
                  
                    
                                    $w = new TwoMxhController();
                                    $w->apiToken=DataSite1('twomxh');
                                    $data = $w->orderRefund($order->order_code);
                                    if ($data['status']==200) {
                                        
                                        $quantity = $order->quantity;
                                        $buff = $data1['data'][0]['success_count'];
                                        $price = $order->price;
                                        $quantity11 = $quantity - $buff;
                                        $refund = $quantity11 * $price;
                                        $cod=$order->order_code;
                                        $user = User::find($request->user->id);
                                            $tele = new TeleCustomController();
                                                                            $bot1 = $tele->bot1();
                                                                            $bot1->sendMessage([
                                                                                'chat_id' => DataSite('telegram_chat_id'),
                                                                                'text' => "🔔 Hoàn tiền đơn hàng \n Từ " . $user->username . "\nHoàn tiền đơn #$cod (đã chạy $buff/$quantity); phí 0 ₫"]);
                                         DataHistory::create([
                                                                        'username' => $user->username,
                                                                        'action' => 'Hoàn tiền',
                                                                        'data' => $refund,
                                                                        'old_data' => $user->balance,
                                                                        'new_data' => $user->balance + $refund,
                                                                        'ip' => '',
                                                                        'description' => "Hoàn tiền đơn #$cod (đã chạy $buff/$quantity); phí 0 ₫",
                                                                        'data_json' => '',
                                                                        'domain' => getDomain(),
                                                                    ]);
                                                                
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => $data['message'],
                                        ]);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                       $user->balance = $user->balance - 100;
                                        $user->total_deduct = $user->total_deduct + 100;
                                        $user->save();
                                        
                                        
                                        $order->status = 'Refunded';
                                        $order->save();
                                        
                                       
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Đơn hàng #$cod không hỗ trợ thao tác này",
                                        ]);
                                    }
                                } elseif ($order->actual_service == 'submeta') {
                                    $m = new SubmetaController();
                                    $data = $m->cancelOrder($order->order_code);
                                    // var_dump($data);
                                    if($data['success']){
                                        $quantity = $order->quantity;
                                        $buff = $order->buff;
                                        $price = $order->price;
                                        $quantity = $quantity - $buff;
                                        $refund = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                        $user->balance = $user->balance - 1000;
                                        $user->total_deduct = $user->total_deduct + 1000;
                                        $user->save();
                                        $order->status = 'Refunded';
                                        $order->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => "Đơn hàng hoàn tiền thành công!",
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Đơn hàng hoàn tiền thất bại!",
                                        ]);
                                    }
                                } elseif ($order->actual_service == '1dg') {
                                    $d = new OneDgController();
                                    $data = $d->refill($order->order_code);
                                    if (isset($data['refill'])) {
                                        $quantity = $order->quantity;
                                        $buff = $order->buff;
                                        $price = $order->price;
                                        $quantity = $quantity - $buff;
                                        $refund = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                        $user->balance = $user->balance - 1000;
                                        $user->total_deduct = $user->total_deduct + 1000;
                                        $user->save();
                                        $order->status = 'Refunded';
                                        $order->refund = $data['refill'];
                                        $order->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => "Đơn hàng hoàn tiền thành công!",
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => $data['error'],
                                        ]);
                                    }
                                } elseif ($order->actual_service == 'sainpanel') {
                                    $s = new SaintPanelController();
                                    $data = $s->refill($order->order_code);

                                    if (isset($data['refill'])) {
                                        $quantity = $order->quantity;
                                        $buff = $order->buff;
                                        $price = $order->price;
                                        $quantity = $quantity - $buff;
                                        $refund = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                        $user->balance = $user->balance - 1000;
                                        $user->total_deduct = $user->total_deduct + 1000;
                                        $user->save();
                                        $order->status = 'Refunded';
                                        $order->refund = $data['refill'];
                                        $order->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => "Đơn hàng hoàn tiền thành công!",
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Đơn hàng #$order->order_code không hỗ trợ thao tác này",
                                        ]);
                                    }
                                } else {
                                    $order1 = Orders::where('id', $order->order_code)->first();
                                    $w = new TwoMxhController();
                                    $w->apiToken=DataSite1('twomxh');
                                    $data = $w->orderRefund($order1->order_code);
                                    if ($data['status']==200) {
                                        $quantity = $order->quantity;
                                        $buff = $order->buff;
                                        $price = $order->price;
                                        $quantity = $order1->quantity;
                                        $buff = $order1->buff;
                                        $price = $order1->price;
                                        $quantity = $quantity - $buff;
                                        $refund = $quantity * $price;
                                        $user = User::find($request->user->id);
                                        $user->balance = $user->balance + $refund;
                                        $user->total_deduct = $user->total_deduct - $refund;
                                        $user->save();
                                        $user->balance = $user->balance - 1000;
                                        $user->total_deduct = $user->total_deduct + 1000;
                                        $user->save();
                                        $order->status = 'Refunded';
                                        $order->save();
                                        $order1->status = 'Refunded';
                                        $order1->save();
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => $data['message'],
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => "Đơn hàng #$order->order_code không hỗ trợ thao tác này",
                                        ]);
                                    }
                                }
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => "Máy chủ không hỗ trợ hoàn tiền!",
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Không tìm thấy dịch vụ!",
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tìm thấy đơn hàng!",
                ]);
            }
        }
    }

    public function orderWarranty(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
            ]);
        } else {
            $order = Orders::where('username', $request->user->username)->where('id', $request->order_id)->first();
            if ($order) {
                $server_service = ServerService::find($order->server_service);
                if ($server_service) {
                    if ($order->status == 'Refunded') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã được bảo hành!",
                        ]);
                    }elseif ($order->status == 'Failed') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã thất bại không thể bảo hành!",
                        ]);
                    } elseif ($order->status == 'Cancelled') {
                        return response()->json([
                            'status' => 'error',
                            'message' => "Đơn hàng đã hủy không thể bảo hành!",
                        ]);
                    } else {
                        if ($server_service->warranty == 'yes') {
                            if ($order->actual_service == '2mxh') {
                                $w = new TwoMxhController();
                                $w->apiToken=DataSite1('twomxh');
                                $data = $w->warranty($order->order_code);
                                if ($data['status'] ==200) {
                                    $order->status = 'Active';
                                    $order->save();
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => $data['message'],
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => "Đơn hàng #$order->order_code không hỗ trợ thao tác này",
                                    ]);
                                }
                            }
                            else{
                                $order1 = Orders::where('id', $order->order_code)->first();
                                $w = new TwoMxhController();
                                $w->apiToken=DataSite1('twomxh');
                                
                                $data = $w->warranty($order1->order_code);
                                if ($data['status'] ==200) {
                                    $order->status = 'Warranty';
                                    $order->save();
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => $data['message'],
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => "Đơn hàng #$order->order_code không hỗ trợ thao tác này",
                                    ]);
                                }
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => "Máy chủ không hỗ trợ bảo hành!",
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Không tìm thấy dịch vụ!",
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tìm thấy đơn hàng!",
                ]);
            }
        }
    }
    
    
    
    
    
    
    
}
