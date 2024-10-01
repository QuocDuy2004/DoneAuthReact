<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class {{ $controllerName }} extends Controller
{
    private $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService('{{ $apiKey }}', '{{ $apiUrl }}');
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'order_link' => 'required|string',
            'quantity' => 'required|integer',
            'reaction' => 'required|string',
            'minutes' => 'required|integer',
            'days' => 'required|integer',
            'server_order' => 'nullable|string',
        ]);

        $data = [
            'order_link' => $request->input('order_link'),
            'quantity' => $request->input('quantity'),
            'reaction' => $request->input('reaction'),
            'minutes' => $request->input('minutes'),
            'days' => $request->input('days'),
            'server_order' => $request->input('server_order', ''),
        ];

        $result = $this->apiService->createOrder($data);

        return response()->json($result);
    }

    public function getOrderStatus(Request $request, $orderCode)
    {
        $result = $this->apiService->getOrderStatus($orderCode);

        return response()->json($result);
    }
}
