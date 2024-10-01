<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmmController extends Controller
{
    protected $apiToken;
    protected $url;
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

    public function __construct($url, $apiToken)
    {
        $this->url = $url;
        $this->apiToken = $apiToken;
    }

    public function CreateOrder()
    {
        $data = $this->data;
        $dataPost = [
            'key' => $this->apiToken,
            'action' => 'add',
            'service' => $data['server_order'] ?? '',
            'link' => $data['order_link'] ?? '',
            'quantity' => $data['quantity'] ?? '0',
            'reaction' => $data['reaction'] ?? 'like',
            'minutes' => $data['minutes'] ?? '0',
            'dayvip' => $data['days'] ?? '0',
        ];

        $result = $this->curl($this->url, $dataPost);
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
        $dataPost = [
            'key' => $this->apiToken,
            'action' => 'status',
            'order' => $order_code,
        ];

        $result = $this->curl($this->url, $dataPost);
        return $result;
    }

    //thêm
    public function services()
    {
        $dataPost = [
            'key' => $this->apiToken,
            'action' => 'services',
        ];
        $result = $this->curl($this->url, $dataPost);
        return $result;
    }

    private function curl($url, $data = [])
    {
        $data_string = http_build_query($data);

        $ch = curl_init($url);
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
