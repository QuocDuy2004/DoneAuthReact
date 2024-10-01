<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\Serivce\TwoMxhController;
use App\Models\Orders;
use App\Models\User;
use App\Models\DataHistory;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CronTwoMxh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:2mxh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $this->info('Cron 2Mxh: ' . date('d-m-Y H:i:s'));
        $data = Orders::where('actual_service', '2mxh')
            ->where('status', '!=', 'Suspended')
            ->where('status', '!=', 'Completed')
            ->where('status', '!=', 'Success')
            ->where('status', '!=', 'Refunded')
            ->where('status', '!=', 'Failed')
            ->where('status', '!=', 'Cancelled')->limit(100)->get();


        $order_code = '';
        $count = 0;
        foreach ($data as $item) {
            $mxh = new TwoMxhController();
            $mxh->path = $item->actual_path;
          
            $order_code = $item->order_code;
            $data = $mxh->order($order_code);
            if ($data['status'] == true) {
                if (isset($data['data'][0])) {

                    $status = $data['data'][0]['status'];
                    $start = $data['data'][0]['start_number'];
                    $buff = $data['data'][0]['success_count'];
                    $order_history = json_decode($item->history, true);
                    if ($status == 'Completed') {
                        $order_history[] = [
                            'time' => date('H:i d/m/Y'),
                            'status' => 'success',
                            'title' => "Đơn hàng hoàn thành",
                        ];
                        $item->history = json_encode($order_history);
                    }

                    if ($status == 'Failed') {
                        $order_history[] = [
                            'time' => date('H:i d/m/Y'),
                            'status' => 'danger',
                            'title' => "Đơn hàng thất bại",
                        ];
                        $item->history = json_encode($order_history);
                    }

                    if ($status == 'Cancelled') {
                        $order_history[] = [
                            'time' => date('H:i d/m/Y'),
                            'status' => 'danger',
                            'title' => "Đơn hàng đã bị huỷ",
                        ];
                        $item->history = json_encode($order_history);
                    }

                    if ($status == 'Refund') {
                        $order_history[] = [
                            'time' => date('H:i d/m/Y'),
                            'status' => 'danger',
                            'title' => "Đơn hàng đã được hoàn tiền",
                        ];
                        $item->history = json_encode($order_history);
                    }
                      if ($status == 'Holding') {
                                            $order_history[] = [
                                                'time' => date('H:i d/m/Y'),
                                                'status' => 'warning',
                                                'title' => "Đơn hàng đang tạm bị hoãn",
                                            ];
                                            $item->history = json_encode($order_history);
                                        }
                    if ($status == 'Preparing') {
                        $order_history[] = [
                            'time' => date('H:i d/m/Y'),
                            'status' => 'warning',
                            'title' => "Đơn hàng đang được chuẩn bị",
                        ];
                        $item->history = json_encode($order_history);
                    }
                  

                    if($status == 'Running'){
                        $status = 'Active';
                    }elseif($status == 'Waiting'){
                        $status = 'Pending';
                    }elseif($status == 'Partial'){
                        $status = 'Active';
                    }elseif($status == 'Preparing'){
                        $status = 'Pending';
                    }elseif($status == 'Paused'){
                        $status = 'Suspended';
                    }elseif($status == 'Error'){
                        $status = 'Failed';
                    }

                    $item->status = $status;
                    $item->start = $start;
                    $item->buff = $buff;
                    $item->save();
                    // if($status == 'Refund'  && $item->buff != $item->quantity){
                    //     $soluong=$item->quantity;
                    //     $buff = $item->buff;
                    //     $conlai= $soluong-$buff;
                    //     $price= $item->price;
                    //     $hoan= $price * $conlai;
                        
                    //     $user = User::where('username', $item->username)->first();
                    //     $balance = $user->balance + $hoan;
                    //      DataHistory::create([
                    //                                                     'username' => $user->username,
                    //                                                     'action' => 'Tạo đơn',
                    //                                                     'data' => $hoan,
                    //                                                     'old_data' => $user->balance,
                    //                                                     'new_data' => $balance,
                    //                                                     'ip' => '',
                    //                                                     'description' => "Hoàn tiền đơn mã đơn $order_code (đã chạy $buff/$soluong); phí 0 ₫",
                    //                                                     'data_json' => '',
                    //                                                     'domain' => getDomain(),
                    //                                                 ]);
                    //         $user->balance = $balance;
                    //         $user->total_recharge = $user->total_recharge + $hoan;
                    //         $user->save();
                            
                    //         $item->buff = $soluong;
                    //         $item->save();
                    // }
                    $count++;
                   
                }
            }
        }


        $this->info('Cron 2Mxh: ' . $count . ' orders');
    }
}
