@extends('Admin.Layout.App')

@section('title', 'Lịch sử chuyển khoản')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Lịch sử chuyển khoản </h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Danh sách Chuyển khoản</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div id="basic-1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="display table table-bordered table-stripped text-nowrap dataTable no-footer"
                                id="history_bank" aria-describedby="basic-1_info" style="width: 1475px;">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                            rowspan="1" colspan="1" aria-sort="descending"
                                            aria-label="#: activate to sort column ascending" style="width: 8.4px;">#</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Tài khoản"
                                            style="width: 60.2px;">Tài khoản</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Thể loại: activate to sort column ascending"
                                            style="width: 60.2px;">Thể loại</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Người chuyển: activate to sort column ascending"
                                            style="width: 60.2px;">Người chuyển</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Mã giao dịch: activate to sort column ascending"
                                            style="width: 60.2px;">Mã giao dịch</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Số tiền: activate to sort column ascending"
                                            style="width: 79.2px;">Số tiền</th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Khuyến mãi: activate to sort column ascending"
                                            style="width: 79.2px;">Khuyến mãi</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Thực nhận: activate to sort column ascending"
                                            style="width: 62.2px;">Thực nhận</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Ghi chú: activate to sort column ascending"
                                            style="width: 629.2px;">Ghi chú</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Thời gian: activate to sort column ascending"
                                            style="width: 113.2px;">Thời gian</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: Content -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        createDataTable('#history_bank', '{{ route('admin.list', 'history-recharge') }}', [{
            data: 'id'
        }, {
            data: 'username'
        }, {
            data: 'type_bank',
        }, {
            data: 'name_bank'
        }, {
            data: 'tranid'
        }, {
            data: 'amount'
        }, {
            data: 'promotion'
        }, {
            data: 'real_amount'
        }, {
            data: 'note'
        }, {
            data: 'created_at'
        }])
    </script>
@endsection
