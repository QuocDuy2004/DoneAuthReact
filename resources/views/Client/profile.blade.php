@extends('Layout.App')
@section('title', 'Thông tin cá nhân')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">

                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fe fe-plus mx-1 align-middle"></i>Số dư: <span
                            class="user-balance">{{ number_format(Auth::user()->balance) }} ₫</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">{{ level(Auth::user()->level, false) }}
                                    </h2>
                                    <p class="text-white mb-0 text-fixed-white">Cấp bậc hiện tại</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-ranking-star text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">{{ number_format(Auth::user()->balance) }}
                                        ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Số dư hiện tại</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-wallet text-fixed-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">
                                        {{ number_format(Auth::user()->total_recharge) }} ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Số tiền đã nạp</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-dollar-sign text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">
                                        {{ number_format(Auth::user()->total_deduct) }} ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Tổng tiền đã tiêu</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-database text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
            </div>
            <section class="space-y-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card custom-card" id="myTabContent">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin tài khoản</h3>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#link_telegramModal">
                                Cấu hình telegram
                            </button>
                            </div>
                            <div class="card-body">
                                <form id="updateProfileForm" class="space-y-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="username" class="form-label">Họ và tên</label>
                                            <input id="username" name="username" type="text" class="form-control"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="username" class="form-label">Tên Đăng Nhập</label>
                                            <input id="username" name="username" type="text" class="form-control"
                                                value="{{ Auth::user()->username }}" disabled="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Địa chỉ e-mail</label>
                                            <input id="email" name="email" type="text" class="form-control"
                                                value="{{ Auth::user()->email }}" disabled="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lang" class="form-label">Ngôn ngữ</label>
                                            <select name="lang" id="lang" class="form-select">
                                                <option value="{{ Auth::user()->lang }}">{{ Auth::user()->lang }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="created_at" class="form-label">Ngày Đăng Ký</label>
                                            <input id="created_at" name="created_at" type="text" class="form-control"
                                                value="{{ Auth::user()->created_at }}" disabled="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="updated_at" class="form-label">Ngày Cập Nhật</label>
                                            <input id="updated_at" name="updated_at" type="text" class="form-control"
                                                value="{{ Auth::user()->updated_at }}" disabled="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="mb-2">
                                            <div class="alert alert-danger">
                                                Access Token *: <span
                                                    id="access_token">{{ Auth::user()->api_token }}</span>
                                                <span class="copy text-dark" data-clipboard-target="#access_token">
                                                    <i class="fas fa-copy"></i>
                                                </span>
                                                |
                                                <a class="text-success" id="btnReload"><i class="fas fa-refresh"></i> Đổi
                                                    token</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card custom-card">
                            <div class="card-header">
                                <h3 class="card-title">Thay đổi mật khẩu</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update-profile', 'change-password') }}" method="POST"
                                    request="duymedia">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Mật Khẩu Cũ</label>
                                        <input type="password" class="form-control  py-2" id="old_password"
                                            name="old_password" placeholder="Nhập mật khẩu cũ" required="">

                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Mật Khẩu Mới</label>
                                        <input type="password" class="form-control  py-2" id="new_password"
                                            name="new_password" placeholder="Nhập mật khẩu mới" required="">

                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                                        <input type="password" class="form-control  py-2" id="confirm_password"
                                            name="confirm_password" placeholder="Nhập lại mật khẩu mới" required="">
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-sm btn-primary w-full">Đổi Mật Khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="link_telegramModal" tabindex="-1" aria-labelledby="telegramModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="telegramModalLabel">Cấu hình Telegram</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form đầu tiên -->
                                    <form action="{{ route('update-profile', 'update-telegram') }}" method="POST"
                                        request="duymedia">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="telegramId" class="form-label">Telegram ID:</label>
                                            <input class="form-control" type="text" name="telegram_id"
                                                id="telegramId" value="{{ Auth::user()->telegram_chat_id }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="botLink" class="form-label">Link Join Bot:</label>
                                            <input class="form-control" type="text" id="botLink"
                                                value="{{ DataSite('telegram_bot') }}" onclick="openNewTab()" readonly>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary w-100">Lưu ngay</button>
                                        </div>
                                    </form>

                                    <!-- Form thứ hai -->
                                    <form action="{{ route('update-profile', 'update-telegram') }}" method="POST"
                                        request="duymedia">
                                        @csrf
                                        <div class="form-group mb-3 row">
                                            <label for="" class="form-label col-md-3">Trạng thái Telegram</label>
                                            <div class="col-md-9">
                                                @if (Auth::user()->telegram_verified == 'yes')
                                                    <span>
                                                        <i class="fa fa-check-square text-success fs-5"></i> Đã liên kết
                                                    </span>
                                                    <div class="mt-3">
                                                        <b class="text-primary">Nhận thông báo từ telegram</b>
                                                        <div class="form-check">
                                                            @php
                                                                if (Auth::user()->telegram_notice == 'on') {
                                                                    $checked = 'checked';
                                                                } else {
                                                                    $checked = '';
                                                                }
                                                            @endphp
                                                            <input type="checkbox" class="form-check-input"
                                                                name="isNotice" {{ $checked }} id="notice-tele">
                                                            <label class="form-check-label" for="notice-tele">Nhận thông
                                                                báo</label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span>
                                                        <i class="ti ti-x bg-danger rounded text-white fs-5"></i> Chưa liên
                                                        kết
                                                        <b class="text-primary">(Liên kết telegram nhận ngay
                                                            {{ number_format(DataSite('balance_telegram')) }} vnđ)</b>
                                                        <p>Nhấn vào <a class="text-info"
                                                                href="{{ DataSite('telegram_bot') }}"
                                                                target="_blank">Đây</a> để liên kết</p>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary col-12">
                                                <i class="ti ti-lock me-2 fs-4"></i> Lưu dữ liệu
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <h3 class="card-title">Lịch sử hoạt động</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="datatable-custom1_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row dt-row">
                                            <div class="col-sm-12">
                                                <table id="datatable-custom1"
                                                    class="table table-bordered text-nowrap dataTable no-footer"
                                                    style="width: 100%;" aria-describedby="datatable-custom1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_desc" tabindex="0"
                                                                aria-controls="datatable-custom1" rowspan="1"
                                                                colspan="1" aria-sort="descending"
                                                                aria-label="#: activate to sort column ascending"
                                                                style="width: 32.4px;">#</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable-custom1" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Địa chỉ IP: activate to sort column ascending"
                                                                style="width: 169.2px;">Địa chỉ IP</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable-custom1" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Nội dung: activate to sort column ascending"
                                                                style="width: 375.2px;">Nội dung</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="datatable-custom1" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Ngày hoạt động: activate to sort column ascending"
                                                                style="width: 137.2px;">Ngày hoạt động</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($history_login as $his)
                                                            <tr class="odd">
                                                                <td class="sorting_1">{{ $his->id }}</td>
                                                                <td>{{ $his->ip }}</td>
                                                                <td>{{ $his->dangnhap }}</td>
                                                                <td>{{ $his->created_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@section('script')
    <script>
        $('#btnReload').click(function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Bạn có muốn thay đổi Access Token của mình không?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý !',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng chọn "Đúng, thay đổi", thực hiện AJAX để đổi token
                    $.ajax({
                        url: "{{ route('user.action', 'change-token') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#btnReload').html(
                                '<i class="fa fa-spinner fa-spin"></i> Đang xử lý..').prop(
                                'disabled', true);
                        },
                        complete: function() {
                            $('#btnReload').html('<i class="fas fa-refresh"></i> Đổi token')
                                .prop('disabled', false);
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                $('#access_token').text(data.api_token);
                                Swal.fire({
                                    title: 'Cập nhật thành công!',
                                    text: 'Access Token của bạn đã được thay đổi.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Thất bại!',
                                    text: 'Không thể thay đổi Access Token. Vui lòng thử lại.',
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
                }
            });
        });
    </script>
@endsection
