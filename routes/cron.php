<?php

use App\Http\Controllers\CronJobs\CallbackController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronJobs\RechargeController;
use App\Http\Controllers\CronJobs\Service\CreateOrderController;

 


Route::prefix('cron')->group(function () {
    Route::get('/recharge-card', [RechargeController::class, 'RechargeCard'])->name('cron.recharge.card');
    Route::get('/recharge-transfer/{type}', function($type){
        $domain = request()->getHost();
        $lam= Artisan::call("recharge:transfer $type $domain");
        $re=[
            $type => $lam
            ];
            
            return $re;
    });
 
    Route::get('/OrderCon', function(){
      
        return Artisan::call("cron:ordercon");
    });
    
    Route::get('/service/2', function () {
        $output10 = Artisan::call('cron:cheotuongtac');
        // Gộp kết quả vào một mảng

        $results = [
            'command10' => $output10,

        ];

        // Return mảng kết quả
        return $results;
    });
    
    Route::get('/all', function(){
      
    $output2 = Artisan::call('cron:2mxh');
      $output5 = Artisan::call('cron:subgiare');
      $output6 = Artisan::call('cron:trumsubre');


  
   

    // Gộp kết quả vào một mảng
    $results = [
  
        'command2' => $output2,
        'command5' => $output5,
        'command6' => $output6,
    
    
    ];

    // Return mảng kết quả
    return $results;
    });

  
    Route::get('/service/twomxh/buy', [CreateOrderController::class, 'SubgiareBuy'])->name('cronjob.service.twomxh.buy');
   
});

Route::prefix('/callback')->group(function(){
    Route::match(['get', 'post'], '/telegram/v1', [CallbackController::class, 'telegramV1'])->name('callback.telegram.v1');
});
