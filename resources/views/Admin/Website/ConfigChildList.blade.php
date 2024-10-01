@extends('Admin.Layout.App')

@section('title', 'Quản lí website con')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Danh sách website</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Alert Component -->
            <!-- Alert Component Close -->

            <!-- Start:: Content -->
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Quản lý website</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div class="modal fade" id="modal-edit-1" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin
                                            #1</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="https://smmpanel-v3.baocms.net/admin/banks/accounts/update"
                                            method="POST" enctype="multipart/form-data" class="default-form"></form>
                                        <input type="hidden" name="_token"
                                            value="QDwMdZiziA0hPWAMFMEY1VQJXxZxRZjtJgSZz8OO" autocomplete="off"> <input
                                            type="hidden" name="id" value="1">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Tên miền</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="qrcode" class="form-label">Link QRCode</label>
                                            <input class="form-control" type="text" id="qrcode" name="qrcode"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Thời gian</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="TPBank" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Số tài khoản</label>
                                            <input class="form-control" type="text" id="number" name="number"
                                                value="0000000001" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="owner" class="form-label">Thao tác</label>
                                            <input class="form-control" type="text" id="owner" name="owner"
                                                value="TAI KHOAN TEST" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Chi nhánh</label>
                                            <input class="form-control" type="text" id="branch" name="branch"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trạng thái</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Hoạt
                                                    động
                                                </option>
                                                <option value="0">Không
                                                    hoạt động
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-edit-2" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin
                                            #2</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="https://smmpanel-v3.baocms.net/admin/banks/accounts/update"
                                            method="POST" enctype="multipart/form-data" class="default-form"></form>
                                        <input type="hidden" name="_token"
                                            value="QDwMdZiziA0hPWAMFMEY1VQJXxZxRZjtJgSZz8OO" autocomplete="off"> <input
                                            type="hidden" name="id" value="2">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Tên miền</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="qrcode" class="form-label">Link QRCode</label>
                                            <input class="form-control" type="text" id="qrcode" name="qrcode"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Thời gian</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="Vietcombank" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Số tài khoản</label>
                                            <input class="form-control" type="text" id="number" name="number"
                                                value="0000000002" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="owner" class="form-label">Thao tác</label>
                                            <input class="form-control" type="text" id="owner" name="owner"
                                                value="TAI KHOAN TEST" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Chi nhánh</label>
                                            <input class="form-control" type="text" id="branch" name="branch"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trạng thái</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Hoạt
                                                    động
                                                </option>
                                                <option value="0">Không
                                                    hoạt động
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-edit-3" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin
                                            #3</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="https://smmpanel-v3.baocms.net/admin/banks/accounts/update"
                                            method="POST" enctype="multipart/form-data" class="default-form"></form>
                                        <input type="hidden" name="_token"
                                            value="QDwMdZiziA0hPWAMFMEY1VQJXxZxRZjtJgSZz8OO" autocomplete="off"> <input
                                            type="hidden" name="id" value="3">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Tên miền</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="qrcode" class="form-label">Link QRCode</label>
                                            <input class="form-control" type="text" id="qrcode" name="qrcode"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Thời gian</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="MOMO" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="number" class="form-label">Số tài khoản</label>
                                            <input class="form-control" type="text" id="number" name="number"
                                                value="0000000003" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="owner" class="form-label">Thao tác</label>
                                            <input class="form-control" type="text" id="owner" name="owner"
                                                value="VI DIEN TU" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Chi nhánh</label>
                                            <input class="form-control" type="text" id="branch" name="branch"
                                                value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trạng thái</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Hoạt
                                                    động
                                                </option>
                                                <option value="0">Không
                                                    hoạt động
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="list_website"
                                    class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                    aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_desc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-sort="descending"
                                                    aria-label="#: activate to sort column ascending"
                                                    style="width: 12.8875px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tài khoản: activate to sort column ascending"
                                                    style="width: 63.7125px;">Tài khoản</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tên miền: activate to sort column ascending"
                                                    style="width: 72.9px;">Tên miền</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Trạng thái: activate to sort column ascending"
                                                    style="width: 103.438px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Thời gian: activate to sort column ascending"
                                                    style="width: 104.863px;">Thời gian</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Thao tác: activate to sort column ascending"
                                                    style="width: 105.45px;">Thao tác</th>
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
@endsection
@section('script')
    <script>
        createDataTable('#list_website', '{{ route('admin.list', 'list-site') }}', [{
            data: 'id'
        }, {
            data: 'username'
        }, {
            data: 'domain_name',
            render: function(type, data, row) {
                return `<a href="https://${type}" target="_blank" class="btn btn-outline-primary btn-sm">${type}</a>`
            }
        }, {
    data: 'status',
    render: function(data, type, row) {
        if (data == 'Pending') {
            return `<span class="btn btn-secondary">Đang chờ duyệt</span>`;
        } else if (data == 'Pending_Cloudflare') {
            return `<span class="btn btn-outline-warning btn-sm">Vui lòng duyệt Cloudflare </span>`;
        } else if (data == 'Active') {
            return `<span class="btn btn-outline-success btn-sm">Đang hoạt động</span>`;
        } else {
            return `<span class="btn btn-outline-danger btn-sm">Không xác định</span>`;
        }
    }
},
 {
            data: 'created_at'
        }, {
            data: null,
            render: function(data, type, row) {
    if (row.status == 'Pending') {
        return `
            <button class="btn btn-outline-success btn-sm" onclick="activeDomain('${row.domain_name}')">
                            <i class="fa fa-edit"></i> Duyệt
            </button>
            <button class="btn btn-outline-danger btn-sm" onclick="deleteDomain('${row.domain_name}')">
                            <i class="fa fa-edit"></i> Xóa
            </button>
        `;
    } else {
        return `
            <button class="btn btn-outline-success btn-sm" onclick="activeDomain('${row.domain_name}')">
                            <i class="fa fa-edit"></i> Duyệt
                        </button>
            <button class="btn btn-outline-danger btn-sm" onclick="deleteDomain('${row.domain_name}')">
                            <i class="fa fa-edit"></i> Xóa
            </button>
        `;
    }
}

        }])
    </script>

    <script>
        function activeDomain(domain) {
            Swal.fire({
                title: 'Thông báo!',
                text: 'Bạn có chắc chắn muốn duyệt website này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Duyệt',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.website-child.active.post') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            domain: domain
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Đang duyệt website!',
                                html: 'Vui lòng chờ trong giây lát...',



                                didOpen: () => {
                                    Swal.showLoading();
                                },
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            })
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Đã duyệt!',
                                    'Duyệt cloudflare thành công.',
                                    'success'
                                )
                                $('#list_website').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    data.message,
                                    'error'
                                )
                            }
                        }
                    })
                }
            })
        }

        function deleteDomain(domain) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa website này?',
                text: "Bạn sẽ không thể khôi phục lại website này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.delete', 'delete-site') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            domain: domain
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Website đã được xóa.',
                                    'success'
                                )
                                $('#list_website').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    data.message,
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
