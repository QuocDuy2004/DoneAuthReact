<!DOCTYPE html>
<html>
<head>
    <title>Sync Server Services</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mt-4">Local Services</h2>
        
        @if($price_services->isEmpty())
            <p>No active server services found.</p>
        @else
            <h3>Local Services</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Price Collaborator</th>
                        <th>Price Agency</th>
                        <th>Price Distributor</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actual Price</th>
                        <th>Actual Server</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($price_services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ number_format($service->price, 2) }}</td>
                            <td>{{ number_format($service->price_collaborator, 2) }}</td>
                            <td>{{ number_format($service->price_agency, 2) }}</td>
                            <td>{{ number_format($service->price_distributor, 2) }}</td>
                            <td>{{ $service->min }}</td>
                            <td>{{ $service->max }}</td>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ number_format($service->actual_price, 4) }}</td>
                            <td>{{ $service->actual_server }}</td>
                            <td>{{ $service->status }}</td>
                            <td>{{ $service->action }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Hiển thị dữ liệu từ API --}}
        <h2 class="mt-4">API Services</h2>
        @if(empty($api_services) || !is_array($api_services))
            <p>No services found from API or invalid response.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Name</th>
                        <th>Rate</th>
                        <th>Min</th>
                        <th>Max</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($api_services as $service)
                        <tr>
                            <td>{{ $service['service'] ?? 'N/A' }}</td>
                            <td>{{ $service['name'] ?? 'N/A' }}</td>
                            <td>{{ number_format($service['rate'] ?? 0, 4) }}</td>
                            <td>{{ $service['min'] ?? 'N/A' }}</td>
                            <td>{{ $service['max'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
