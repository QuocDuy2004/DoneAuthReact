@extends('Admin.Layout.App')

@section('title', 'Lịch sử nạp thẻ cào')

@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Nạp thẻ cào</h1>
            <div class="ms-md-1 ms-0"></div>
        </div>
        <!-- Page Header Close -->

        <!-- Start:: Content -->
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Danh sách giao dịch</div>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table id="history_card"
                    class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                    aria-describedby="file_export_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tài khoản</th>
                                <th>Loại thẻ</th>
                                <th>Mệnh giá</th>
                                <th>Serial</th>
                                <th>Mã thẻ</th>
                                <th>Thực nhận</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End:: Content -->
    </div>
</div>

@endsection

@section('script')
<script>
     createDataTable('#history_card', '{{ route('admin.list', 'history-card') }}', [{
                data: 'id'
            }, {
                data: 'username'
            }, {
                data: 'card_type'
            }, {
                data: 'card_amount'
            }, {
                data: 'card_serial'
            }, {
                data: 'card_code'
            }, {
                data: 'card_real_amount'
            },
            {
                data: 'status'
            },{
                data: 'note'
            },
            {
                data: 'created_at'
            }
        ])
</script>
@endsection
