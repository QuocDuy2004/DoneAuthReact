<?php

use App\Http\Controllers\Admin\DataServiceController;
use App\Http\Controllers\AffiliateController;
use App\Mail\MailForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\ViewClientController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\CronJobs\Service\CreateOrderController;
use App\Http\Controllers\Guest\DataClientController;
use App\Http\Controllers\Guest\Service\ViewServiceController;
use App\Http\Controllers\LocaleController;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PerfectMoneyController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Api\Service\SmmController;
use App\Http\Controllers\CronJobs\StatusOrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('home');
}); */

/* Route::get('/callsql', function(){
    return Artisan::call('migrate');
}); */

Route::get('/cron/orders', [ViewClientController::class, 'statusOrders'])->name('crons.orders');
Route::post('/cron/orders', [ViewClientController::class, 'statusOrders'])->name('crons.orders');
Route::get('/cron/sync', [ViewClientController::class, 'sync'])->name('crons.sync');
Route::post('/cron/sync', [ViewClientController::class, 'sync'])->name('crons.sync');

Route::resource('/admin/providers', ProviderController::class);
Route::get('/admin/providers', [ProviderController::class, 'index'])->name('providers.index');
Route::get('/admin/server/auto', [ViewClientController::class, 'autoServer'])->name('admin.server.auto');
Route::post('/admin/server/auto', [ViewClientController::class, 'getServices'])->name('admin.get.services');
Route::post('/admin/process-services', [ViewClientController::class, 'processSelectedServices'])->name('admin.process.services');


//get dòng tiền từ api google
// Route::post('/convert', [CurrencyController::class, 'convertCurrency'])->name('currency.convert');
// Route::get('/currency-rates', [CurrencyController::class, 'getCurrencyRates'])->name('currency.getCurrencyRates');

Route::post('/set-locale', [LocaleController::class, 'setLocale'])->name('set-locale');

Route::prefix('/install')->middleware(['install'])->group(function () {
    Route::get('/website', [AuthClientController::class, 'InstallPage'])->name('install.website');
    Route::post('/website', [AuthClientController::class, 'Install'])->name('install.website.post');
});

Route::get('/logout', [AuthClientController::class, 'Logout'])->name('logout');
Route::prefix('/auth')->middleware('guest')->group(function () {
    Route::get('/john/{referral_code}', [AuthClientController::class, 'RegisterPageWithReferral'])->name('register.referral');
    Route::get('/register', [AuthClientController::class, 'RegisterPage'])->name('register');
    Route::post('/register', [AuthClientController::class, 'Register'])->name('register.post');

    Route::get('/login', [AuthClientController::class, 'LoginPage'])->name('login');
    Route::post('/login', [AuthClientController::class, 'Login'])->name('login.post');


    Route::get('/forgot-password', [AuthClientController::class, 'ForgotPasswordPage'])->name('forgot.password');
    Route::post('/forgot-password', [AuthClientController::class, 'ForgotPassword'])->name('forgot.password.post');
    Route::get('/reset-password/{token}', [AuthClientController::class, 'ResetPasswordPage'])->name('reset.password');
    Route::post('/reset-password/{token}', [AuthClientController::class, 'ResetPassword'])->name('reset.password.post');

    //login google 
    Route::get('/login/google', [AuthClientController::class, 'LoginGoogle'])->name('login.google');
    Route::get('/login/google/callback', [AuthClientController::class, 'LoginGoogleCallback'])->name('login.google.callback');
});
Route::get('/', [ViewClientController::class, 'LandingPage'])->name('landing');


