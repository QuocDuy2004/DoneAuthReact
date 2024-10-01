<?php

use App\Http\Controllers\Api\Document\ApiDocumentController;
use App\Http\Controllers\Api\Tool\ToolController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\CronJobs\MBBankController;
use App\Http\Controllers\Guest\Service\OrderServiceController;
use App\Http\Controllers\Guest\Service\OrderTainguyenController;
use App\Http\Controllers\Guest\Service\ApiOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v2', [ApiOrderController::class, 'createOrder'])->name('api.service.order');
Route::post('/v2', [ApiOrderController::class, 'createOrder'])->name('api.service.order');

Route::prefix('/service')->group(function(){
    Route::post('/{social}/{service}/order', [OrderServiceController::class, 'createOrder'])->name('api.service.order');
    Route::post('/{chuyenmuc}/order', [OrderTainguyenController::class, 'createOrder'])->name('api.chuyenmuc.order');
});



Route::middleware('api.auth')->group(function(){
    Route::post('/me', [ApiDocumentController::class, 'me'])->name('api.me');
    Route::post('/service/prices', [ApiDocumentController::class, 'servicePrices'])->name('api.service.prices');
    Route::post('/get/orders', [ApiDocumentController::class, 'getOrders'])->name('api.get.orders');

    Route::prefix('/order')->group(function(){
        Route::post('/refund', [ApiDocumentController::class, 'orderRefund'])->name('api.order.refund');
        Route::post('/giahan', [ApiDocumentController::class, 'orderGiahan'])->name('api.order.giahan');
        Route::post('/warranty', [ApiDocumentController::class, 'orderWarranty'])->name('api.order.warranty');
        Route::post('/speed', [ApiDocumentController::class, 'orderSpeed'])->name('api.order.speed');
    });
});

Route::get('v2/cronJobs/recharge/banking', [MBBankController::class, 'rechargeMBBank']);


Route::prefix('/tool')->group(function(){
    Route::post('/get-uid', [ToolController::class, 'getUid'])->name('api.tool.get-uid');
});

Route::post('/auth/register', [AuthClientController::class, 'Register'])->name('register.post');
Route::post('/auth/login', [AuthClientController::class, 'Login'])->name('login.post');
Route::post('/auth/logout', [AuthClientController::class, 'Logout'])->name('logout.post');

Route::post('/auth/forgot-password', [AuthClientController::class, 'ForgotPassword'])->name('forgot.post');
Route::post('/reset-password/{token}', [AuthClientController::class, 'ResetPassword'])->name('reset.password.post');
Route::get('/reset-password/{token}', [AuthClientController::class, 'ResetPasswordPage'])->name('reset.password');  