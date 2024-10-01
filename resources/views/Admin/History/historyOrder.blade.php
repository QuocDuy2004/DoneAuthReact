@extends('Admin.Layout.App')

@section('title', 'Lịch sử đơn hàng')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Quản lý đơn hàng</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Add any additional buttons or elements here if needed -->
                </div>
            </div>

            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="alert alert-danger text-dark">
                        <b>
                            @if (getDomain() != env('PARENT_SITE'))
                               - Đường dẫn Cron update dạng thái toàn bộ đơn hàng site con, cháu,...:
                               <a href="https://{{ getDomain() }}/cron/OrderCon">https://{{ getDomain() }}/cron/OrderCon</a>
                            @else
                                - Đường dẫn Cron cập nhập trạng thái đơn hàng Việt Nam: https://{{ getDomain() }}/cron/all<br>
                                - Đường dẫn Cron cập nhập trạng thái đơn hàng SMM PANEL: https://{{ getDomain() }}/cron/order <br>
                                - Đường dẫn Cron đồng bộ SMM PANEL: https://{{ getDomain() }}/cron/sync
                            @endif
                        </br>
                    </div>
                    <div class="card">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                Lịch sử tạo đơn
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="dataTables_wrapper w-100 overflow-x-auto overflow-y-hidden">
                                    <table id="history_order"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                        aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mã đơn</th>
                                                <th>Tài khoản</th>
                                                <th>Thao tác</th>
                                                <th>Dịch vụ</th>
                                                <th>Máy chủ</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                                <th>Đơn hàng</th>
                                                <th>Bắt đầu</th>
                                                <th>Đã tăng</th>
                                                <th>Trạng thái</th>
                                                <th>Ghi chú</th>
                                                <th>Thời gian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table rows will be dynamically populated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                Lịch sử đơn chờ xử lí
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="dataTables_wrapper w-100 overflow-x-auto overflow-y-hidden">
                                    <table id="dontay"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                        aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Thao tác</th>
                                                <th>Tài khoản</th>
                                                <th>Dịch vụ</th>
                                                <th>Máy chủ</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                                <th>Đơn hàng</th>
                                                <th>Bắt đầu</th>
                                                <th>Đã tăng</th>
                                                <th>Trạng thái</th>
                                                <th>Ghi chú</th>
                                                <th>Thời gian</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table rows will be dynamically populated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for updating information -->
            <div class="modal fade" id="modal-update-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin #1</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                Note: This script supports most of all API Providers (API v2) like: vinasmm.com,
                                hqsmartpanel.com etc. So it doesn't support another API provider which have different API
                                Parameters
                            </div>
                            <form action="https://smmpanel-v3.baocms.net/admin/providers/update?id=1" method="POST"
                                class="axios-form" data-reload="1">
                                <input type="hidden" name="_token" value="PesoOOix6JOPRwcZIJTeJBJXymg26IMiCyWCa8IN"
                                    autocomplete="off">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="SMM-DEMO" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input class="form-control" type="text" id="url" name="url"
                                        value="https://smm-api-url.example/api/v2" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="key" class="form-label">Key</label>
                                    <input class="form-control" type="text" id="key" name="key"
                                        value="0e928abc5780ea656380f2eb0bff34fb" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="exchange_rate" class="form-label">Tỷ giá</label>
                                    <input class="form-control" type="number" id="exchange_rate" name="exchange_rate"
                                        value="25000" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="price_percentage_increase" class="form-label">% Tăng giá</label>
                                    <input class="form-control" type="number" id="price_percentage_increase"
                                        name="price_percentage_increase" value="0" required="">
                                    <small>Đây là % tăng giá từ giá gốc lên: nhập 10% thì hệ thống tự động +thêm 10% từ giá
                                        gốc bên nguồn</small>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" selected="">Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($orders as $order)
                <!-- Modal for editing order -->
                <div class="modal fade" id="modal-update-{{ $order->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa đơn hàng #{{ $order->id }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('admin.order.edit.post', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="Refunded" @if ($order->status == 'Refunded') selected @endif>Đã
                                                hoàn</option>
                                            <option value="Success" @if ($order->status == 'Success') selected @endif>Hoàn
                                                thành</option>
                                            <option value="Active" @if ($order->status == 'Active') selected @endif>Hoạt
                                                động</option>
                                            <option value="PendingOrder" @if ($order->status == 'PendingOrder') selected @endif>
                                                Chuẩn bị</option>
                                            <option value="Processing" @if ($order->status == 'Processing') selected @endif>
                                                Đang xử lý</option>
                                            <option value="Holding" @if ($order->status == 'Holding') selected @endif>Tạm
                                                hoãn</option>
                                            <option value="Warranty" @if ($order->status == 'Warranty') selected @endif>Bảo
                                                hành</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start" class="form-label">Bắt đầu</label>
                                        <input class="form-control" type="text" id="start" name="start"
                                            value="{{ $order->start }}" placeholder="" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="buff" class="form-label">Đã chạy</label>
                                        <input class="form-control" type="text" id="buff" name="buff"
                                            value="{{ $order->buff }}" placeholder="" required="">
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
@section('script')
    <script>
        createDataTable('#history_order', '{{ route('admin.list', 'list-order') }}', [{
                data: 'id'
            },
            {
                data: 'order_code',
                render: function(data, type, row) {
                    return `<b class="text-danger">${data}</b>`;
                }
            },
            {
                data: 'username'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                     <button class="btn btn-outline-primary btn-sm" 
        data-bs-toggle="modal" 
        data-bs-target="#modal-update-${data.id}" 
        title="Sửa đơn hàng">
    <i class="fa fa-edit"></i> Sửa
</button>
<button class="btn btn-outline-danger btn-sm" 
        onclick="deleteOrder(${data.id})" 
        title="Xóa đơn hàng">
    <i class="fas fa-trash"></i> Xóa
</button>

                `;
                }
            },
            {
                data: 'service_name',
                render: function(data, type, row) {
                    return `<span class="badge-primary text-dark">${data}</span>`;
                }
            },
            {
                data: 'server_service',
                render: function(data, type, row) {
                    return `<span class="badge-warning text-dark">${data}</span>`;
                }
            },

            {
                data: 'price',
                render: function(data, type, row) {
                    return `<b class="text-primary">${data}</b>`;
                }
            },
            {
                data: 'quantity',
                render: function(data, type, row) {
                    return `<b class="text-info">${formatNumber(data)}</b>`;
                }
            },
            {
                data: 'total_payment',
                render: function(data, type, row) {
                    return `<b class="text-success">${formatNumber(data)}</b>`;
                }
            },
            {
                data: 'order_link'
            },
            {
                data: 'start',
                render: function(data, type, row) {
                    return `<b class="text-secondary">${formatNumber(data)}</b>`;
                }
            },
            {
                data: 'buff',
                render: function(data, type, row) {
                    return `<b class="text-success">${formatNumber(data)}</b>`;
                }
            },
            {
                data: 'status_order'
            },
            {
                data: 'note'
            },
            {
                data: 'created_at'
            }
        ]);

        function deleteOrder(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa đơn hàng này?',
                text: "Bạn sẽ không thể khôi phục lại đơn hàng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.order.delete', 'id') }}'.replace('id', id),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                });
                                $('#history_order').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.message,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Ghi lỗi ra console để kiểm tra chi tiết
                            Swal.fire({
                                icon: 'error',
                                title: 'Đã xảy ra lỗi trong quá trình xóa.',
                            });
                        }
                    });
                }
            });
        }
    </script>

    @if (getDomain() == env('PARENT_SITE'))
        <script>
            createDataTable('#dontay', '{{ route('admin.list', 'order-tay') }}', [{
                    data: 'id'
                }, {
                    data: null,
                    render: function(data, type, row) {
                        return `
                                <button class="btn btn-outline-success btn-sm" 
        onclick="activeOrder('${row.id}')" 
        title="Duyệt đơn hàng">
    <i class="fas fa-check-circle"></i> Duyệt
</button>
                               <button class="btn btn-outline-danger btn-sm" onclick="cancelOrder(${row.id})"  title="Hủy đơn hàng">Xóa</button>
                `
                    }
                },
                {
                    data: 'username'
                }, {
                    data: 'service_name',
                    render: function(data, type, row) {
                        return `<span class=" badge-primary text-dark">${data}</span>`;
                    }
                },
                {
                    data: 'server_service',
                    render: function(data, type, row) {
                        return `<span class="badge-warning text-dark">${data}</span>`;
                    }
                },
                {
                    data: 'price',
                    render: function(data, type, row) {
                        return `<b class="text-primary">${data}</b>`
                    }
                }, {
                    data: 'quantity',
                    render: function(data, type, row) {
                        return `<b class="text-info">${formatNumber(data)}</b>`
                    }
                }, {
                    data: 'total_payment',
                    render: function(data, type, row) {
                        return `<b class="text-success">${formatNumber(data)}</b>`
                    }
                }, {
                    data: 'order_link'
                }, {
                    data: 'start',
                    render: function(data, type, row) {
                        return `<b class="text-seconadry">${formatNumber(data)}</b>`
                    }
                }, {
                    data: 'buff',
                    render: function(data, type, row) {
                        return `<b class="text-success">${formatNumber(data)}</b>`
                    }
                }, {
                    data: 'status_order'
                }, {
                    data: 'note'
                }, {
                    data: 'created_at'
                }, {
                    data: null,
                    render: function(data, type, row) {
                        return ''
                    }
                }
            ])

            function activeOrder(id) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn duyệt đơn này?',
                    text: "Bạn sẽ không thể khôi phục lại đơn hàng này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Duyệt',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.order.active.post') }}',
                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: data.message,
                                    })
                                    $('#history_order').DataTable().ajax.reload()
                                    $('#dontay').DataTable().ajax.reload()
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: data.message,
                                    })
                                }
                            }
                        })
                    }
                })
            }

            function cancelOrder(id) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn hủy đơn này?',
                    text: "Bạn sẽ không thể khôi phục lại đơn hàng này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Hủy',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.order.cancel.post') }}',
                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: data.message,
                                    });
                                    $('#history_order').DataTable().ajax.reload();
                                    $('#dontay').DataTable().ajax.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: data.message,
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Đã xảy ra lỗi trong quá trình hủy.',
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endif
@endsection
