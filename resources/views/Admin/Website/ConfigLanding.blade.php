@extends('Admin.Layout.App')

@section('title', 'Cấu hình landing')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <h1 class="page-title fw-semibold fs-18 mb-0">Cài đặt landing</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Optional actions or buttons -->
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="row">
                <!-- General Settings Card -->
                <div class="col-md-12">
                    <div class="card shadow-sm border-light">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Cài đặt landing</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update.landing.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Option 1: Landing 1 -->
                                    <div class="col-md-4 text-center">
                                        <label>
                                            <input type="radio" name="landing_page" value="1" {{ $siteData->landing == '1' ? 'checked' : '' }}>
                                            <img src="{{ asset('/assets/images/landing/landing_1.png') }}" alt="Landing 1" class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                        </label>
                                        <p>Landing 1</p>
                                    </div>

                                    <!-- Option 2: Landing 2 -->
                                    <div class="col-md-4 text-center">
                                        <label>
                                            <input type="radio" name="landing_page" value="2" {{ $siteData->landing == '2' ? 'checked' : '' }}>
                                            <img src="{{ asset('/assets/images/landing/landing_2.png') }}" alt="Landing 2" class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                        </label>
                                        <p>Landing 2</p>
                                    </div>

                                        <!-- Option 3: Landing 3 -->
                                    <div class="col-md-4 text-center">
                                        <label>
                                            <input type="radio" name="landing_page" value="3" {{ $siteData->landing == '3' ? 'checked' : '' }}>
                                            <img src="{{ asset('/assets/images/landing/landing_3.png') }}" alt="Landing 3" class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                        </label>
                                        <p>Landing 3</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label>
                                            <input type="radio" name="landing_page" value="4" {{ $siteData->landing == '4' ? 'checked' : '' }}>
                                            <img src="{{ asset('/assets/images/landing/landing_4.png') }}" alt="Landing 4" class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                        </label>
                                        <p>Landing 4</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <label>
                                            <input type="radio" name="landing_page" value="5" {{ $siteData->landing == '5' ? 'checked' : '' }}>
                                            <img src="{{ asset('/assets/images/landing/landing_5.png') }}" alt="Landing 5" class="img-thumbnail" style="width: 100%; max-width: 300px;">
                                        </label>
                                        <p>Landing 5</p>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- General Settings Card End -->
            </div>
            <!-- Start:: Content Close -->
        </div>
    </div>
@endsection
