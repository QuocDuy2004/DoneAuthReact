@extends('Layout.App')
@section('title', 'Danh sách dịch vụ')

@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="ms-auto pageheader-btn">
                <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                    <i class="fe fe-plus mx-1 align-middle"></i>Số dư: <span class="user-balance">{{ number_format(Auth::user()->balance) }} ₫</span>
                </button>
            </div>
        </div>
        <!-- Page Header Close -->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap text-center fw-bold">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-start">Tên dịch vụ</th>
                                <th>Giá</th>
                                <th>Min order</th>
                                <th>Max order</th>
                                <th>Time</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $item)
                                @inject('server', '\App\Models\ServerService')
                                 <tr class="text-start">
                                    <td colspan="8">
                                        <h3 class="fw-bold">{{ $loop->iteration }} | {{ ucfirst($item->service_social) }} - {{ $item->name }} </h3>
                                    </td>
                                </tr>
                                @foreach ($server->getServerByService($item->id) as $server)
                                <tr>
                                    <td>{{ $server->id }}</td>
                                    <td class="text-start">{!! ucfirst($server->title) !!} - {{ ucfirst($item->service_social) }}</td>
                                    
                                    @php
                                        // Xác định giá dịch vụ dựa trên cấp bậc của người dùng
                                        $price = $server->price; // Giá mặc định
                                
                                        if (Auth::user()->level == 2) {
                                            $price = $server->price_collaborator;
                                        } elseif (Auth::user()->level == 3) {
                                            $price = $server->price_agency;
                                        } elseif (Auth::user()->level == 4) {
                                            $price = $server->price_distributor;
                                        }
                                    @endphp
                                
                                    <td>{{ number_format($price) }} ₫</td>
                                    <td>{{ number_format($server->min) }}</td>
                                    <td>{{ number_format($server->max) }}</td>
                                  <td>{{ $server->average_time }}</td> 
                                    <td>{{ $server->description }}</td>
                                </tr>
                                
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
