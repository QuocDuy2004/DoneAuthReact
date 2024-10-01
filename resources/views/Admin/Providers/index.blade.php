@extends('Admin.Layout.App')

@section('title', 'Danh Sách Nhà Cung Cấp')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Provider: API Manager</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary"><i
                        class="fas fa-plus"></i> Thêm mới</button>
            </div>
           
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        @foreach ($providers as $provider)
                            <div class="modal fade" id="modal-update-{{ $provider->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $provider->id }}">Cập nhật thông tin
                                                #{{ $provider->id }}</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-none" id="error-alert-{{ $provider->id }}">
                                            </div>
                                            <div class="alert alert-success d-none" id="success-alert-{{ $provider->id }}">
                                            </div>

                                            <form id="update-provider-form-{{ $provider->id }}"
                                                action="{{ route('providers.update', $provider->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Tên</label>
                                                    <input class="form-control bg-light" type="text" name="username"
                                                        value="{{ $provider->username }}" placeholder="SMMKAY.COM" readonly>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="url" class="form-label">URL</label>
                                                    <input class="form-control bg-light" type="url" name="url"
                                                        value="{{ $provider->url }}"
                                                        placeholder="https://smmkay.com/api/v2" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="key" class="form-label">Key</label>
                                                    <input class="form-control" type="text" name="key"
                                                        value="{{ $provider->key }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sync" class="form-label">Đồng bộ</label>
                                                    <select class="form-control" name="sync">
                                                        <option value="1"
                                                            {{ $provider->sync == 1 ? 'selected' : '' }}>Bật</option>
                                                        <option value="0"
                                                            {{ $provider->sync == 0 ? 'selected' : '' }}>Tắt</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Trạng thái</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1"
                                                            {{ $provider->status == 1 ? 'selected' : '' }}>Hoạt động
                                                        </option>
                                                        <option value="0"
                                                            {{ $provider->status == 0 ? 'selected' : '' }}>Không hoạt động
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                                </div>
                                            </form>
                                            <div class="spinner-border d-none" id="loading-{{ $provider->id }}"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div id="basic-1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table
                                        class="display table table-bordered table-stripped text-nowrap datatable dataTable no-footer"
                                        id="basic-1" aria-describedby="basic-1_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1" aria-sort="descending"
                                                    aria-label="#: activate to sort column ascending"
                                                    style="width: 7.9375px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Đường dẫn: activate to sort column ascending"
                                                    style="width: 44.3875px;">Đường dẫn</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tên: activate to sort column ascending"
                                                    style="width: 60.3375px;">API Key</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tên: activate to sort column ascending"
                                                    style="width: 60.3375px;">Tên</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tiền: activate to sort column ascending"
                                                    style="width: 35.9125px;">Tiền</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Định dạng: activate to sort column ascending"
                                                    style="width: 56.5375px;">Định dạng</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Đồng bộ: activate to sort column ascending"
                                                    style="width: 78.225px;">Đồng bộ</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Trạng thái" style="width: 61.8625px;">Trạng thái</th>
                                                    <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Trạng thái" style="width: 61.8625px;">Tên File</th>
                                                <th data-sortable="false" width="370" class="sorting_disabled"
                                                    rowspan="1" colspan="1" aria-label="Thao tác"
                                                    style="width: 337.163px;">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($providers as $provider)
                                            <tr class="odd text-center">
                                                <td class="sorting_1">{{ $provider->id }}</td>
                                                <td>{{ $provider->url }}</td>
                                                <td>{{ $provider->key }}</td>
                                                <td>{{ $provider->username }}</td>
                                                <td>{{ $provider->balance }}</td>
                                                <td>{{ $provider->currency }}</td>
                                                <td>{{ $provider->sync ? 'On' : 'Off' }}</td>
                                                <td class="text-center">
                                                    @if ($provider->status) <!-- Thay đổi điều kiện nếu cần -->
                                                        <span class="badge bg-success">Hoạt động</span>
                                                    @else
                                                        <span class="badge bg-danger">Đã đóng</span>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $provider->file_name ?? 'N/A' }}</td> <!-- Hiển thị tên file -->
                                                <td>
                                                    <!-- Edit Button -->
                                                    <a href="#modal-update-{{ $provider->id }}" data-bs-toggle="modal" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-edit me-1"></i> Sửa
                                                    </a>
                                        
                                                    <!-- Price Update Form -->
                                                    <form action="/admin/providers/price-update?id={{ $provider->id }}" method="POST" class="d-inline axios-form" data-confirm="1" data-reload="1">
                                                        @csrf
                                                        <button class="btn btn-outline-warning btn-sm" type="submit">
                                                            <i class="fas fa-dollar-sign me-1"></i> Đồng bộ giá
                                                        </button>
                                                    </form>
                                        
                                                    <!-- Balance Update Form -->
                                                    <form action="{{ route('providers.updateBalance', $provider->id) }}" method="POST" class="d-inline" data-confirm="1" data-reload="1">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-outline-danger btn-sm delete-server-btn"> <i class="fas fa-wallet me-1"></i> Cập nhật số dư</button>
                                                    </form>
                                        
                                                    <!-- Delete Form -->
                                                    <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" class="d-inline" data-confirm="1" data-reload="1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm delete-server-btn" data-server-id="{{ $provider->id }}">
                                                            <i class="fas fa-trash me-1"></i> Xoá
                                                        </button>
                                                    </form>
                                                </td>
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

            <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin mới</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                Lưu ý: Mã nguồn này hỗ trợ hầu hết tất cả các Nhà cung cấp API (API v2) như: app.x999.vn,
                                v.v. Vì vậy, mã nguồn này không hỗ trợ nhà cung cấp API khác có các Thông số API khác nhau
                            </div>
                            @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                            <!-- Form to fetch and save provider data -->
                            <form action="{{ route('provider.fetch') }}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Tên</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ old('name') }}" required="">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input class="form-control" type="text" id="url" name="url"
                                        value="{{ old('url') }}" placeholder="https://smmkay.com/api/v2"
                                        required="">
                                </div>
                                <div class="mb-3">
                                    <label for="key" class="form-label">API Key</label>
                                    <input class="form-control" type="text" id="key" name="key"
                                        value="{{ old('key') }}" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username"
                                        value="{{ old('username') }}" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        required="">
                                </div>
                                <div class="mb-3">
                                    <label for="sync" class="form-label">Đồng bộ</label>
                                    <select class="form-control" id="sync" name="sync">
                                        <option value="1" {{ old('sync') == '1' ? 'selected' : '' }}>Hoạt động
                                        </option>
                                        <option value="0" {{ old('sync') == '0' ? 'selected' : '' }}>Không hoạt động
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hoạt động
                                        </option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không hoạt
                                            động</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
