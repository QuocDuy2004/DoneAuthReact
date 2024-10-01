@extends('Admin.Layout.App')

@section('title', 'Lịch sử người dùng')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Lịch sử người dùng </h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Alert Component -->
            <!-- Alert Component Close -->

            <!-- Start:: Content -->
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Danh sách giao dịch</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div id="basic-1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="display table table-bordered table-stripped text-nowrap dataTable no-footer"
                                id="history" aria-describedby="basic-1_info" style="width: 1475px;">
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
                                            colspan="1" aria-label="Số tiền: activate to sort column ascending"
                                            style="width: 79.2px;">Số tiền</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Số dư trước: activate to sort column ascending"
                                            style="width: 72.2px;">Số dư trước</th>
                                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                            colspan="1" aria-label="Số dư sau: activate to sort column ascending"
                                            style="width: 62.2px;">Số dư sau</th>
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
        createDataTable('#history', '{{ route('admin.list', 'history-user') }}', [{
                data: 'id',
            },
            {
                data: 'username',
            },
            {
                data: 'action',
                render: function(data) {
                return `<span class="text-primary">` + formatNumber(data) + `</span>`;
                }
            },

            {
                data: 'data',
                render: function(data) {
                    return `<span class="text-danger">` + formatNumber(data) + `</span>`
                }
            },
            {
                data: 'old_data',
                render: function(data) {
                    return `<span class="text-primary">` + formatNumber(data) + `</span>`
                }
            },
            {
                data: 'new_data',
                render: function(data) {
                    return `<span class="text-success">` + formatNumber(data) + `</span>`
                }
            },
            {
                data: 'description',
            },
            {
                data: 'created_at',
            },
        ])
    </script>
@endsection
