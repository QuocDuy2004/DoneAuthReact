@extends('Admin.Layout.App')

@section('title', 'Cài đặt hiệu ứng')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <h1 class="page-title fw-semibold fs-18 mb-0">Cài đặt hiệu ứng</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Optional actions or buttons -->
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="row">
                <!-- Effect Configuration Card -->
                <div class="col-md-12">
                    <div class="card shadow-sm border-light">
                        <div class="card-body">
                            <form id="effectForm" action="{{ route('admin.website.effect.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Effect Selection -->
                                    <div class="col-md-12">
                                        <label for="effect" class="form-label">Chọn Hiệu ứng</label>
                                        <div class="d-flex justify-content-around">
                                            <!-- Effect 1 -->
                                            <div class="text-center">
                                                <label>
                                                    <input type="radio" name="effect" value="1">
                                                    <img src="{{ asset('/assets/images/effect/noen.png') }}" alt="noen"
                                                        class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                                </label>
                                                <p>Hiệu ứng tuyết rơi nonen</p>
                                            </div>

                                            <!-- Effect 2 -->
                                            <div class="text-center">
                                                <label>
                                                    <input type="radio" name="effect" value="2">
                                                    <img src="{{ asset('/assets/images/effect/tet.png') }}" alt="tết"
                                                        class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                                </label>
                                                <p>Trang trí ngày tết</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                    <form action="{{ route('admin.website.effect.post') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action_type" value="update">
                                        <button class="btn btn-danger" type="submit" name="effect" value="0">Khôi
                                            phục mặc định</button>
                                        <!-- Include any other controls you need here -->
                                    </form>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Effect Configuration Card End -->
            </div>
            <!-- Start:: Content Close -->
        </div>
    </div>

@endsection
