@extends('Admin.Layout.App')

@section('title', 'Chỉnh giá máy chủ')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Chỉnh giá máy chủ</h1>
                <div class="ms-md-1 ms-0">
                    <!-- Optional button or other content here -->
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
            </div>

            @foreach ($social as $serversocial)
                <div class="card custom-card mb-3">
                    <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                        <div class="ribbon-label text-uppercase fw-bold bg-default">
                            Chỉnh sửa giá {{ $serversocial->name }}
                            <span class="ribbon-inner bg-default"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($service as $servic1e)
                            @if ($servic1e->service_social == $serversocial->slug)
                                <h4 class="text-uppercase fw-bold badge badge-danger">{{ $servic1e->name }}</h4>
                                @foreach ($server as $serverItem)
                                    @if ($serverItem->service_id == $servic1e->id)
                                        @if ($serverItem->title != '')
                                            <form action="{{ route('admin.server.price.post') }}" method="POST"
                                                class="mb-3">
                                                @csrf
                                                <input type="hidden" name="servers[{{ $loop->index }}][id]"
                                                    value="{{ $serverItem->id }}">

                                                <div class="row mb-4">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="server_id" class="form-label">ID máy chủ</label>
                                                        <input type="text" id="server_id" class="form-control"
                                                            name="id" value="{{ $serverItem->id }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="server_service" class="form-label">Máy chủ</label>
                                                        <input type="text" class="form-control"
                                                            name="servers[{{ $loop->index }}][title]"
                                                            value="{{ $serverItem->title }}" placeholder="Namedfd" disabled>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label for="server_title" class="form-label">Tên máy chủ</label>
                                                        <input type="text" id="server_title" class="form-control"
                                                            name="servers[{{ $loop->index }}][title]"
                                                            value="{{ $serverItem->title }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="price_member" class="form-label">Giá thành viên</label>
                                                        <input type="text" id="price_member" class="form-control"
                                                            name="servers[{{ $loop->index }}][price]"
                                                            value="{{ $serverItem->price }}">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="price_collaborator" class="form-label">Giá công tác
                                                            viên</label>
                                                        <input type="text" id="price_collaborator" class="form-control"
                                                            name="servers[{{ $loop->index }}][price_collaborator]"
                                                            value="{{ $serverItem->price_collaborator }}">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="price_agency" class="form-label">Giá đại lý</label>
                                                        <input type="text" id="price_agency" class="form-control"
                                                            name="servers[{{ $loop->index }}][price_agency]"
                                                            value="{{ $serverItem->price_agency }}">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="price_distributor" class="form-label">Giá nhà phân
                                                            phối</label>
                                                        <input type="text" id="price_distributor" class="form-control"
                                                            name="servers[{{ $loop->index }}][price_distributor]"
                                                            value="{{ $serverItem->price_distributor }}">
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="server_status" class="form-label">Trạng thái</label>
                                                    <select id="server_status" class="form-select"
                                                        name="servers[{{ $loop->index }}][status]">
                                                        <option value="Active"
                                                            @if ($serverItem->status == 'Active') selected @endif>Hoạt động
                                                        </option>
                                                        <option value="InActive"
                                                            @if ($serverItem->status == 'InActive') selected @endif>Không hoạt
                                                            động</option>
                                                    </select>
                                                </div>

                                                @unless ($loop->last)
                                                    <hr style="border-top: 2px solid #ff0000;">
                                                @endunless

                                                <button type="submit" class="btn btn-primary col-12">Chỉnh giá máy chủ -
                                                    [{{ $serverItem->id }}]</button>
                                            </form>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
