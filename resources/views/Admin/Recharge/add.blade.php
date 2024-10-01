@extends('Admin.Layout.App')

@section('title', 'Thêm ngân hàng')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Cấu hình ngân hàng</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Thêm ngân hàng -->
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="row">
                <!-- Phần tạo mới ngân hàng -->
                <div class="col-md-4">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Thêm ngân hàng mới</div>
                        </div>
                        <!-- Nav Pills -->
                        <!-- Nav Pills -->
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <!-- Tab "Thêm Ngân Hàng" (Active Tab) -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-add-bank-tab" data-bs-toggle="pill"
                                    href="#pills-add-bank" role="tab" aria-controls="pills-add-bank"
                                    aria-selected="true">Thêm Ngân Hàng</a>
                            </li>
                            <!-- Tab "Ngân hàng khác" -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="false">Ví thanh toán</a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <!-- Tab Content "Thêm Ngân Hàng" (Active Content) -->
                            <div class="tab-pane fade show active" id="pills-add-bank" role="tabpanel"
                                aria-labelledby="pills-add-bank-tab">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <form action="{{ route('admin.recharge.add.post') }}" method="POST">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="namebank" class="form-label">Tên ngân hàng (Viết hoa liền vd:
                                                    MB, ACB, VCB,..)</label>
                                                <input class="form-control" type="text" id="namebank" name="namebank"
                                                    required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nametk" class="form-label">Chủ tài khoản</label>
                                                <input class="form-control" type="text" id="nametk" name="nametk"
                                                    required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="sotaikhoan" class="form-label">Số tài khoản</label>
                                                <input class="form-control" type="text" id="sotaikhoan" name="sotaikhoan"
                                                    required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">Đường dẫn logo ngân hàng</label>
                                                <input class="form-control" type="text" id="logo" name="logo"
                                                    required="">
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab Content "Ngân hàng khác" -->
                            <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <form action="{{ route('admin.payment.add.post') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="namebank" class="form-label">Tên (Binance , Perfect Money, Payeer, VNPAY)</label>
                                            <input class="form-control" type="text" id="namebank" name="namebank"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nametk" class="form-label">Chủ tài khoản</label>
                                            <input class="form-control" type="text" id="nametk" name="nametk"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sotaikhoan" class="form-label">Số tài khoản</label>
                                            <input class="form-control" type="text" id="sotaikhoan" name="sotaikhoan"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Đường dẫn logo</label>
                                            <input class="form-control" type="text" id="logo" name="logo"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Phần danh sách ngân hàng -->
                <div class="col-md-8">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Danh sách ngân hàng</div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table id="list_bank" class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-2">Tên ngân hàng</th>
                                            <th class="col-1">Tài khoản</th>
                                            <th>Số tài khoản</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
        $(document).ready(function() {
            createDataTable('#list_bank', '{{ route('admin.list', 'list-recharge') }}', [{
                data: 'id'
            }, {
                data: 'type'
            }, {
                data: 'account_name'
            }, {
                data: 'account_number'
            }, {
                data: null,
                render: function(data, type, row) {
                    return `
                    <a href="{{ route('admin.recharge.delete', 'id') }}" class="btn btn-outline-danger btn-sm"> <i class="fa fa-trash"></i> Xóa</a>`
                        .replace(/id/g, data.id);
                }
            }]);
        });
    </script>
@endsection
