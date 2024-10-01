<?php

use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataServiceController;
use App\Http\Controllers\Admin\ViewAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Http\Controllers\ProviderController;
use Dflydev\DotAccessData\Data;

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/config/token', [ViewAdminController::class, 'ConfigAuto'])->name('admin.website.config.token');

    // Route cập nhật thông tin API (POST request)
    Route::post('/config/token', [DataAdminController::class, 'updateEnv'])->name('admin.website.auto.update');
    
    Route::get('/providers/form', [ProviderController::class, 'showForm'])->name('provider.form');
    Route::post('/providers/fetch', [ProviderController::class, 'fetchAndStoreData'])->name('provider.fetch');
    // update balance
    Route::put('/providers/updatBalance/{id}', [ProviderController::class, 'updateBalance'])->name('providers.updateBalance');
    Route::put('/providers/update/{id}', [ProviderController::class, 'update'])->name('providers.update');

    Route::get('/dashboard', [ViewAdminController::class, 'dashboard'])->name('admin.dashboard');
    //Cấu hình cấp cha
    Route::get('/website/captcha', [ViewAdminController::class, 'ConfigCaptcha'])->name('admin.website.captcha');
    Route::post('/website/captcha', [ViewAdminController::class, 'websiteCaptcha'])->name('admin.website.captcha.post');

    Route::get('/website/config', [ViewAdminController::class, 'websiteConfig'])->name('admin.website.config');

    //Cấu hình landing page
    Route::get('/website/config/landing', [ViewAdminController::class, 'websiteConfigLanding'])->name('admin.website.config.landing');
    Route::post('/website/config/landing', [DataAdminController::class, 'updateLandingPage'])->name('admin.update.landing.post');

    //Cấu hình giao diện
    Route::get('/website/theme', [ViewAdminController::class, 'ConfigTheme'])->name('admin.website.theme');
    Route::post('/website/theme', [DataAdminController::class, 'websiteTheme'])->name('admin.website.theme.post');

    //Hiệu ứng effect
    Route::get('/website/effect', [ViewAdminController::class, 'websiteConfigEffect'])->name('admin.website.effect');
    Route::post('/website/effect', [DataAdminController::class, 'websiteEffect'])->name('admin.website.effect.post');

    Route::get('/website/partner', [ViewAdminController::class, 'sitePartner'])->name('admin.website.partner');
    Route::get('/website/okdf', [ViewAdminController::class, 'websiteAuto'])->name('admin.auto.theme');

    //quản lý user
    Route::get('/thanh-vien/list', [ViewAdminController::class, 'userList'])->name('admin.user.list');
    Route::post('/thanh-vien/list/{id}', [DataAdminController::class, 'userEdit'])->name('admin.user.list.post');
    Route::post('/thanh-vien/change-password/{id}', [DataAdminController::class, 'userChangePassword'])->name('admin.user.change-password.post');
    Route::post('/thanh-vien/balance', [DataAdminController::class, 'userEditBalance'])->name('admin.user.balance.post');
    Route::post('/thanh-vien/delete/{id}', [DataAdminController::class, 'userDelete'])->name('admin.user.delete');

    Route::get('/notification', [ViewAdminController::class, 'notification'])->name('admin.notification');
    Route::get('/activity', [ViewAdminController::class, 'activity'])->name('admin.activity');
    Route::get('/newsannouncement', [ViewAdminController::class, 'newsannouncement'])->name('admin.newsannouncement');
    Route::get('/activitysystem', [ViewAdminController::class, 'activitysystem'])->name('admin.activitysystem');

    /* SERVICE */
    Route::get('/dich-vu/new/social', [ViewAdminController::class, 'serviceNewSocial'])->name('admin.service.new.social');
    Route::get('/thong-tin/sync', [ViewAdminController::class, 'nync_log'])->name('admin.sync.log');

    Route::get('/dich-vu/social/edit/{id}', [ViewAdminController::class, 'serviceSocialEdit'])->name('admin.service.social.edit');
    Route::get('/dich-vu/new', [ViewAdminController::class, 'serviceNew'])->name('admin.service.new');
    Route::get('/dich-vu/edit/{id}', [ViewAdminController::class, 'serviceEdit'])->name('admin.service.edit');

    //Tài nguyên
    Route::prefix('/tainguyen')->group(function () {
        Route::get('/new/chuyenmuc', [ViewAdminController::class, 'tainguyenNewChuyenmuc'])->name('admin.category.new');
        Route::post('/chuyenmuc/edit/{id}', [DataServiceController::class, 'tainguyenNewChuyenmucEdit'])->name('admin.tainguyen.edit.post');
        Route::get('/new/tainguyen', [ViewAdminController::class, 'tainguyenNewTainguyen'])->name('admin.taikhoan.tainguyen.new');
        Route::post('/tainguyen/tainguyen/edit/{id}', [DataServiceController::class, 'tainguyenNewTainguyenEdit'])->name('admin.taikhoan.tainguyen.edit.post');
        //Xử lý
        Route::post('/new/chuyenmuc', [DataServiceController::class, 'tainguyenNewChuyenmuc'])->name('admin.category.new.post');
        Route::post('/new/tainguyen', [DataServiceController::class, 'tainguyenNewTainguyen'])->name('admin.taikhoan.tainguyen.new.post');
        Route::delete('/delete/{id}', [DataServiceController::class, 'tainguyenNewChuyenmucDelete'])->name('admin.tainguyen.delete');
        Route::delete('/tainguyen/delete/{id}', [DataServiceController::class, 'tainguyenNewTainguyenDelete'])->name('admin.tainguyen.tainguyen.delete');
    });

    /* SERVER */
    Route::get('/may-chu/list', [ViewAdminController::class, 'serverList'])->name('admin.server.list');
    Route::get('/may-chu/new', [ViewAdminController::class, 'serverNew'])->name('admin.server.new');
    Route::get('/may-chu/edit/{id}', [ViewAdminController::class, 'serverEdit'])->name('admin.server.edit');
    Route::get('/order/edit/{id}', [ViewAdminController::class, 'orderEdit'])->name('admin.order.edit');

    Route::get('/may-chu/delete-all', [DataAdminController::class, 'serverDeleteAll'])->name('admin.server.delete-all');
    Route::delete('/may-chu/delete-all', [DataAdminController::class, 'serverDeleteAll'])->name('admin.service.delete-multiple');

    Route::prefix('/history')->group(function () {
        Route::get('/user', [ViewAdminController::class, 'HistoryUser'])->name('admin.history.user');
        Route::get('/order', [ViewAdminController::class, 'HistoryOrder'])->name('admin.history.order');
        Route::get('/recharge', [ViewAdminController::class, 'HistoryRecharge'])->name('admin.history.recharge');
        Route::get('/card', [ViewAdminController::class, 'HistoryCard'])->name('admin.history.card');
        Route::get('/login', [ViewAdminController::class, 'HistoryLogin'])->name('admin.history.login');
    });

    Route::get('/recharge/config', [ViewAdminController::class, 'rechargeConfig'])->name('admin.recharge.config');

    Route::get('/recharge/add', [ViewAdminController::class, 'rechargeadd'])->name('admin.recharge.add');
    // Telegram
    Route::get('/config/telegram', [ViewAdminController::class, 'configTelegram'])->name('admin.config.telegram');

    //site con
    Route::get('/website-child/list', [ViewAdminController::class, 'ConfigChildList'])->name('admin.website-child.list');

    Route::post('/website/config', [DataAdminController::class, 'websiteConfig'])->name('admin.website.config.post');
    Route::post('/website/captcha', [DataAdminController::class, 'websiteCaptcha'])->name('admin.website.captcha.post');

    //phiếu hỗ trợ khách hàng
    Route::get('/tickets', [ViewAdminController::class, 'tickets'])->name('admin.tickets.list');
    Route::post('/tickets/reply/{id}', [DataAdminController::class, 'ticketsReply'])->name('admin.tickets.reply');
    Route::get('/tickets/delete/{id}', [DataAdminController::class, 'ticketsDelete'])->name('admin.tickets.delete');

    Route::post('/website/theme', [DataAdminController::class, 'websiteTheme'])->name('admin.website.theme.post');
    Route::post('/website/partner', [DataAdminController::class, 'sitePartner'])->name('admin.website.partner.post');

    Route::post('/notification-modal', [DataAdminController::class, 'notificationModal'])->name('admin.notification.modal.post');
    Route::post('/notification', [DataAdminController::class, 'notification'])->name('admin.notification.post');
    Route::post('/notification/delete/{id}', [DataAdminController::class, 'notificationDelete'])->name('admin.notification.delete');
    Route::post('/newsannouncement', [DataAdminController::class, 'newsannouncement'])->name('admin.newsannouncement.post');
    Route::delete('/newsannouncement/delete/{id}', [DataAdminController::class, 'newsannouncementDelete'])->name('admin.newsannouncement.delete');
    Route::post('/activity', [DataAdminController::class, 'activity'])->name('admin.activity.post');
    Route::delete('/activity/delete/{id}', [DataAdminController::class, 'activityDelete'])->name('admin.activity.delete');
    Route::post('/activitysystem', [DataAdminController::class, 'activitysystem'])->name('admin.activitysystem.post');
    Route::delete('/activitysystem/delete/{id}', [DataAdminController::class, 'activitysystemDelete'])->name('admin.activitysystem.delete');

    /* SERVICE POST */
    Route::post('/dich-vu/new/social', [DataServiceController::class, 'serviceNewSocial'])->name('admin.service.new.social.post');
    Route::post('/dich-vu/social/edit/{id}', [DataServiceController::class, 'serviceSocialEdit'])->name('admin.service.social.edit.post');
    Route::delete('/dich-vu/delete/{id}', [DataServiceController::class, 'serviceSocialDelete'])->name('admin.service.delete');
    Route::post('/dich-vu/new', [DataServiceController::class, 'serviceNew'])->name('admin.service.new.post');
    Route::post('/dich-vu/edit/{id}', [DataServiceController::class, 'serviceEdit'])->name('admin.service.edit.post');
    Route::get('/dich-vu/delete/{id}', [DataServiceController::class, 'serviceDelete'])->name('admin.service.delete');

    // order
    if (getDomain() == env('PARENT_SITE')) {
        Route::post('order/active', [DataServiceController::class, 'orderActive'])->name('admin.order.active.post');
        Route::post('order/cancel', [DataServiceController::class, 'orderCancel'])->name('admin.order.cancel.post');
    }

    /* SERVER POST */
    Route::post('/server/new', [DataServiceController::class, 'serverNew'])->name('admin.server.new.post');
    Route::post('/may-chu/edit/{id}', [DataServiceController::class, 'serverEdit'])->name('admin.server.edit.post');
    Route::post('/order/edit/{id}', [DataServiceController::class, 'orderEdit'])->name('admin.order.edit.post');
    Route::get('/order/delete/{id}', [DataServiceController::class, 'orderDelete'])->name('admin.order.delete');
    //Cập nhâp giá hàng loạt
    Route::post('/server/price', [DataServiceController::class, 'updateAllServerPrices'])->name('admin.server.price.post');
    Route::get('/server/update-price', [ViewAdminController::class, 'updateAllServerPrices'])->name('admin.server.price');

    Route::get('/server/delete/{id}', [DataServiceController::class, 'serverDelete'])->name('admin.server.delete');
    Route::post('/server/notification-telegram', [DataServiceController::class, 'serverNotificationTelegram'])->name('admin.server.notification-telegram.post');
    Route::post('/service/checking', [DataServiceController::class, 'serviceChecking'])->name('admin.service.checking.post');
    Route::post('/server/auto-create', [DataAdminController::class, 'serverAutoCreate'])->name('admin.server.auto-create');
    Route::post('/server/auto-edit', [DataAdminController::class, 'serverAutoEdit'])->name('admin.server.auto-edit');


    Route::post('/recharge/config', [DataAdminController::class, 'rechargeConfig'])->name('admin.recharge.config.post');
    Route::post('/recharge/add', [DataAdminController::class, 'rechargeadd'])->name('admin.recharge.add.post');
    Route::post('/payment/add', [DataAdminController::class, 'Payments'])->name('admin.payment.add.post');
    Route::get('/recharge/delete/{id}', [DataAdminController::class, 'rechargeDelete'])->name('admin.recharge.delete');
    Route::post('/recharge/promotion', [DataAdminController::class, 'rechargePromotion'])->name('admin.recharge.promotion.post');
    Route::post('/recharge/card', [DataAdminController::class, 'rechargecard'])->name('admin.recharge.card.post');
    // telegram
    Route::post('/config/telegram', [DataAdminController::class, 'configTelegram'])->name('admin.config.telegram.post');

    Route::post('/website-child/active', [DataAdminController::class, 'websiteChildActive'])->name('admin.website-child.active.post');

    Route::post('/list/{action}', [DataAdminController::class, 'listAction'])->name('admin.list');
    Route::post('/delete-data/{type}', [DataAdminController::class, 'deleteData'])->name('admin.delete');

    Route::post('/server/bulk-delete', [DataAdminController::class, 'bulkDelete'])->name('admin.server.bulk-delete');


    // Route để xử lý form chuyển đổi tiền tệ
    Route::get('/currency-manager', [ViewAdminController::class, 'currencyManager'])->name('admin.currency.manager');
    Route::post('/currency-manager', [ViewAdminController::class, 'CreateCurrency'])->name('admin.currency.manager.post');
    Route::get('/currency-manager/edit/{id}', [ViewAdminController::class, 'editCurrency'])->name('admin.currency.manager.edit');
    Route::put('/currency-manager/update/{id}', [ViewAdminController::class, 'updateCurrency'])->name('admin.currency.manager.update');
    Route::delete('/currency-manager/delete/{id}', [ViewAdminController::class, 'destroyCurrency'])->name('admin.currency.delete');
});

// Route::get('/tesst', [TelegramCustomController::class, 'getWebhookInfo']);
