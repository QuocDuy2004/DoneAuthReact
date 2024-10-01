<?php

namespace App\Http\Controllers\CronJobs\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Service\AutolikezController;
use App\Http\Controllers\Api\Service\SubrenhatController;
use App\Http\Controllers\Api\Service\SubmeController;
use App\Models\ServerService;

class UpdatePriceController extends Controller
{
    protected $services = [
        'autolikez' => AutolikezController::class,
        'app.subme.vn' => SubmeController::class,
    ];

    public function updatePrice($service)
    {
        if (!array_key_exists($service, $this->services)) {
            return;
        }

        $serviceController = new $this->services[$service]();
        $priceData = $serviceController->getPrice();

        if (isset($priceData) && $priceData['status'] == 200) {
            $this->updateServerPrices($service, $priceData['data']);
        }
    }

    protected function updateServerPrices($service, $data)
    {
        foreach ($data as $item) {
            $price = $item['price'];
            $package_name = $item['package_name'];

            $server_list = ServerService::where('actual_service', $service)
                                        ->where('actual_server', $package_name)
                                        ->get();

            if ($server_list->count() > 0) {
                foreach ($server_list as $server) {
                    $server->actual_price = $price;
                    $server->price = $price;
                    $server->price_collaborator = $price;
                    $server->price_agency = $price;
                    $server->price_distributor = $price;
                    $server->save();
                }
            }
        }
    }
}
