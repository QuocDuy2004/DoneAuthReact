@extends('Layout.App')
@section('title', 'Nạp tiền thẻ cào')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">

                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fa fa-plus mx-1 align-middle"></i>{{ __('balance') }}: <span
                            class="user-balance">₫{{ number_format(Auth::user()->balance) }}</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Nạp thẻ cào</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('recharge.card.post') }}" method="POST" request="duymedia">
                                <div class="mb-3">
                                    <label for="telco" class="form-label">Loại thẻ</label>
                                    <select name="telco" id="telco" onchange="rebill()" class="form-select">
                                        <option value="">-- Chọn Loại Thẻ --</option>
                                        <option value="VIETTEL">Viettel (Chiết khấu: 25%)</option>
                                        <option value="MOBIFONE">Mobifone (Chiết khấu: 25%)
                                        </option>
                                        <option value="VINAPHONE">Vinaphone (Chiết khấu: 25%)
                                        </option>
                                        <option value="ZING">Zing (Chiết khấu: 25%)</option>
                                        <option value="GATE">Gate (Chiết khấu: 25%)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Mệnh giá</label>
                                    <select nname="amount" id="amount" onchange="rebill()" class="form-select">
                                        <option value="10000">10.000</option>
                                        <option value="20000">20.000</option>
                                        <option value="30000">30.000</option>
                                        <option value="50000">50.000</option>
                                        <option value="100000">100.000</option>
                                        <option value="200000">200.000</option>
                                        <option value="300000">300.000</option>
                                        <option value="500000">500.000</option>
                                        <option value="1000000">1.000.000</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="serial" class="form-label">Số serial</label>
                                    <input type="text" class="form-control" name="serial" id="serial"
                                        placeholder="Nhập số serial" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã thẻ</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="Nhập mã thẻ" required="">
                                </div>
                                <div class="text-center mb-3">
                                    <h3 class="real_amount text-danger">7.500&nbsp;₫</h3>
                                    <span class="">Nhận được
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100">Nạp thẻ ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Hướng dẫn nạp tiền</h3>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử nạp thẻ</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row dt-row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered text-nowrap datatable dataTable no-footer"
                                                style="width: 100%;" id="DataTables_Table_0"
                                                aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="ID: activate to sort column ascending"
                                                            style="width: 67.2px;">ID</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Trạng thái: activate to sort column ascending"
                                                            style="width: 67.2px;">Trạng thái</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Ngày nạp: activate to sort column ascending"
                                                            style="width: 63.2px;">Ngày nạp</th>
                                                        <th class="sorting sorting_desc" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1" aria-sort="descending"
                                                            aria-label="Nhà mạng: activate to sort column ascending"
                                                            style="width: 68.4px;">Nhà mạng</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Mệnh giá: activate to sort column ascending"
                                                            style="width: 61.2px;">Mệnh giá</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Serial: activate to sort column ascending"
                                                            style="width: 39.2px;">Serial</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Pin: activate to sort column ascending"
                                                            style="width: 22.2px;">Pin</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Thực nhận: activate to sort column ascending"
                                                            style="width: 71.2px;">Thực nhận</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Thao tác: activate to sort column ascending"
                                                            style="width: 52.2px;">Thao tác</th>
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
@endsection

@section('script')
    <script>
        function rebill() {
            var telco = $('#telco').val();
            var amount = $('#amount').val();
            var received = 0;
            var telco_name = '';
            var telco_amount = 0;
            var discount = {{ DataSite('card_discount') }};

            telco_amount = amount - (amount * discount / 100);
            received = amount - (amount * discount / 100);
            $('#received').html(Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(received));
            $('#telco-name').html(telco_name);
            $('#telco-amount').html(Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(telco_amount));
        }
        createDataTable('#testds', '{{ route('user.list.action', 'history-card') }}', [{
                data: 'id'
            },
            {
                data: 'status'
            }, {
                data: 'created_at'
            }, {
                data: 'card_type'
            }, {
                data: 'card_amount'
            }, {
                data: 'card_serial'
            }, {
                data: 'card_code'
            }, {
                data: 'card_real_amount',
                render: function(data, type, row) {
                    return `<b class="text-success">${formatNumber(data)}đ</b>`
                }
            }, {
                data: null,
                render: function(data, type, row) {
                    return 'ds'
                }
            }
        ])
    </script>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Thông báo',
                text: 'Vui lòng chọn đúng mệnh giá thẻ nạp!',
                icon: '',
                confirmButtonText: 'Tôi Đã Hiểu'
            })
        });
    </script>
@endsection
