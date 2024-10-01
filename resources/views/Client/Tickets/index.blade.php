@extends('Layout.App')
@section('title', 'Tạo báo cáo')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Danh sách báo cáo</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Start:: Content -->
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary"><i
                        class="fas fa-plus"></i> Thêm mới</button>
            </div>
            <div class="card-body">
                <form action="{{ route('create.tickets.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="text" class="form-label">Nội dung</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="10">{{ old('text') }}</textarea>
                        @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary">Thêm báo cáo</button>
                    </div>
                </form>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div id="" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="history-tickets"
                                    class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                    aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1" aria-sort="descending"
                                                    aria-label="#: activate to sort column ascending"
                                                    style="width: 18.2125px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Nội dung: activate to sort column ascending"
                                                    style="width: 81.775px;">Nội dung</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Phản hồi: activate to sort column ascending"
                                                    style="width: 52.0625px;">Phản hồi</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Trạng thái: activate to sort column ascending"
                                                    style="width: 103.525px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Thời giang tạo: activate to sort column ascending"
                                                    style="width: 62.375px;">Thời giang tạo</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ant-table-tbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin mới</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                Lưu ý: Mã nguồn này hỗ trợ hầu hết tất cả các Nhà cung cấp API (API v2) như: app.x999.vn,
                                v.v. Vì vậy, mã nguồn này không hỗ trợ nhà cung cấp API khác có các Thông số API khác nhau
                            </div>
                            <form action="https://smmpanel-v3.baocms.net/admin/providers/store" method="POST"
                                class="axios-form" data-reload="1">
                                <input type="hidden" name="_token" value="KxAA7hVWwLBY4zAnvmYKHubYdabrK2BUI64opzEq"
                                    autocomplete="off">
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Tên</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">Loại</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="standard">Standard</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input class="form-control" type="text" id="url" name="url"
                                        placeholder="https://app.x999.vn/api/v2" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="key" class="form-label">Key</label>
                                    <input class="form-control" type="text" id="key" name="key"
                                        required="">
                                </div>
                                <div class="mb-3">
                                    <label for="exchange_rate" class="form-label">Tỷ giá</label>
                                    <input class="form-control" type="number" id="exchange_rate" name="exchange_rate"
                                        required="">
                                </div>
                                <div class="mb-3">
                                    <label for="price_percentage_increase" class="form-label">% Tăng giá</label>
                                    <input class="form-control" type="number" id="price_percentage_increase"
                                        name="price_percentage_increase" required="">
                                    <small>Đây là % tăng giá từ giá gốc lên: nhập 10% thì hệ thống tự động +thêm 10% từ giá
                                        gốc bên nguồn</small>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                </div>
                            </form>
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
        createDataTable('#history-tickets', '{{ route('user.list.action', 'history-tickets') }}', [{
                data: 'id',
            },
            {
                data: 'text',
                render: function(data, type, row) {
                    return `<textarea class="form-input note" rows="3" readonly="" style="min-width: 390px;">${data}</textarea>`;

                }
            },
            {
                data: 'reply',
                render: function(data, type, row) {

                    if (data !== null) {
                        return `<textarea class="form-input note" rows="3" readonly="" style="min-width: 390px;">${data}</textarea>`;
                    } else {
                        return `<textarea class="form-input note" rows="3" readonly="" style="min-width: 390px;"></textarea>`; // Hoặc có thể trả về một giá trị mặc định khác nếu bạn muốn
                    }

                }
            },

            {
                data: 'status',
                render: function(data, type, row) {
                    return data
                }

            },
            {
                data: 'created_at',
                render: function(data) {
                    var formattedDate = moment(data).format('YYYY-MM-DD HH:mm:ss');
                    return formattedDate;
                }

            },
        ])
    </script>
@endsection
