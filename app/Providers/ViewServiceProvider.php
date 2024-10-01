<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SiteData;
use App\Models\Currency;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            // Lấy thông tin từ bảng site_data
            $siteData = SiteData::where('domain', getDomain())->first();
            $effect = $siteData ? $siteData->effect : null;

            // Lấy tất cả dữ liệu từ bảng currencies
            $currencies = Currency::where('status', 1)->get(); // Lọc các loại tiền tệ đang hoạt động

            // Truyền dữ liệu đến view
            $view->with('effect', $effect);
            $view->with('currencies', $currencies);
        });
    }

    public function register()
    {
        //
    }
}