Route::get('/ref/{id}', [AuthClientController::class, 'RefPage'])->name('ref');
Route::get('/ref/{id}/count', [AuthClientController::class, 'RefCountPage'])->name('refcount');

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/home', [ViewClientController::class, 'HomePage'])->name('home');
    Route::get('/account/profile', [ViewClientController::class, 'ProfilePage'])->name('profile');

    Route::post('/update-profile/{type}', [DataClientController::class, 'UpdateProfile'])->name('update-profile');

    Route::get('/addfunds', [ViewClientController::class, 'TransferPage'])->name('recharge.transfer');
    Route::get('/card', [ViewClientController::class, 'CardPage'])->name('recharge.card');
    Route::post('/card', [DataClientController::class, 'Card'])->name('recharge.card.post');
    // Route::prefix('/account/deposits')->group(function () {
       
       
    // });

    Route::get('/account/transactions', [ViewClientController::class, 'HistoryPage'])->name('user.history');
    Route::get('/api/smm', [ViewClientController::class, 'HistoryPurchase'])->name('api');
    Route::get('/providers', [ViewClientController::class, 'Providers'])->name('providers.api');

    Route::get('/account/level', [ViewClientController::class, 'LevelPage'])->name('user.level');
    /* tool */
    Route::get('/account/ref', [ViewClientController::class, 'Ref'])->name('user.ref');
    Route::get('/tool/get-uid', [ViewClientController::class, 'ToolUid'])->name('tool.uid');
    Route::get('/tools/whios-domain', [ViewClientController::class, 'ToolDomain'])->name('tool.domain');
    Route::get('/toolss/2fa', [ViewClientController::class, 'Tool2fa'])->name('tool.2fa');
    /* Dịch vụ */
    Route::get('/pages/services', [ViewServiceController::class, 'services'])->name('pages.services');
    Route::get('/service/{social}/{service}', [ViewServiceController::class, 'ViewServicePage'])->name('service.view');
    Route::get('/service/{chuyenmuc}', [ViewClientController::class, 'ViewChuyenmucPage'])->name('chuyenmuc.view');
    Route::get('/create-website', [ViewClientController::class, 'CreateWebsite'])->name('create.website');

    Route::post('/user/list/{action}', [DataClientController::class, 'ListAction'])->name('user.list.action');
    Route::post('/user/order/{social}/{action}', [DataClientController::class, 'OrderAction'])->name('user.order.action');
    Route::post('/user/{action}', [DataClientController::class, 'UserAction'])->name('user.action');
    Route::post('/service/get/order', [DataClientController::class, 'ServiceGetOrder'])->name('service.get.order');
    Route::post('/service/get/token', [DataClientController::class, 'ServiceGetToken'])->name('service.get.token');
    Route::post('/create-website', [DataClientController::class, 'CreateWebsite'])->name('create.website.post');
    Route::get('/pages/api-docs', [ViewClientController::class, 'DocsApi'])->name('api.docs');
    Route::get('/terms-of-service', [ViewClientController::class, 'Terms'])->name('term');
    /* tiện ích */
    Route::post('/tool/{action}', [DataClientController::class, 'ToolGetUid'])->name('tool.uid.post');
    Route::post('/tools/{action}', [DataClientController::class, 'getAuthenTwo'])->name('tool.2fa.post');
    Route::post('/tools/{action}', [DataClientController::class, 'ToolWhiosDomain'])->name('tool.domain.post');

    //Tiếp thị liên kết
    Route::get('/pages/affiliates', [ViewClientController::class, 'Affiliates'])->name('pages.affiliates');

    //Check lịch sử perfect money
    // Route::get('/transfer-form', [PerfectMoneyController::class, 'showForm'])->name('transfer.form');
    Route::post('/transfer', [PerfectMoneyController::class, 'submitTransfer'])->name('transfer.process');
    
    Route::get('/payment-success', function () {
        return "Thanh toán thành công";
    })->name('payment.success');
    
    Route::get('/payment-failure', function () {
        return redirect('/addfunds')->with('error', 'Thanh toán thất bại');
    })->name('payment.failure');
    
    

    //update Curency cho Username
    Route::post('/account/profile/currency-update', [ViewClientController::class, 'updateCurrency'])->name('update.balance');

    Route::get('/tickets', [ViewClientController::class, 'showTicket'])->name('tickets');
    Route::post('/tickets', [DataClientController::class, 'createTickets'])->name('create.tickets.post');
    

    //Auto dịch vụ
    Route::get('/admin/server/auto', [ViewClientController::class, 'autoServer'])->name('admin.server.auto');
    Route::post('/admin/get-services', [ViewClientController::class, 'getServices'])->name('admin.import.services');
    Route::post('/admin/import-services', [DataServiceController::class, 'importServices'])->name('admin.import.services');

});
