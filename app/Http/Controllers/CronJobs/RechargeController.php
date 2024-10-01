<?php

namespace App\Http\Controllers\CronJobs;

// use App\Console\Commands\RechargeCard;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Models\DataHistory;
use App\Models\HistoryCard;
use App\Models\User;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    public function RechargeCard(Request $request)
    {
        if (isset($request->status)) {
            $status = $request->status;
            $code = $request->code;
            $serial = $request->serial;
 
            $trans_id = $request->trans_id;

            $callback_sign = $request->callback_sign;

            $cardRecharge = HistoryCard::where('tranid', $trans_id)->first();
            if ($cardRecharge) {
                $amount = $cardRecharge->card_amount;
                $card_discount = DataSite('card_discount');
                $sign = md5(DataSite('partner_key') .  $code . $serial);
                if ($sign == $callback_sign) {
                    if ($status == 1 && $amount > 0) {
                        $tiennhan = $amount - ($amount * $card_discount / 100);
                        $user = User::where('username', $cardRecharge->username)->first();
                        if ($user) {
                            DataHistory::create([
                                'username' => $user->username,
                                'action' => 'Nạp thẻ',
                                'data' => $tiennhan,
                                'old_data' => $user->balance,
                                'new_data' => $user->balance + $tiennhan,
                                'description' => "Tài khoản đã nạp thẻ $code mệnh giá $amount và thực nhận được $tiennhan",
                                'ip' => $request->ip(),
                                'dataJson' => json_encode($request->all()),
                                'domain' => $user->domain
                            ]);

                            $user->balance = $user->balance + $tiennhan;
                            $user->total_recharge = $user->total_recharge + $tiennhan;
                            $user->save();

                            $cardRecharge->discount = $card_discount;
                            $cardRecharge->card_real_amount = $tiennhan;
                            $cardRecharge->status = 'Success';
                            $cardRecharge->save();
                                 if (DataSite('telegram_token_tb') != ""){
                                            $tele = new TelegramCustomController();
                            $bot = $tele->bot();
                         $bot->sendMessage([
                             'chat_id' => DataSite('telegram_chat_id'),
                        'text' =>DataSite('domain')."\n"."🔔 Thông báo nạp tiền.\n" ."Tài khoản:".$user->username."\n". "Thể loại: Thẻ cào \n"."Nội dung:Tài khoản đã nạp thẻ $code mệnh giá $amount và thực nhận được $tiennhan". "\nThời gian: " . now(),
                            ]);
                                            }
                        }
                    } else {
                        $cardRecharge->status = 'Error';
                        $cardRecharge->save();
                    }
                }
            }
        }
    }
}
