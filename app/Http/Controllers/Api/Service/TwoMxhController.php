<?php

namespace App\Http\Controllers\Api\Serivce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoMxhController extends Controller
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
        $this->apiToken = env('TOKEN_TWOMXH');
    }
    
    public function CreateOrder()
    {
        $url = 'https://api.2mxh.com/orders/';
        $data = $this->data;
        $dataPost = [
            'object_id' => $data['order_link'],
            'quantity' => $data['quantity'],
            'server_id' => $data['server_order'],
            'reaction' => $data['reaction'],
            'comments' => $data['comment'],
            'duration' => $data['minutes'],
        ];
        $response = $this->sendRequest($url, $dataPost);

        if ($response['status'] == 201) {
            return $data = [
                'status' => true,
                'message' => 'Đặt hàng thành công',
                'data' => $response['data']
            ];
        } else {
            return $data = [
                'status' => false,
                'message' => $response['message'],
            ];
        }
    }

    public function orderRefund($id)
    {
        $url = "https://api.2mxh.com/orders/$id/refund";
        $response = $this->sendRequest($url);
        if ($response['status'] == 200) {
            return $data = [
                'status' => true,
                'message' => $response['message'],
                'data' => $response['data']
            ];
        } else {
            return $data = [
                'status' => 'error',
                'message' => $response['message'],
            ];
        }
    }

    public function warranty($id)
    {
        $url = "https://api.2mxh.com/orders/$id/warranty";
        $response = $this->sendRequest($url);
        if ($response['status'] == 200) {
            return $data = [
                'status' => true,
                'message' => $response['message'],
                'data' => $response['data'] ?? ''
            ];
        } else {
            return $data = [
                'status' => 'error',
                'message' => $response['message'],
            ];
        }
    }

    public function order($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.2mxh.com/orders/get-by-id?ids=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['status'] == 200) {
            return $data = [
                'status' => true,
                'message' => 'Cập nhật thành công',
                'data' => $response['data']
            ];
        } else {
            return $data = [
                'status' => 'error',
                'message' => $response['message'],
            ];
        }
    }

    public function sendRequest($url, $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
                'Content-Type: application/json'
             
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
