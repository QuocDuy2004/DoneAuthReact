<?php

namespace App\Console\Commands;

use App\Models\Orders;
use App\Models\User;
use App\Models\SiteCon;
use App\Models\DataHistory;
use Illuminate\Console\Command;

class CronOrderCon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:ordercon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đơn hàng site con';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userdomain =SiteCon::where('domain_name', getDomain())->first();
        // return Command::SUCCESS;
        $this->info('Cron Order: ' . date('d-m-Y H:i:s'));
        $data = Orders::where('actual_service', env('PARENT_SITE'))
            ->where('status', '!=', 'Suspended')
            ->where('status', '!=', 'Completed')
            ->where('status', '!=', 'Success')
            ->where('status', '!=', 'Refunded')
            ->where('status', '!=', 'Failed')
            ->where('status', '!=', 'Cancelled')->limit(100)->get();
        $order_code = '';
        $count = 0;
        foreach ($data as $item) {
            $order_code = $item->order_code;
            $order = Orders::where('id', $order_code)->where('domain', $userdomain['domain'])->first();
            if ($order) {
                if($order->status == 'Failed'){
                    User::where('username', $item->username)->increment('balance', $item->total_payment);
                }

                $item->start = $order->start;
                $item->buff = $order->buff;
                $item->status = $order->status === 'PendingOrder' ? 'Active' : $order->status;
                $order_history = json_decode($item->history, true);
                if ($order->status == 'Success' || $order->status == 'Completed') {
                    $order_history[] = [
                        'time' => date('H:i d/m/Y'),
                        'status' => 'success',
                        'title' => "Đơn hàng hoàn thành",
                    ];
                    $item->history = json_encode($order_history);
                }
                $item->save();
               
                $count++;
          
            }
        }
        $this->info('Cron Order: ' . $count . ' orders');
    }
}
