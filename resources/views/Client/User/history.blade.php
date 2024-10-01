@extends('Layout.App')
@section('title', 'Lịch sử tài khoản')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fa fa-plus mx-1 align-middle"></i>{{ __('balance') }}: 
                        <span class="user-balance">₫{{ number_format(Auth::user()->balance) }}</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Quản lý đơn hàng</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="history_user" class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài khoản</th>
                                    <th>Loại</th>
                                    <th>Số dư trước</th>
                                    <th>Số tiền thay đổi</th>
                                    <th>Số dư hiện tại</th>
                                    <th>Ghi chú</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var table = createDataTable('#history_user', '{{ route('user.list.action', 'history-user') }}', [{
                data: 'id',
            },
            {
                data: 'username',
            },
            {
                data: 'action',
                render: function(data) {
                    return `<span class="text-primary">` + data + `</span>`;
                }
            },
            {
                data: 'old_data',
                render: function(data) {
                    return `<span class="text-danger">` + formatNumber(parseInt(data)) + `</span>`;
                }
            },
            {
                data: 'data',
                render: function(data) {
                    return `<span class="text-warning">` + formatNumber(data) + `</span>`;
                }
            },
            {
                data: 'new_data',
                render: function(data) {
                    return `<span class="text-success">` + formatNumber(parseInt(data)) + `</span>`;
                }
            },
            {
                data: 'description',
            },
            {
                data: 'created_at',
                render: function(data) {
                    return moment(data).format('YYYY-MM-DD HH:mm:ss');
                }
            }
        ]);

        // Handle filter button click
        $('#btn_filter').on('click', function() {
            filterForm();
        });

        function filterForm() {
            var filter_id = $('#filter_id').val();
            var filter_username = $('#filter_username').val();
            var service_id = $('#service_id').val();

            table.ajax.url('{{ route('user.list.action', 'history-user') }}?' + $.param({
                filter_id: filter_id,
                filter_username: filter_username,
                service_id: service_id,
            })).load();
        }
    });
</script>
@endsection
