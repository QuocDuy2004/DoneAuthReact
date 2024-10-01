@extends('Admin.Layout.App')

@section('title', 'Thông tin đồng bộ')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Thông tin đồng bộ</h1>
                <div class="ms-md-1 ms-0">
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Danh sách đồng bộ</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="display table table-bordered table-striped text-nowrap dataTable no-footer"
                            id="history_bank" aria-describedby="basic-1_info">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dịch vụ</th>
                                    <th>Thay đổi</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $key => $log)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $log->service }}</td>
                                        <td>
                                            {!! $log->change !!}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Content -->
        </div>
    </div>
@endsection
