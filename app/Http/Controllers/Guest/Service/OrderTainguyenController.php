<?php

namespace App\Http\Controllers\Guest\Service;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TeleCustomController;
use App\Http\Controllers\Custom\TeleconCustomController;
use App\Models\DataHistory;
use App\Models\OrderTainguyen;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\Category;
use App\Models\Tainguyen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\PHP;


class OrderTainguyenController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('xss');
    } */

    public function createOrder($chuyenmuc, Request $request)
    {
        $api_token = $request->header('Api-token');
        if (empty($api_token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Api token is required'
            ]);
        } else {
            $valid = Validator::make($request->all(), [
                'quantity' => 'required|numeric',
            ],  [
     
                'quantity.required' => 'Vui lòng nhập số lượng cần mua.',
            ]);
            if ($valid->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $valid->errors()->first()
                ]);
            } else {
            $tranCode = DataSite('cuphap')."_LT".rand(100000000, 999999999);
            
                $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                if ($user) {
                    $category = Category::where('domain', getDomain())->where('slug', $chuyenmuc)->first();
                    if ($category) {
                        $tainguyen = Tainguyen::where('domain', getDomain())->where('category_id', $category->id)->first();
                        if ($tainguyen) {
                            $server= Tainguyen::where('domain', getDomain())->where('category_id', $category->id)->where('id', $request->id_tainguyen)->first();
                            if($server){
                                
                                 $count= count(array_filter(explode("\n", trim($server->thongtin)), 'strlen'));
                                
                                if ($count < $request->quantity) {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => 'Số lượng hiện chỉ còn '. $count
                                    ]);
                                }
                                else{
                                $price = priceServer1($server->id, $user->level);
                             
                                
                                $total_payment = $price * $request->quantity;
                             
                                if ($user->balance < $total_payment) {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => 'Bạn không đủ '.number_format($total_payment).'đ để mua tài nguyên'
                                    ]);
                                } else {
                                    $thongtin = $server->thongtin;

                                  
                                    $lines = explode("\n", $thongtin);
                                    $firstTwoLines = array_slice($lines, 0, $request->quantity);

                            // Ghép mảng thành chuỗi lại
                            $newThongtin1 = implode("\n", $firstTwoLines);
                                    $modifiedLines = array_slice($lines, $request->quantity);
                                    $newThongtin = implode("\n", $modifiedLines);
                                    $server->thongtin = $newThongtin;
                                    $server->daban =  $server->daban + $request->quantity;
                                    $order = OrderTainguyen::create([
                                        'username' => $user->username,
                                        
                                        'thongtin' => $newThongtin1,
                                        'total_payment' => $total_payment,
                                        'order_codes' => $tranCode,
                                        'daban' => $request->quantity,
                                        'domain' => getDomain(),
                                    ]);
                                    $server->save();
                                    if ($order) {
                                 
                                         
                                     
                                        $message = '
┣➤ Tài Khoản: ' . $user->username . '
┣➤ Hành Động: Mua Hàng
┣➤ Đơn Hàng: ' . ucwords($server->name) . '
┣➤ Dịch Vụ: ' . ucwords($category->name) . '
┣➤ Mã Đơn: ' . $tranCode . '
┣➤ Thanh Toán: ' . number_format($total_payment) . 'đ'.'
┣➤ Thời Gian: ' . Carbon::now()->format('H:i d/m/Y') . '
┣➤ Địa Chỉ IP: ' . $request->ip() . '
';
                                        if (DataSite('notice_order') == 'on') {
                                            if (DataSite('telegram_chat_id')) {
                                                $tele = new TeleCustomController();
                                                $bot = $tele->bot1();
                                                $bot->sendMessage([
                                                    'chat_id' => DataSite('telegram_chat_id'),
                                                    'text' => $message,
                                                ]);
                                            }
                                        }
                                        $balance = $user->balance;
                                        $user->balance = $user->balance - $total_payment;
                                        $user->total_deduct = $user->total_deduct + $total_payment;
                                        $user->save();
                                        DataHistory::create([
                                            'username' => $user->username,
                                            'action' => 'Mua tài nguyên',
                                            'data' => $total_payment,
                                            'old_data' => $balance,
                                            'new_data' => $user->balance,
                                            'ip' => $request->ip(),
                                            'description' => "Tạo đơn hàng " . $category->name . "với giá " . number_format($total_payment) . "đ",
                                            'data_json' => '',
                                            'domain' => getDomain(),
                                        ]);
                                        return response()->json([
                                            'status' => 'success',
                                            'message' => 'Đặt hàng thành công',
                                            'order_id' => $order->order_codes,
                                        ]);
                                    } else {
                                        return response()->json([
                                            'status' => 'error',
                                            'message' => 'Đặt hàng thất bại',
                                        ]);
                                    }
                                }
                            }
                        }
                            else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => 'Tài nguyên không tồn tại'
                                ]);
                                die();
                            }
                            
                        }
                        else {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Tài nguyên không tồn tại1'
                            ]);
                            die();
                        }
                    }
                     else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Chuyên mục không tồn tại'
                        ]);
                        die();
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