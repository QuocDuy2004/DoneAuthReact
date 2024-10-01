@extends('Admin.Layout.App')

@section('title', 'Cấu hình API Key')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: API KEY</h1>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">Cấu hình API V1</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.website.auto.update') }}" method="POST">
                                @csrf
                                @foreach ($apiV1 as $key => $value)
                                    <div class="mb-3">
                                        <label for="{{ $key }}" class="form-label">
                                            {{ str_replace('_', ' ', ucfirst($key)) }}
                                        </label>
                                        <input type="text" class="form-control" id="{{ $key }}"
                                            name="apiV1[{{ $key }}]" value="{{ $value }}"
                                            placeholder="Nhập Key website vào">
                                    </div>
                                @endforeach
                                <div class="mb-3">
                                    <small>* Thêm Key từ nguồn mà bạn muốn lấy dịch vụ</small>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="mt-2 btn btn-primary" type="submit">Cập nhật ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">Cấu hình API V2</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.website.auto.update') }}" method="POST">
                                @csrf
                                @foreach ($apiV2 as $key => $value)
                                    <div class="mb-3">
                                        <label for="{{ $key }}" class="form-label">
                                            {{ str_replace(['_', 'Controller'], [' ', ''], ucfirst($key)) }}
                                        </label>
                                        <input type="text" class="form-control" id="{{ $key }}"
                                            name="apiV2[{{ $key }}]" value="{{ $value }}"
                                            placeholder="Nhập Key website vào">
                                    </div>
                                @endforeach
                                <div class="mb-3">
                                    <small>* Thêm Key từ nguồn mà bạn muốn lấy dịch vụ</small>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="mt-2 btn btn-primary" type="submit">Cập nhật ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: Content -->
        </div>
    </div>
@endsection
