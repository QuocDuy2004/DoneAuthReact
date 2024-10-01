<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmmkayController extends Controller
{
    private $apiToken;
    public $path = "";
    public $server = "";
    public $data = [
        'order_link' => '',
        'quantity' => '',
        'speed' => '',
        'comment' => '',
        'minutes' => '',
        'time' => '',
        'days' => '',
        'post' => '',
        'reaction' => '',
        'server_order' => '',
        'social' => '',
    ];

    public function __construct()
    {
        $this->apiToken = env('SmmkayController_TOKEN'); // Use environment variable for the API token
    }

    public function CreateOrder()
    {
        $apiToken = $this->apiToken;
        $url = "https://smmkay.com/api/v2";

        $data = $this->data;
        $dataPost = [
            'key' => $apiToken,
            'action' => 'add',
            'service' => $data['server_order'] ?? '',
            'link' => $data['order_link'] ?? '',
            'quantity' => $data['quantity'] ?? '0',
            'reaction' => $data['reaction'] ?? 'like',
            'minutes' => $data['minutes'] ?? '0',
            'dayvip' => $data['days'] ?? '0',
        ];

        $result = $this->curl($url, $dataPost);
        if (isset($result['order'])) {
            return [
                'status' => true,
                'message' => "Order placed successfully",
                'data' => $result['order'],
            ];
        } else {
            return [
                'status' => false,
                'message' => $result['error'],
                'data' => '',
            ];
        }
    }

    public function status($order_code)
    {
        $apiToken = $this->apiToken;
        $url = "https://smmkay.com/api/v2";

        $dataPost = [
            'key' => $apiToken,
            'action' => 'status',
            'order' => $order_code,
        ];

        $result = $this->curl($url, $dataPost);
        return $result;
    }

    public function curl($path, $data = [])
    {
        $data_string = http_build_query($data);

        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}