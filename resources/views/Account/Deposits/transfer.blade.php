@extends('Layout.App')
@section('title', 'Nạp tiền chuyển khoản')
@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fa fa-plus mx-1 align-middle"></i>{{ __('balance') }}: <span
                            class="user-balance">₫{{ number_format(Auth::user()->balance, 2) }}</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="row">
                <!-- Instruction Section -->
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('instruct_bank') }}</h3>
                        </div>
                        <div class="card-body">
                            <p>- Vui lòng nạp đúng theo nội dung đã hiện.<br>
                                - Khi đã chuyển khoản bạn hãy vui lòng đợi 1-&gt;5p để tiền được duyệt auto.<br>
                                - Nếu sai nội dung bạn sẽ phải ib admin để xử lý. Khi xử lý xong bạn sẽ bị trừ 10% phí nạp
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tabs for Payment Methods -->
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                                @foreach ($account as $item)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="pills-pay-tab_{{ $loop->index }}" data-bs-toggle="pill"
                                            href="#pills-pay_{{ $loop->index }}" role="tab"
                                            aria-controls="pills-pay_{{ $loop->index }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <img src="{{ $item->logo }}" width="18" style="margin-bottom: 3px"
                                                class="me-2">
                                        </a>
                                    </li>
                                @endforeach
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-other-tab" data-bs-toggle="pill" href="#pills-other"
                                        role="tab" aria-controls="pills-other" aria-selected="false">Other Method</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($account as $item)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="pills-pay_{{ $loop->index }}" role="tabpanel"
                                        aria-labelledby="pills-pay-tab_{{ $loop->index }}">
                                        <div class="box">
                                            <div class="text-center fw-bold">
                                                <div class="bank-info">
                                                    <span>Ngân hàng:</span>
                                                    <span class="text-danger">{{ strtoupper($item->type) }}</span>
                                                </div>
                                                <div class="bank-info">
                                                    <span>Số tài khoản:</span>
                                                    <span class="text-danger">{{ $item->account_number }}
                                                        <a href="javascript:void(0)"
                                                            onclick="copy('number_{{ $loop->index }}')" class="copy"
                                                            data-clipboard-text="{{ $item->account_number }}">
                                                            <i class="fas fa-copy"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="bank-info">
                                                    <span>Chủ tài khoản:</span>
                                                    <span class="text-danger">{{ $item->account_name }}</span>
                                                </div>
                                                <div class="bank-info">
                                                    <span>Nội dung chuyển:</span>
                                                    <span
                                                        class="text-danger">{{ DataSite('code_tranfer') }}{{ Auth::user()->id }}
                                                        <a href="javascript:void(0)" onclick="copy('content_codeRecharge');"
                                                            class="copy"
                                                            data-clipboard-text="{{ DataSite('code_tranfer') }}{{ Auth::user()->id }}">
                                                            <i class="fas fa-copy"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="bank-info">
                                                    <span>Mã QR:</span>
                                                    <div class="qr-container">
                                                        @if (strtolower($item->type) == 'momo')
                                                            <!-- URL QR Code cho Momo -->
                                                            <img id="methodLogo" class="img-fluid qr-image"
                                                                alt="Momo QR Code"
                                                                src="https://api.qrserver.com/v1/create-qr-code?size=200x200&cht=qr&data=2|99|{{ $item->account_number }}|||0|0|0|{{ DataSite('code_tranfer') }}{{ Auth::user()->id }}|transfer_myqr">
                                                        @else
                                                            <!-- URL QR Code cho các ngân hàng khác -->
                                                            <img id="methodLogo" class="img-fluid qr-image"
                                                                alt="VietQR Image"
                                                                src="https://api.vietqr.io/{{ strtolower($item->type) }}/{{ $item->account_number }}/0/{{ DataSite('code_tranfer') }}{{ Auth::user()->id }}/qronly2.jpg?accountName={{ urlencode($item->account_name) }}&amp;bankName={{ urlencode($item->type) }}&amp;promotion=0&amp;maxCharge=1000000000">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="tab-pane fade" id="pills-other" role="tabpanel"
                                    aria-labelledby="pills-other-tab">
                                    <div class="box">
                                        <div class="text-center">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <!-- Form Nhập Số Tiền -->
                                            <form method="POST" action="{{ route('transfer.process') }}"
                                                id="payment-form">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="payment_type" class="form-label">Chọn loại thanh
                                                        toán:</label>
                                                    <select name="payment_type" id="payment_type" class="form-control"
                                                        required>
                                                        <option value="" disabled selected>Chọn loại thanh toán
                                                        </option>
                                                        @foreach ($payments as $payment)
                                                            <option value="{{ $payment->type }}"
                                                                data-account-number="{{ $payment->account_number }}"
                                                                data-qr-code="{{ $payment->qr_code }}">
                                                                {{ strtoupper($payment->type) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Account number and QR Code container -->
                                                <div class="mb-3" id="account-info-container" style="display: none;">
                                                    <div class="card p-3">
                                                        <!-- Account number -->
                                                        <div class="mb-2">
                                                            <label for="account_number" class="form-label">Số tài
                                                                khoản:</label>
                                                            <div id="account_number" class="form-control-plaintext"></div>
                                                            <!-- Thay thế input bằng div -->
                                                        </div>

                                                        <!-- QR Code -->
                                                        <div class="mb-2 text-center">
                                                            <label for="qr_code" class="form-label">Mã QR:</label>
                                                            <img id="qr_code_image" src="" alt="QR Code"
                                                                style="max-width: 200px; display: block; margin: 0 auto;">
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Amount container -->
                                                <div class="mb-3" id="amount-container">
                                                    <label for="amount" class="form-label">Số tiền:</label>
                                                    <input type="number" id="amount" name="amount" step="0.01"
                                                        min="0" class="form-control" required>
                                                </div>

                                                <!-- Submit button -->
                                                <button type="submit" class="btn btn-primary" id="submit-button">Xác
                                                    nhận thanh toán</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction History Section -->
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử nạp tiền</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive df-example demo-table">
                                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row dt-row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-striped datatable text-nowrap dataTable no-footer"
                                                id="testds" aria-describedby="datatable_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_desc" tabindex="0"
                                                            aria-controls="datatable" rowspan="1" colspan="1"
                                                            aria-sort="descending"
                                                            aria-label="#: activate to sort column ascending"
                                                            style="width: 45.425px;">#</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Cổng thanh toán: activate to sort column ascending"
                                                            style="width: 144.062px;">Cổng thanh toán</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Mã giao dịch: activate to sort column ascending"
                                                            style="width: 112.537px;">Mã giao dịch</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Thực nhận: activate to sort column ascending"
                                                            style="width: 165.85px;">Thực nhận</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Nội dung: activate to sort column ascending"
                                                            style="width: 146.65px;">Nội dung</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Thời gian: activate to sort column ascending"
                                                            style="width: 136.425px;">Thời gian</th>
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
        document.addEventListener('DOMContentLoaded', function() {
            const paymentTypeSelect = document.getElementById('payment_type');
            const accountInfoContainer = document.getElementById('account-info-container');
            const accountNumberDisplay = document.getElementById('account_number'); // Thay đổi từ input sang div
            const qrCodeImage = document.getElementById('qr_code_image');
            const amountContainer = document.getElementById('amount-container');
            const submitButton = document.getElementById('submit-button');

            paymentTypeSelect.addEventListener('change', function() {
                const selectedOption = paymentTypeSelect.options[paymentTypeSelect.selectedIndex];
                const accountNumber = selectedOption.getAttribute('data-account-number');
                const qrCode = selectedOption.getAttribute('data-qr-code');

                if (paymentTypeSelect.value.toLowerCase() === 'binance') {
                    // Hiển thị account_number và QR code khi chọn binance
                    accountNumberDisplay.textContent = accountNumber; // Thay đổi nội dung của div
                    qrCodeImage.src = qrCode;
                    accountInfoContainer.style.display = 'block';

                    // Ẩn các trường input khác và nút submit
                    amountContainer.style.display = 'none';
                    submitButton.style.display = 'none';
                } else {
                    // Ẩn account_number và QR code nếu chọn loại khác
                    accountInfoContainer.style.display = 'none';

                    // Hiển thị lại các trường input khác và nút submit
                    amountContainer.style.display = 'block';
                    submitButton.style.display = 'block';
                }
            });
        });
    </script>
@endsection
