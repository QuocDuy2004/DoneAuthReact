<?php

namespace App\Console\Commands;

use App\Models\AccountRecharge;
use App\Models\DataHistory;
use App\Http\Controllers\Custom\TeleCustomController;
use App\Models\SiteData;
use App\Models\User;
use Illuminate\Console\Command;
use App\Models\HistoryRecharge;
use Illuminate\Support\Carbon;

class RechargeTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recharge:transfer {bank} {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recharge transfer to bank';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bank = $this->argument('bank');
        $domain = $this->argument('domain');
        $account = AccountRecharge::where('type', $bank)->where('domain', $domain)->first();
        if ($account) {
            $api_token = $account->api_token;
            
            $stk = $account->account_number;
             $password = $account->password;
            $SiteData = SiteData::where('domain', $domain)->first();
            $code_tranfer = $SiteData->code_tranfer;
            if ($account->type == 'mbbank') {
                $ch = curl_init('https://api.sieuthicode.net/historyapimbbank/'.$api_token);
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                print_r($response);
                $result = json_decode($response, true);
                
                        $count = 0;
                        if(isset($result['TranList'])){
                        foreach ($result['TranList'] as $key => $item) { 
                            $refNo = $item['refNo'];
                            $description = $item['description'];
                            $creditAmount = $item['creditAmount'];
                            $debitAmount = $item['debitAmount'];
                            $description1 = str_replace(" ", "", $description);
                            if ($creditAmount >= 10000) {
                                $checkId = strpos($description1, $code_tranfer);
                                if ($checkId !== false) {
                                    $ch1 = explode($code_tranfer, $description1);
                                    $ch1 = strtolower($ch1[1]);
                                    $ch1 = str_replace("\n", "", $ch1);
                                    $ch2 = explode('.', $ch1);
                                    $ch1 = $ch2[0];
                                    $ch2 = explode(' ', $ch1);
                                    $idUser = $ch2[0];
                                    //name bank
                                    $name = "Không xác định";
                                    $user = User::where('id', $idUser)
            ->orWhere('id',$ch1)
            ->first();
                                    if ($user) {
                                        $refNo = base64_encode($refNo);
                                        $checkTranid = HistoryRecharge::where('tranid', $refNo)->first();
                                        if ($checkTranid) {
                                            continue;
                                        } else {
                                            $balance = $user->balance;
                                            $recharge_promotion = $SiteData->recharge_promotion;
                                            $start_promotion = $SiteData->start_promotion;
                                            $end_promotion = $SiteData->end_promotion;

                                            $promotion = 0;
                                            if (strtotime($start_promotion) <= strtotime(date('Y-m-d')) && strtotime($end_promotion) >= strtotime(date('Y-m-d'))) {
                                                $recharge_promotion = $SiteData->recharge_promotion;
                                                $promotion = $creditAmount * $recharge_promotion / 100;
                                                $amount = $creditAmount + $promotion;
                                            } else {
                                                $amount = $creditAmount;
                                                $recharge_promotion = 0;
                                            }
                                               $user11 = User::where('id', $user->ref_id)->first();
                                              
                                          
                                            if($user11){
                                                 $amount2=$creditAmount * 0.05;
                                            DataHistory::create([
                                                'username' => $user11->username,
                                                'action' => 'Hoa hồng',
                                                'data' => $amount2,
                                                'old_data' => $user11->balance,
                                                'new_data' => $user11->balance + $amount2,
                                                'ip' => $user11->ip,
                                                'description' => "Tài khoản ".$user->username." nạp " . number_format($creditAmount) . " và bạn nhận được số tiền hoa hồng là ".$amount2." VNĐ",
                                                'domain' => $user11->domain,
                                            ]);
                                                $user11->update([
                                                    'referral_money' => $user11->referral_money + ($creditAmount * 0.05)
                                                ]);
                                                $user11->balance = $user11->balance + $amount2;
                                                $user11->save();

                                            }
                                            
                                            DataHistory::create([
                                                'username' => $user->username,
                                                'action' => 'Nạp tiền',
                                                'data' => $amount,
                                                'old_data' => $balance,
                                                'new_data' => $user->balance + $amount,
                                                'ip' => $user->ip,
                                                'description' => "Nạp tiền qua Mbbank với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ",
                                                'domain' => $user->domain,
                                            ]);
                                            
                                            HistoryRecharge::create([
                                                'username' => $user->username,
                                                'name_bank' => $name ?? 'Không xác định',
                                                'type_bank' => 'mbbank',
                                                'tranid' => $refNo,
                                                'amount' => $creditAmount,
                                                'promotion' => $recharge_promotion,
                                                'real_amount' => $amount,
                                                'status' => 'Success',
                                                'note' => $description,
                                                'domain' => $user->domain,
                                            ]);
                                            // echo $creditAmount;
                                            $user->balance = $user->balance + $amount;
                                            $user->total_recharge = $user->total_recharge + $amount;
                                            
                                            $user->save();
                                            $count++;
                                            if (DataSite('telegram_token_tb') != ""){
                                            $tele1 = new TeleCustomController();
                            $bot1 = $tele1->bot1();
                         $bot1->sendMessage([
                             'chat_id' => DataSite('telegram_chat_id'),
                        'text' =>DataSite('domain')."\n"."🔔 Thông báo nạp tiền.\n" ."Tài khoản:".$user->username."\n". "Thể loại: Mbbank\n"."Nội dung:Nạp tiền qua Mbbank với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ\n". "Thời gian: " . now(),
                            ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $this->info('Nạp thành công ' . $count . ' tài khoản');
                        }
                        
                     }else if ($account->type == 'vietcombank') {
                $ch = curl_init('https://api.sieuthicode.net/historyapivcb/'.$api_token);
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                print_r($response);
                $result = json_decode($response, true);
                
                        $count = 0;
                        if(isset($result['TranList'])){
                        foreach ($result['TranList'] as $key => $item) { 
                            $refNo = $item['refNo'];
                            $description = $item['description'];
                            $creditAmount = $item['creditAmount'];
                            $debitAmount = $item['debitAmount'];
                            $description1 = str_replace(" ", "", $description);
                            if ($creditAmount >= 10000) {
                                $checkId = strpos($description1, $code_tranfer);
                                if ($checkId !== false) {
                                    $ch1 = explode($code_tranfer, $description1);
                                    $ch1 = strtolower($ch1[1]);
                                    $ch1 = str_replace("\n", "", $ch1);
                                    $ch2 = explode('.', $ch1);
                                    $ch1 = $ch2[0];
                                    $ch2 = explode(' ', $ch1);
                                    $idUser = $ch2[0];
                                    //name bank
                                    $name = "Không xác định";
                                    $user = User::where('id', $idUser)
            ->orWhere('id',$ch1)
            ->first();
                                    if ($user) {
                                        $refNo = base64_encode($refNo);
                                        $checkTranid = HistoryRecharge::where('tranid', $refNo)->first();
                                        if ($checkTranid) {
                                            continue;
                                        } else {
                                            $balance = $user->balance;
                                            $recharge_promotion = $SiteData->recharge_promotion;
                                            $start_promotion = $SiteData->start_promotion;
                                            $end_promotion = $SiteData->end_promotion;

                                            $promotion = 0;
                                            if (strtotime($start_promotion) <= strtotime(date('Y-m-d')) && strtotime($end_promotion) >= strtotime(date('Y-m-d'))) {
                                                $recharge_promotion = $SiteData->recharge_promotion;
                                                $promotion = $creditAmount * $recharge_promotion / 100;
                                                $amount = $creditAmount + $promotion;
                                            } else {
                                                $amount = $creditAmount;
                                                $recharge_promotion = 0;
                                            }
                                             $user11 = User::where('id', $user->ref_id)->first();
                                              
                                          
                                            if($user11){
                                                 $amount2=$creditAmount * 0.05;
                                            DataHistory::create([
                                                'username' => $user11->username,
                                                'action' => 'Hoa hồng',
                                                'data' => $amount2,
                                                'old_data' => $user11->balance,
                                                'new_data' => $user11->balance + $amount2,
                                                'ip' => $user11->ip,
                                                'description' => "Tài khoản ".$user->username." nạp " . number_format($creditAmount) . " và bạn nhận được số tiền hoa hồng là ".$amount2." VNĐ",
                                                'domain' => $user11->domain,
                                            ]);
                                                $user11->update([
                                                    'referral_money' => $user11->referral_money + ($creditAmount * 0.05)
                                                ]);
                                                $user11->balance = $user11->balance + $amount2;
                                                $user11->save();

                                            }
                                            
                                            
                                            DataHistory::create([
                                                'username' => $user->username,
                                                'action' => 'Nạp tiền',
                                                'data' => $amount,
                                                'old_data' => $balance,
                                                'new_data' => $user->balance + $amount,
                                                'ip' => $user->ip,
                                                'description' => "Nạp tiền qua Vietcombank với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ",
                                                'domain' => $user->domain,
                                            ]);
                                            HistoryRecharge::create([
                                                'username' => $user->username,
                                                'name_bank' => $name ?? 'Không xác định',
                                                'type_bank' => 'vcb',
                                                'tranid' => $refNo,
                                                'amount' => $creditAmount,
                                                'promotion' => $recharge_promotion,
                                                'real_amount' => $amount,
                                                'status' => 'Success',
                                                'note' => $description,
                                                'domain' => $user->domain,
                                            ]);
                                            // echo $creditAmount;
                                            $user->balance = $user->balance + $amount;
                                            $user->total_recharge = $user->total_recharge + $amount;
                                            
                                            $user->save();
                                            $count++;
                                            if (DataSite('telegram_token_tb') != ""){
                                            $tele1 = new TeleCustomController();
                            $bot1 = $tele1->bot1();
                         $bot1->sendMessage([
                             'chat_id' => DataSite('telegram_chat_id'),
                        'text' =>DataSite('domain')."\n"."🔔 Thông báo nạp tiền.\n" ."Tài khoản:".$user->username."\n". "Thể loại: Vietcombank\n"."Nội dung:Nạp tiền qua Vietcombank với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ\n". "Thời gian: " . now(),
                            ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $this->info('Nạp thành công ' . $count . ' tài khoản');
                        }
                     }
                else if ($account->type == 'acb') {
                $ch = curl_init('https://api.sieuthicode.net/historyapiacb/'.$api_token);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            
                print_r($response);
                $result = json_decode($response, true);
                if(isset($result['codeStatus'])){
                if ($result['codeStatus']==200){
                        $count = 0;
                        foreach ($result['data'] as $key => $item) { 
                            $refNo = $item['transactionNumber'];
                            $description = $item['description'];
                            $creditAmount = $item['amount'];
                            
                            $description1 = str_replace(" ", "", $description);
                            if ($item['type'] == 'IN') {
                                $checkId = strpos($description1, $code_tranfer);
                                if ($checkId !== false) {
                                    $ch1 = explode($code_tranfer, $description1);
                                    $ch1 = strtolower($ch1[1]);
                                    $ch1 = str_replace("\n", "", $ch1);
                                    $ch2 = explode('.', $ch1);
                                    $ch1 = $ch2[0];
                                    $ch2 = explode(' ', $ch1);
                                    $idUser = $ch2[0];
                                    //name bank
                                    $name = "Không xác định";
                                    $user = User::where('id', $idUser)
            ->orWhere('id',$ch1)
            ->first();
                                    if ($user) {
                                        $refNo = base64_encode($refNo);
                                        $checkTranid = HistoryRecharge::where('tranid', $refNo)->first();
                                        if ($checkTranid) {
                                            continue;
                                        } else {
                                            $balance = $user->balance;
                                            $recharge_promotion = $SiteData->recharge_promotion;
                                            $start_promotion = $SiteData->start_promotion;
                                            $end_promotion = $SiteData->end_promotion;

                                            $promotion = 0;
                                            if (strtotime($start_promotion) <= strtotime(date('Y-m-d')) && strtotime($end_promotion) >= strtotime(date('Y-m-d'))) {
                                                $recharge_promotion = $SiteData->recharge_promotion;
                                                $promotion = $creditAmount * $recharge_promotion / 100;
                                                $amount = $creditAmount + $promotion;
                                            } else {
                                                $amount = $creditAmount;
                                                $recharge_promotion = 0;
                                            }
                                            $user11 = User::where('id', $user->ref_id)->first();
                                              
                                          
                                            if($user11){
                                                 $amount2=$creditAmount * 0.05;
                                            DataHistory::create([
                                                'username' => $user11->username,
                                                'action' => 'Hoa hồng',
                                                'data' => $amount2,
                                                'old_data' => $user11->balance,
                                                'new_data' => $user11->balance + $amount2,
                                                'ip' => $user11->ip,
                                                'description' => "Tài khoản ".$user->username." nạp " . number_format($creditAmount) . " và bạn nhận được số tiền hoa hồng là ".$amount2." VNĐ",
                                                'domain' => $user11->domain,
                                            ]);
                                                $user11->update([
                                                    'referral_money' => $user11->referral_money + ($creditAmount * 0.05)
                                                ]);
                                                $user11->balance = $user11->balance + $amount2;
                                                $user11->save();

                                            }
                                            
                                            DataHistory::create([
                                                'username' => $user->username,
                                                'action' => 'Nạp tiền',
                                                'data' => $amount,
                                                'old_data' => $balance,
                                                'new_data' => $user->balance + $amount,
                                                'ip' => $user->ip,
                                                'description' => "Nạp tiền qua ACB với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ",
                                                'domain' => $user->domain,
                                            ]);
                                            HistoryRecharge::create([
                                                'username' => $user->username,
                                                'name_bank' => $name ?? 'Không xác định',
                                                'type_bank' => 'acb',
                                                'tranid' => $refNo,
                                                'amount' => $creditAmount,
                                                'promotion' => $recharge_promotion,
                                                'real_amount' => $amount,
                                                'status' => 'Success',
                                                'note' => $description,
                                                'domain' => $user->domain,
                                            ]);
                                            // echo $creditAmount;
                                            $user->balance = $user->balance + $amount;
                                            $user->total_recharge = $user->total_recharge + $amount;
                                            
                                            $user->save();
                                            $count++;
                                            if (DataSite('telegram_token_tb') != ""){
                                            $tele1 = new TeleCustomController();
                            $bot1 = $tele1->bot1();
                         $bot1->sendMessage([
                             'chat_id' => DataSite('telegram_chat_id'),
                        'text' =>DataSite('domain')."\n"."🔔 Thông báo nạp tiền.\n" ."Tài khoản:".$user->username."\n". "Thể loại: ACB\n"."Nội dung:Nạp tiền qua ACB với số tiền: " . number_format($creditAmount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ\n". "Thời gian: " . now(),
                            ]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $this->info('Nạp thành công ' . $count . ' tài khoản');
                }
                
                }
                
            } elseif ($account->type == 'momo') {
                $ch = curl_init('https://api.sieuthicode.net/historyapimomo/'.$api_token);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                
                print_r($response);
                $result = json_decode($response, true);
            
if (isset($result['momoMsg']['tranList'])){
                foreach ($result['momoMsg']['tranList'] as $key => $item) {
                   
                    $partnerName = $item['partnerName'];
                    $partnerId = $item['partnerId'];
                    $amount = $item['amount'];
                    $comment = $item['comment'];
                    $tranId = $item['tranId'];
                  
    // echo $comment;
                    $checkId = strpos($comment, $code_tranfer);
                    if ($checkId !== false) {
                        $ch1 = explode($code_tranfer, $comment);
                        $ch1 = strtolower($ch1[1]);
                        $ch1 = str_replace("\n", "", $ch1);
                        $ch2 = explode('.', $ch1);
                        $ch1 = $ch2[0];
                        $ch2 = explode(' ', $ch1);
                        $idUser = $ch2[0];
                        //name bank
                        $name = "Không xác định";
                        $user = User::find($idUser);
                        if ($user) {
                            $checkTranid = HistoryRecharge::where('tranid', $tranId)->first();
                            if ($checkTranid) {
                                continue;
                            } else {
                                $balance = $user->balance;
                                $recharge_promotion = $SiteData->recharge_promotion;
                                $start_promotion = $SiteData->start_promotion;
                                $end_promotion = $SiteData->end_promotion;

                                 
                                   
                                    $promotion = 0;
                                    if (strtotime($start_promotion) <= strtotime(date('Y-m-d')) && strtotime($end_promotion) >= strtotime(date('Y-m-d'))) {
                                        $recharge_promotion = $SiteData->recharge_promotion;
                                        $promotion = $amount * $recharge_promotion / 100;
                                        $amount = $amount + $promotion;
                                    } else {
                                        $amount = $amount;
                                        $recharge_promotion = 0;
                                    }
                                     $user11 = User::where('id', $user->ref_id)->first();
                                              
                                          
                                            if($user11){
                                                 $amount2= $amount * 0.05;
                                            DataHistory::create([
                                                'username' => $user11->username,
                                                'action' => 'Hoa hồng',
                                                'data' => $amount2,
                                                'old_data' => $user11->balance,
                                                'new_data' => $user11->balance + $amount2,
                                                'ip' => $user11->ip,
                                                'description' => "Tài khoản ".$user->username." nạp " . number_format($amount) . " và bạn nhận được số tiền hoa hồng là ".$amount2." VNĐ",
                                                'domain' => $user11->domain,
                                            ]);
                                                $user11->update([
                                                    'referral_money' => $user11->referral_money + ($amount * 0.05)
                                                ]);
                                                $user11->balance = $user11->balance + $amount2;
                                                $user11->save();

                                            }
                                            
                                            
                                    DataHistory::create([
                                        'username' => $user->username,
                                        'action' => 'Nạp tiền',
                                        'data' => $amount,
                                        'old_data' => $balance,
                                        'new_data' => $user->balance + $amount,
                                        'ip' => $user->ip,
                                        'description' => "Nạp tiền qua Momo với số tiền: " . number_format($amount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ",
                                        'domain' => $user->domain,
                                    ]);
                                    HistoryRecharge::create([
                                        'username' => $user->username,
                                        'name_bank' => $partnerName ?? 'Không xác định',
                                        'type_bank' => 'momo',
                                        'tranid' => $tranId,
                                        'amount' => $amount,
                                        'promotion' => $recharge_promotion,
                                        'real_amount' => $amount,
                                        'status' => 'Success',
                                        'note' => $comment,
                                        'domain' => $user->domain,
                                    ]);
                                    // echo $creditAmount;
                                    $user->balance = $user->balance + $amount;
                                    $user->total_recharge = $user->total_recharge + $amount;
                                    
                                    $user->save();
                                    if (DataSite('telegram_token_tb') != ""){
                                             $tele1 = new TeleCustomController();
                            $bot1 = $tele1->bot1();
                         $bot1->sendMessage([
                             'chat_id' => DataSite('telegram_chat_id'),
                        'text' =>DataSite('domain')."\n"."🔔 Thông báo nạp tiền.\n" ."Tài khoản:".$user->username."\n". "Thể loại: Momo\n"."Nội dung: Nạp tiền qua Momo với số tiền: " . number_format($amount) . " VNĐ được khuyến mãi " . $recharge_promotion . "% thực nhận: " . number_format($amount) . " VNĐ\n". "Thời gian: " . now(),
                            ]);
                                    }
                                
                            }
                        }
                    }
                    
                }
}
        } else {
            $this->info('Không tìm thấy tài khoản');
        }
        
    }
}
}