<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CronOrderCon::class,
        \App\Console\Commands\CronTwoMxh::class,
    
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cron:2mxh')->everyMinute();
        $schedule->command('cron:ordercon')->everyMinute();
    }
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
