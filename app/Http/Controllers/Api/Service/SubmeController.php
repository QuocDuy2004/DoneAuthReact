<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmeController extends Controller
{
    private $apiToken;

    public function __construct()
    {
        $this->apiToken = env('SubmeController_TOKEN'); // Use environment variable for the API token
    }

    public function CreateOrder(Request $request)
    {
        $apiToken = $this->apiToken;
        $url = "https://app.subme.vn/api/v2";

        // Extract data from request
        $data = [
            'key' => $apiToken,
            'action' => 'add',
            'service' => $request->input('service'),
            'link' => $request->input('link'),
            'quantity' => $request->input('quantity'),
        ];

        $result = $this->curl($url, $data);

        // Handle the result
        if (isset($result['order'])) {
            return response()->json([
                'status' => true,
                'message' => "Order placed successfully",
                'data' => $result['order'],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $result['error'] ?? 'Unknown error',
                'data' => null,
            ]);
        }
    }

    public function status(Request $request, $order_code)
    {
        $apiToken = $this->apiToken;
        $url = "https://app.subme.vn/api/v2";

        // Check order status
        $data = [
            'key' => $apiToken,
            'action' => 'status',
            'order' => $order_code,
        ];

        $result = $this->curl($url, $data);
        return response()->json($result);
    }

    private function curl($path, $data = [])
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