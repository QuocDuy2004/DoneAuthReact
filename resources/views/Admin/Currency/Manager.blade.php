@extends('Admin.Layout.App')

@section('title', 'Quản lý tiền tệ')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h3 class="page-title">Quản lý tiền tệ</h3>
            </div>
            <!-- Page Header Close -->

            <!-- Error Handling -->
            @if (isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif

            <!-- Conversion Form -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Chuyển đổi tiền tệ</h3>

                    <form method="GET" action="{{ route('admin.currency.manager') }}">
                        <div class="form-group">
                            <label for="from_currency">Chọn tiền tệ:</label>
                            <select class="form-control" id="from_currency" name="from_currency">
                                @foreach ($rates as $currency => $rate)
                                    <option value="{{ $currency }}" {{ $fromCurrency == $currency ? 'selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Nhập số tiền:</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="{{ $amount }}" placeholder="Nhập số tiền để chuyển đổi" min="0"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="currency_decimal">Thập phân:</label>
                            <input type="number" name="currency_decimal" id="currency_decimal" class="form-control"
                                min="0" value="{{ $decimal }}">
                        </div>

                        <div class="form-group">
                            <label for="currency_position">Vị trí ký hiệu:</label>
                            <select class="form-control" id="currency_position" name="currency_position">
                                <option value="left" {{ $currency_position == 'left' ? 'selected' : '' }}>Bên trái
                                </option>
                                <option value="right" {{ $currency_position == 'right' ? 'selected' : '' }}>Bên phải
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Trạng thái:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="show" {{ $status == 'show' ? 'selected' : '' }}>Hiển thị</option>
                                <option value="hide" {{ $status == 'hide' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Chuyển đổi</button>
                    </form>

                    <!-- Conversion Results Table -->
                    @if (!empty($conversionResults))
                        <h4 class="mt-4">Kết quả chuyển đổi</h4>
                        <form method="POST" action="{{ route('admin.currency.manager.post') }}">
                            @csrf
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Tiền tệ</th>
                                        <th>Ký hiệu</th>
                                        <th>Số tiền</th>
                                        <th>Tỷ giá</th>
                                        <th>Vị trí</th>
                                        <th>Số tiền quy đổi (USD)</th>
                                        <th>Trạng thái</th>
                                        <th>Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($conversionResults as $result)
                                        @if ($status == 'show')
                                            <tr>
                                                <td>{{ $result['currency'] }}</td>
                                                <td>{{ $result['currency_symbol'] }}</td>
                                                <td>{{ number_format($result['amount']) }}</td>
                                                <td>{{ number_format($result['rate']) }}</td>
                                                <td>
                                                    @if ($result['currency_position'] == 'left')
                                                        <span>Bên trái</span>
                                                    @else
                                                        <span>Bên phải</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_format($result['converted_amount'], $decimal) }}</td>
                                                <td>{{ $result['status'] }}</td>
                                                <td>
                                                    <input type="checkbox" name="currencies[]"
                                                        value="{{ json_encode($result) }}">
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary mt-3">Lưu vào cơ sở dữ liệu</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Database Currencies Table -->
            <h4 class="mt-4">Danh sách tiền tệ từ cơ sở dữ liệu</h4>
            <a class="btn btn-primary mt-3" href="#">Cập nhập giá tiền tệ</a>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Tên tiền tệ</th>
                        <th>Mã tiền tệ</th>
                        <th>Ký hiệu</th>
                        <th>Giá</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($currencies as $currency)
                        <tr>
                            <td>{{ $currency->currency_name }}</td>
                            <td>{{ $currency->currency_code }}</td>
                            <td>{{ $currency->currency_symbol }}</td>
                            <td>{{ $currency->rate }}</td>
                            <td>{{ $currency->currency_position }}</td>
                            <td>{{ $currency->status }}</td>
                            <td>
                                <form action="{{ route('admin.currency.delete', $currency->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-labelledby="editCurrencyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCurrencyModalLabel">Sửa Tiền Tệ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCurrencyForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currency_name" class="form-label">Tên tiền tệ</label>
                            <input type="text" class="form-control" id="currency_name" name="currency_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="currency_code" class="form-label">Mã tiền tệ</label>
                            <input type="text" class="form-control" id="currency_code" name="currency_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="currency_symbol" class="form-label">Ký hiệu</label>
                            <input type="text" class="form-control" id="currency_symbol" name="currency_symbol"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="rate" class="form-label">Giá</label>
                            <input type="number" step="0.01" class="form-control" id="rate" name="rate"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="currency_position" class="form-label">Vị trí</label>
                            <input type="text" class="form-control" id="currency_position" name="currency_position"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
