@extends('Admin.Layout.App')

@section('title', 'Danh sách thành viên')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Danh sách thành viên hệ thống</h1>
            </div>
            <!-- Page Header Close -->

            <!-- Alert Component -->
            <!-- Alert Component Close -->

            <!-- Start:: Content -->
            <div class="col-12">
                <div class="d-flex justify-content-end mb-3 gap-2">
                    <bautton data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Tổng thành viên: {{ number_format($total_user) }}
                    </bautton>
                    <button data-bs-toggle="modal" data-bs-target="#modal-notes" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Tổng cộng tác viên: {{ number_format($total_ctv) }}
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-price" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Tổng đại lý: {{ number_format($total_daily) }}
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-price" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Tổng nhà phân phối: {{ number_format($total_npp) }}
                    </button>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <!-- Modal -->
                        @foreach ($users as $user)
                            <!-- User List Display -->
                            <div class="modal fade" id="modal-update-info-{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $user->id }}">Cập nhật thông tin
                                                #{{ $user->id }}</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-none" id="error-alert-{{ $user->id }}">
                                            </div>
                                            <div class="alert alert-success d-none" id="success-alert-{{ $user->id }}">
                                            </div>

                                            <form action="{{ route('admin.user.list.post', $user->id) }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Họ và tên</label>
                                                    <input class="form-control bg-light" type="text" name="name"
                                                        value="{{ $user->name }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control bg-light" type="email" name="email"
                                                        value="{{ $user->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Tài khoản</label>
                                                    <input class="form-control" type="text" name="username"
                                                        value="{{ $user->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="balance" class="form-label">Số dư</label>
                                                    <input class="form-control" type="text" name="balance"
                                                        value="{{ $user->balance }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="level" class="form-label">Cấp bậc</label>
                                                    <select class="form-control" name="level">
                                                        <option value="1"
                                                            @if ($user->level == 1) selected @endif>Thành
                                                            viên</option>
                                                        <option value="2"
                                                            @if ($user->level == 2) selected @endif>Cộng
                                                            tác viên</option>
                                                        <option value="3"
                                                            @if ($user->level == 3) selected @endif>Đại lý
                                                        </option>
                                                        <option value="4"
                                                            @if ($user->level == 4) selected @endif>Nhà
                                                            phân phối</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="level" class="form-label">Cấp bậc</label>
                                                    <select class="form-control" name="level">
                                                        <option value="1"
                                                            @if ($user->level == 1) selected @endif>Thành
                                                            viên</option>
                                                        <option value="2"
                                                            @if ($user->level == 2) selected @endif>Cộng
                                                            tác viên</option>
                                                        <option value="3"
                                                            @if ($user->level == 3) selected @endif>Đại lý
                                                        </option>
                                                        <option value="4"
                                                            @if ($user->level == 4) selected @endif>Nhà
                                                            phân phối</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Trạng thái</label>
                                                    <select class="form-control" name="status">
                                                        <option value="active"
                                                            @if ($user->status == 'active') selected @endif>Hoạt
                                                            động</option>
                                                        <option value="banner"
                                                            @if ($user->status != 'active') selected @endif>Bị
                                                            khoá</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                                </div>
                                            </form>
                                            <div class="spinner-border d-none" id="loading-{{ $user->id }}"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($users as $user)
                            <!-- Modal cho việc cập nhật số dư -->
                            <div class="modal fade" id="modal-update-balance-{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $user->id }}">Cập nhật số tiền
                                                #{{ $user->id }}</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-none" id="error-alert-{{ $user->id }}">
                                            </div>
                                            <div class="alert alert-success d-none" id="success-alert-{{ $user->id }}">
                                            </div>

                                            <form action="{{ route('admin.user.balance.post', $user->id) }}"
                                                method="POST">
                                                @csrf

                                                
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Tài khoản</label>
                                                    <input class="form-control bg-light" type="text" name="username"
                                                        value="{{ $user->username }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="balance" class="form-label">Số tiền cần cộng/trừ</label>
                                                    <input class="form-control" type="text" name="balance"
                                                        value="">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="action" class="form-label">Thao tác</label>
                                                    <select class="form-control" name="action">
                                                        <option value="plus">Cộng tiền</option>
                                                        <option value="minus">Trừ tiền</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                                </div>
                                            </form>
                                            <div class="spinner-border d-none" id="loading-{{ $user->id }}"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        @foreach ($users as $user)
                        <div class="modal fade" id="modal-update-password-{{ $user->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $user->id }}">Cập nhật mật khẩu
                                            #{{ $user->id }}</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger d-none" id="error-alert-{{ $user->id }}">
                                        </div>
                                        <div class="alert alert-success d-none" id="success-alert-{{ $user->id }}">
                                        </div>

                                        <form action="{{ route('admin.user.change-password.post', $user->id) }}"
                                            method="POST">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Mật khẩu mới</label>
                                                <input class="form-control" type="text" name="password"
                                                    value="">
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirm" class="form-label">Xác nhận mật khẩu mới</label>
                                                <input class="form-control" type="text" name="password_confirm"
                                                    value="">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                            </div>
                                        </form>
                                        <div class="spinner-border d-none" id="loading-{{ $user->id }}"
                                            role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach



                        <div id="" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="dataTables_scroll">
                                                    <div class="dataTables_scrollHead"
                                                        style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                                        <div class="dataTables_scrollHeadInner">
                                                            <table id="users"
                                                                class="table border table-striped table-bordered display text-nowrap responsive w-100 no-footer dtr-inline collapsed dataTable"
                                                                aria-describedby="history_info"
                                                                style="margin-left: 0px; width: 1696.86px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Họ tên</th>
                                                                        <th>Email</th>
                                                                        <th>Tài khoản</th>
                                                                        <th>Số dư</th>
                                                                        <th>Tổng nạp</th>
                                                                        <th>Cấp bậc</th>
                                                                        <th>IP</th>
                                                                        <th>Đăng nhập gần đây</th>
                                                                        <th>Trạng thái</th>
                                                                        <th>Thao tác</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        createDataTable('#users', '{{ route('admin.list', 'list-user') }}', [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'username'
            },
            {
                data: 'balance',
                render: function(row, type, index) {
                    return `<span class="badge badge-success bg-success badge-pill">${formatNumber(row)}</span>`
                }
            }, {
                data: 'total_recharge',
                render: function(row, type, index) {
                    return `<span class="badge badge-primary bg-primary badge-pill">${formatNumber(row)}</span>`
                }
            }, {
                data: 'level'
            }, {
                data: 'ip'
            }, {
                data: 'last_login'
            }, {
                data: 'status',
                render: function(row, type, index) {
                    if (row == 'active') {
                        return `<span class="badge badge-success bg-success">Hoạt động</span>`
                    } else {
                        return `<span class="badge badge-danger bg-danger">Khóa</span>`
                    }
                }
            }, {
                data: null,
                render: function(row, type, index) {
                    return `
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-update-info-${row.id}" class="btn btn-sm btn-primary">Sửa</a>
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-update-balance-${row.id}" class="btn btn-sm btn-success">Số tiền</a>
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-update-password-${row.id}" class="btn btn-sm btn-secondary">Đổi mật khẩu</a>
        <a href="javascript:;" onclick="viewUser('${row.id}')" class="btn btn-sm btn-warning">Truy cập</a>
        <a href="javascript:;" onclick="deleteUser('${row.id}')" class="btn btn-sm btn-danger">Xóa</a>
    `;
                }

            }
        ])

        function deleteUser(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Bạn sẽ không thể khôi phục lại dữ liệu!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/user/delete/${id}`,
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Xóa thành công.',
                                    'success'
                                )
                                $('#users').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Xóa thất bại!',
                                    'Xóa thất bại.',
                                    'error'
                                )
                            }
                        }
                    })
                }
            })
        }
    </script>
@endsection
