<?php

namespace App\Http\Controllers\CronJobs;

use App\Http\Controllers\Controller;
use App\Models\HistoryRecharge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MBBankController extends Controller
{
    public function rechargeMBBank() {
        $curl = json_decode(Http::get('https://api.sieuthicode.net/historyapimbbank/'.env('TOKEN_LOCALBANK').''), true);
        $codeId = DataSite('code_tranfer');

        if($curl['status'] === 'success') {
            foreach($curl['TranList'] as $transaction) {
                $comment        = $transaction['description'];             // NỘI DUNG CHUYỂN TIỀN
                $tranId         = $transaction['tranId'];                  // MÃ GIAO DỊCH
                $amount         = $transaction['creditAmount'];            // SỐ TIỀN CHUYỂN
                $tranId         = str_replace(' - ', '', $tranId);
                $comment        = strtolower($comment);
                $biller         = strpos($comment, $codeId);
    
                if($amount >= DataSite('min_recharge') - 1) {
                    if ($biller !== false) {
                        $ch1 = explode($codeId, $comment);
                        $ch1 = strtolower($ch1[1]);
                        $ch1 = str_replace("\n", "", $ch1);
                        $ch2 = explode('.', $ch1);
                        $ch1 = $ch2[0];
                        $ch2 = explode(' ', $ch1);
                        $id = $ch2[0];
    
                        $user = User::find($id);
    
                    }
    
                    if($user) {
                        $checkTran      = HistoryRecharge::where('tranid', $tranId)->first();
                        $startReward    = Carbon::createFromFormat('Y-m-d', DataSite('start_promotion'));
                        $stopsReward    = Carbon::createFromFormat('Y-m-d', DataSite('end_promotion'));
                        $timeDate       = Carbon::now();
                        if($timeDate->between($startReward, $stopsReward)) {
                            $reward = $amount * DataSite('recharge_promotion') / 100;
                        } else {
                            $reward = 0;
                        }
                        if(!$checkTran) {
                            $banking = new HistoryRecharge;
                            $banking->username = $user->username;
                            $banking->name_bank = "MB Bank";
                            $banking->type_bank = "auto";
                            $banking->tranid = $tranId;
                            $banking->amount = $amount;
                            $banking->promotion = $reward;
                            $banking->real_amount = $amount + $reward;
                            $banking->status = "Completed";
                            $banking->note = $comment;
                            $banking->created_at = Carbon::now();
                            $banking->updated_at = Carbon::now();
                            $banking->domain = request()->getHost();
                            $banking->save();
    
                            $user->balance = $user->balance + $amount + $reward;
                            $user->total_recharge = $user->total_recharge + $amount + $reward;
                            $user->save();
                        }
                    }
                }
            }
        } else {
            return $curl;
        }
    }
}
