<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Status</title>
</head>
<body>
    <h1>Order Status</h1>

    <h2>Order History</h2>
    @forelse ($history_orders as $order)
        <div>
            <!-- Thông tin Order lấy từ database -->
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
            <p><strong>Order Link:</strong> {{ $order->order_link }}</p>
            <p><strong>Start:</strong> {{ $order->start }}</p>
            <p><strong>Buff:</strong> {{ $order->buff }}</p>
            <p><strong>Order Status (from DB):</strong> {{ $order->status }}</p> <!-- Trạng thái từ Order -->
            <p><strong>Actual Service:</strong> {{ $order->actual_service }}</p>
            <p><strong>Domain:</strong> {{ $order->domain }}</p>

            <!-- Hiển thị kết quả status từ curl API -->
            @if (isset($orderStatusResults[$order->id]))
                <p><strong>API Status Result (from API):</strong> {{ json_encode($orderStatusResults[$order->id]) }}</p> <!-- Trạng thái từ API -->
            @else
                <p><strong>API Status Result (from API):</strong> No result from API</p>
            @endif
            <hr>
        </div>
    @empty
        <p>No orders found.</p>
    @endforelse
</body>
</html>
