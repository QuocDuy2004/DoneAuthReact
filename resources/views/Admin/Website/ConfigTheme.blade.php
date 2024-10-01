@extends('Admin.Layout.App')

@section('title', 'Cấu hình logo')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <h1 class="page-title fw-semibold fs-18 mb-0">Cài đặt logo</h1>
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
                            <h5 class="card-title mb-0">Cài đặt logo</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.website.theme.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Logo -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input type="text" class="form-control" value="{{ DataSite('logo') }}"
                                                id="logo" name="logo">
                                        </div>
                                    </div>

                                    <!-- Favicon (Large) -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="favicon" class="form-label">Favicon (Large)</label>
                                            <input type="text" class="form-control" value="{{ DataSite('favicon') }}"
                                                id="favicon" name="favicon">
                                        </div>
                                    </div>

                                    <!-- Favicon (Small) -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="logo_mini" class="form-label">Favicon (Small)</label>
                                            <input type="text" class="form-control" value="{{ DataSite('logo_mini') }}"
                                                id="logo_mini" name="logo_mini">
                                        </div>
                                    </div>

                                    <!-- Image SEO -->
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="image_seo" class="form-label">Image SEO</label>
                                            <input type="text" class="form-control" value="{{ DataSite('image_seo') }}"
                                                id="image_seo" name="image_seo">
                                        </div>
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
