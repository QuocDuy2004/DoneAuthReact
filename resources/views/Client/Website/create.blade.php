@extends('Layout.App')
@section('title', 'Tạo website riêng')
@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="col-md-12 mx-auto">
                <div class="alert alert-warning" role="alert">
                    - Bạn phải đạt cấp bậc cộng tác viên hoặc đại lý mới có thể tạo web con! <br>
                    - Nghiêm cấm các tên miền có chữ: Facebook, Instagram để tránh bị vi phạm bản quyền. <br>
                    - Khách hàng tạo tài khoản và sử dụng dịch vụ ở site con. Tiền sẽ trừ vào tài khoản của đại lý ở site
                    chính. Vì thế để khách hàng mua được tài khoản đại lý phải còn số dư. <br>
                    - Chúng tôi hỗ trợ mục đích kinh doanh của tất cả cộng tác viên và đại lý!
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Tạo website riêng</h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Empty Column (if needed) -->
                            </div>
                            <!-- API Token Section -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="api_token" class="form-label">API Token</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" value="{{ Auth::user()->api_token }}"
                                            id="api_token" readonly>
                                        <button type="button" id="btnReload" class="btn btn-primary">
                                            <i class="fa fa-sync"></i> Thay đổi
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Domain Input Form -->
                            <div class="col-md-12">
                                <form action="{{ route('create.website.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->api_token }}" name="api_token">
                                    <div class="form-group mb-3">
                                        <label for="domain" class="form-label">Tên miền</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="domain" name="domain"
                                                placeholder="Tên miền" value="{{ $sitecon->domain_name }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Lưu Miền Ngay
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 mx-auto">
                                <div class="alert alert-success " role="alert">
                                    <p class="fw-bold">Hướng dẫn tạo website:</p>
                                    <p><span class="fw-bold">- Bước 1 :</span> <span>Bạn cần phải có tên miền, nếu chưa bạn có
                                            thể mua tên miền tại <a href="http://tenten.vn" target="_blank"
                                                rel="noopener noreferrer" class="">tenten.vn</a> (đọc lưu ý trước khi
                                            mua).</span></p>
                                    <p><span class="fw-bold">- Bước 2 :</span> <span>Trỏ Nameserver1: <b
                                                class="text-info">{{ env('NAME_SERVER1') }}</b></span></p>
                                    <p><span class="fw-bold">- Bước 3 :</span> <span>Trỏ Nameserver2: <b
                                                class="text-info">{{ env('NAME_SERVER2') }}</b></span></p>
                                    <p><span class="fw-bold">- Bước 4 :</span> <span>Sau khi đã trỏ Nameserver bạn hãy liên hệ
                                            zalo: <b class="text-white"><a href="{{ DataSite('zalo') }}" target="_blank"
                                                    rel="noopener noreferrer" class="">{{ DataSite('zalo') }}</a></b>
                                            để hỗ trợ kích hoạt.</span></p>
                                    <p><span class="fw-bold">- Bước 5 :</span> Truy cập vào trang của bạn và nhập api token (lưu
                                        ý trước lúc kích hoạt api token không được để lộ tên miền tránh bị kích hoạt tài khoản
                                        admin).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@section('script')
    <script>
        $('#btnReload').click(function() {
            $.ajax({
                url: "{{ route('user.action', 'change-token') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnReload').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý..').prop(
                        'disabled', true);
                },
                complete: function() {
                    $('#btnReload').html('<i class="fa fa-sync"></i> Thay đổi').prop('disabled', false);
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('#api_token').val(data.api_token);
                        Swal.fire({
                            title: 'Thay đổi thành công!',
                            text: 'API Token đã được cập nhật.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Thay đổi thất bại!',
                            text: 'Không thể cập nhật API Token. Vui lòng thử lại.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
