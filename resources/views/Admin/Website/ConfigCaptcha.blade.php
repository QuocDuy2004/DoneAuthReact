@extends('Admin.Layout.App')

@section('title', 'Cấu hình Captcha') 

@section('content')

<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Cấu hình Captcha</h1>
        </div>

        <!-- Alert Section -->
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> 
            Hướng dẫn lấy API Key và Secret Key Google để cấu hình Captcha 
            <a href="#" class="alert-link ms-2" data-bs-toggle="modal" data-bs-target="#guideModal"><span class="text-primary">Xem ngay</span></a>
        </div>
        <div class="modal fade" id="guideModal" tabindex="-1" aria-labelledby="guideModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="guideModalLabel">Hướng dẫn lấy API Key và Secret Key Google</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Để lấy API Key và Secret Key Google, bạn cần làm theo các bước sau:</p>
                        <ol>
                            <li>Truy cập vào <a href="https://console.developers.google.com/" target="_blank">Google Developers Console</a>.</li>
                            <li>Tạo một dự án mới hoặc chọn dự án hiện có.</li>
                            <li>Đi đến phần "Credentials" và tạo API Key và Secret Key.</li>
                            <li>Sao chép API Key và Secret Key vào cấu hình Captcha của bạn.</li>
                        </ol>
                        
                        <!-- Thêm ảnh -->
                        <div class="mt-3">
                            <img src="https://i.imgur.com/GNybZKT.jpeg" class="img-fluid mb-2 zoomable" alt="">
                            <img src="https://i.imgur.com/fUbwBvv.jpeg" class="img-fluid mb-2 zoomable" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div><style>
            .zoomable {
                cursor: pointer;
                transition: transform 0.3s ease, width 0.3s ease, height 0.3s ease;
            }
        
            .zoomed {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                object-fit: contain;
                transform: none;
                z-index: 1055; /* Ensure it appears on top of everything */
            }
        
            .modal-body {
                overflow: hidden;
            }
        </style>
        
        <!-- JavaScript to handle full-screen zoom on click -->
        <script>
            document.querySelectorAll('.zoomable').forEach(function(img) {
                img.addEventListener('click', function() {
                    if (this.classList.contains('zoomed')) {
                        this.classList.remove('zoomed');
                    } else {
                        document.querySelectorAll('.zoomable').forEach(function(zoomedImg) {
                            zoomedImg.classList.remove('zoomed');
                        });
                        this.classList.add('zoomed');
                    }
                });
            });
        </script>        
        <!-- Captcha Configuration Card -->
        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Cấu hình Captcha</h5>
                <form action="{{ route('admin.website.captcha.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="site_key" class="form-label">API Key</label>
                        <input class="form-control" type="text" id="site_key" name="site_key" value="{{ DataSite('site_key') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="secret_key" class="form-label">Secret Key</label>
                        <input class="form-control" type="text" id="secret_key" name="secret_key" value="{{ DataSite('secret_key') }}" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                </form>
            </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="modal-update-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin #1</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.website.captcha.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="site_key" class="form-label">API Key</label>
                                <input class="form-control" type="text" id="site_key" name="site_key" value="{{ DataSite('site_key') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="secret_key" class="form-label">Secret Key</label>
                                <input class="form-control" type="text" id="secret_key" name="secret_key" value="{{ DataSite('secret_key') }}" required>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
