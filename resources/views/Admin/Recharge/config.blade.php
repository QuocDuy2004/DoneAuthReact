@extends('Admin.Layout.App')

@section('title', 'Cấu hình nạp tiền')

@section('content')

    <div class="main-content app-content">
        <div class="row ">
            <div class="col-md-6 mb-3">
                <div class="card card-flush">

                    <div class="card-content">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                MOMO tự động (&nbsp;<a href="https://api.sieuthicode.net/" class="text-primary"
                                    target="_blank" rel="noopener noreferrer"> api.sieuthicode.net </a>)
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">

                            @if ($momo)
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="momo">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $momo->account_name }}">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name"
                                            value="{{ $momo->account_number }}">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name"
                                            value="{{ $momo->password }}">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name"
                                            value="{{ $momo->api_token }}">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/momo"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>

                                </form>
                            @else
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="momo">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/momo"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>

                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                MBBANK tự động (&nbsp;<a href="https://api.sieuthicode.net/" class="text-primary"
                                    target="_blank" rel="noopener noreferrer"> api.sieuthicode.net </a>)
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($mbbank)
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="mbbank">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $mbbank->account_name }}">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name"
                                            value="{{ $mbbank->account_number }}">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name"
                                            value="{{ $mbbank->password }}">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name"
                                            value="{{ $mbbank->api_token }}">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/mbbank"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="mbbank">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/mbbank"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">

                    <div class="card-content">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                ACB tự động (&nbsp;<a href="https://api.sieuthicode.net/" class="text-primary"
                                    target="_blank" rel="noopener noreferrer"> api.sieuthicode.net </a>)
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">

                            @if ($acb)
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="acb">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $acb->account_name }}">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name"
                                            value="{{ $acb->account_number }}">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name"
                                            value="{{ $acb->password }}">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name"
                                            value="{{ $acb->api_token }}">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/acb"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="acb">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/acb"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>

                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">

                    <div class="card-content">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                VIETCOMBANK tự động (&nbsp;<a href="https://api.sieuthicode.net/"
                                    class="text-primary" target="_blank" rel="noopener noreferrer"> api.sieuthicode.net
                                </a>)
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">

                            @if ($vietcombank)
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="vietcombank">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ $vietcombank->account_name }}">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name"
                                            value="{{ $vietcombank->account_number }}">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name"
                                            value="{{ $vietcombank->password }}">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name"
                                            value="{{ $vietcombank->api_token }}">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/vietcombank"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('admin.recharge.config.post') }}" method="POST" request="duymedia">
                                    <input type="hidden" name="type" value="vietcombank">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                        <label><span class="form-label">Chủ tài khoản</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="stk" placeholder="Name">
                                        <label><span class="form-label">Số tài khoản</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Name">
                                        <label><span class="form-label">Mật khẩu</span></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="api_token" placeholder="Name">
                                        <label><span class="form-label">API Key</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" placeholder="Name"
                                            value="https://{{ getdomain() }}/cronJob/recharge-transfer/vietcombank"
                                            readonly="">
                                        <label><span class="form-label">Link cron</span></label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhập</button>
                                    </div>

                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">

                    <div class="card-content">
                        <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                            <div class="ribbon-label text-uppercase fw-bold bg-default">
                                Card tự động (&nbsp;<a href="https://trumcard1s.vn/" class="text-primary"
                                    target="_blank" rel="noopener noreferrer">trumcard1s.vn</a>)
                                <span class="ribbon-inner bg-default"></span>
                            </div>
                        </div>
                        <div class="card-body">


                            <form action="{{ route('admin.recharge.card.post') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="partner_id" placeholder="Name"
                                        value="{{ DataSite('partner_id') }}">
                                    <label><span class="form-label">Partner ID</span></label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="partner_key" placeholder="Name"
                                        value="{{ DataSite('partner_key') }}">
                                    <label><span class="form-label">Partner Key</span></span></label>
                                </div>


                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="card_discount" placeholder="Name"
                                        value="{{ DataSite('card_discount') }}">
                                    <label><span class="form-label">Chiết khấu</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Name"
                                        value="https://{{ getdomain() }}/cronJob/recharge-card" readonly="">
                                    <label><span class="form-label">Link callback</span></label>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary col-12">Lưu ngay</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                        <div class="ribbon-label text-uppercase fw-bold bg-default">
                            Cấu hình giảm giá
                            <span class="ribbon-inner bg-default"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.recharge.promotion.post') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <select type="text" class="form-control" name="action">
                                    <option value="show" @if (DataSite('show_promotion') == 'show') selected @endif>Hiển thị
                                    </option>
                                    <option value="hide" @if (DataSite('show_promotion') == 'hide') selected @endif>Ẩn</option>
                                </select>
                                <label><span class="form-label">Hiển thị thông báo khuyến
                                        mãi</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="promotion"
                                    value="{{ DataSite('recharge_promotion') }}" placeholder="Name">
                                <label><span class="form-label">Khuyến mãi </span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="start_promotion"
                                    value="{{ DataSite('start_promotion') }}" placeholder="Name">
                                <label><span class="form-label">Thời gian bắt đầu</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="end_promotion"
                                    value="{{ DataSite('end_promotion') }}" placeholder="Name">
                                <label><span class="form-label">Thời gian kết thúc</span></label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary col-12">Lưu cấu hình nạp tiền</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                        <div class="ribbon-label text-uppercase fw-bold bg-default">
                            Danh sách ngân hàng
                            <span class="ribbon-inner bg-default"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="" class="dataTables_wrapper">
                                <table id="testds"
                                    class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                    aria-describedby="file_export_info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên ngân hàng</th>
                                            <th>Tài khoản</th>
                                            <th>Số tài khoản</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
        createDataTable('#testds', '{{ route('admin.list', 'list-recharge') }}', [{
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
                        <a href="{ route('admin.service.delete', 'id') }}" class="btn btn-outline-danger btn-sm"> <i class="fa fa-trash"></i> Xóa</a>
                    `.replace('id', data.id)
            }
        }])
    </script>
@endsection
