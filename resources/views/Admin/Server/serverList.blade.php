@extends('Admin.Layout.App')

@section('title', 'Danh sách máy chủ dịch vụ')

@section('content')
    <style>
        @keyframes sparkle {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 100% 100%;
            }
        }

        .sparkle-text {
            font-size: 24px;
            /* Kích thước font */
            font-weight: bold;
            /* Độ đậm font */
            color: #fff;
            /* Màu văn bản */
            background: linear-gradient(45deg,
                    #ff0000,
                    /* Đỏ */
                    #ff7f00,
                    /* Cam */
                    #ffff00,
                    /* Vàng */
                    #7fff00,
                    /* Xanh lá */
                    #00ff00,
                    /* Lục */
                    #00ff7f,
                    /* Xanh ngọc */
                    #00ffff,
                    /* Xanh dương nhạt */
                    #007fff,
                    /* Xanh dương */
                    #7f00ff,
                    /* Tím */
                    #ff00ff
                    /* Hồng */
                );
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: sparkle 3s linear infinite;
            background-size: 400% 400%;
            /* Tăng kích thước gradient để hiệu ứng trơn tru hơn */
        }
    </style>
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Danh sách máy chủ dịch vụ</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Start:: Content -->
            <div class="col-12">

                <div class="d-flex justify-content-end mb-3 gap-2">
                    <a href="{{ route('admin.server.auto') }}" class="btn btn-outline-success me-2"><i class="fas fa-list"></i>
                        Nhập dịch vụ</a>
                    <bautton data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i> Thêm mới
                    </bautton>
                    <button data-bs-toggle="modal" data-bs-target="#modal-notes" class="btn btn-outline-info">
                        <i class="fas fa-plus"></i> Thông báo cho telegram
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-warning" class="btn btn-outline-warning">
                        <i class="fas fa-plus"></i> Chỉnh giá auto theo %
                    </button>
                    <button id="delete-selected" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash"></i> Xóa đã chọn
                    </button>
                </div>
            </div>
            @if (session('success'))
                <script>
                    toastr.success("{{ session('success') }}");
                </script>
            @endif

            @if (session('error'))
                <script>
                    toastr.error("{{ session('error') }}");
                </script>
            @endif
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        @foreach ($servers as $server)
                            <div class="modal fade" id="modal-update-{{ $server->id }}" tabindex="-1"
                                aria-labelledby="modalLabel-{{ $server->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- Tăng kích thước modal -->
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-light">
                                            <h5 class="modal-title" id="modalLabel-{{ $server->id }}">Cập nhật dịch vụ
                                                #{{ $server->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.server.edit.post', $server->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="name_{{ $server->id }}" class="form-label">Tên máy
                                                            chủ</label>
                                                        <input type="text" class="form-control"
                                                            id="name_{{ $server->id }}" name="name"
                                                            value="{{ $server->name }}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="server_service_{{ $server->id }}"
                                                            class="form-label">Máy chủ</label>
                                                        <select id="server_service_{{ $server->id }}"
                                                            name="server_service" class="form-select">
                                                            <option value="{{ $server->server }}">{{ $server->server }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="actual_price_{{ $server->id }}" class="form-label">Giá gốc</label>
                                                        <input type="text" class="form-control"
                                                            id="actual_price_{{ $server->id }}" name="actual_price"
                                                            value="{{ $server->actual_price }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price_{{ $server->id }}" class="form-label">Giá thành
                                                            viên</label>
                                                        <input type="text" class="form-control"
                                                            id="price_{{ $server->id }}" name="price"
                                                            value="{{ $server->price }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price_collaborator_{{ $server->id }}"
                                                            class="form-label">Giá cộng tác viên</label>
                                                        <input type="text" class="form-control"
                                                            id="price_collaborator_{{ $server->id }}"
                                                            name="price_collaborator"
                                                            value="{{ $server->price_collaborator }}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="price_agency_{{ $server->id }}"
                                                            class="form-label">Giá đại lý</label>
                                                        <input type="text" class="form-control"
                                                            id="price_agency_{{ $server->id }}" name="price_agency"
                                                            value="{{ $server->price_agency }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price_distributor_{{ $server->id }}"
                                                            class="form-label">Giá nhà phân phối</label>
                                                        <input type="text" class="form-control"
                                                            id="price_distributor_{{ $server->id }}"
                                                            name="price_distributor"
                                                            value="{{ $server->price_distributor }}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="min_{{ $server->id }}" class="form-label">Tối
                                                            thiểu</label>
                                                        <input type="text" class="form-control"
                                                            id="min_{{ $server->id }}" name="min"
                                                            value="{{ $server->min }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="max_{{ $server->id }}" class="form-label">Tối
                                                            đa</label>
                                                        <input type="text" class="form-control"
                                                            id="max_{{ $server->id }}" name="max"
                                                            value="{{ $server->max }}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="title_{{ $server->id }}" class="form-label">Tiêu
                                                            đề</label>
                                                        <input type="text" class="form-control"
                                                            id="title_{{ $server->id }}" name="title"
                                                            value="{{ $server->title }}" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="description_{{ $server->id }}"
                                                            class="form-label">Miêu tả</label>
                                                        <textarea class="form-control" id="description_{{ $server->id }}" name="description" rows="3">{{ $server->description }}</textarea>
                                                    </div>
                                                </div>

                                                @if (getDomain() == env('PARENT_SITE'))
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="actual_service" class="form-label">Nhà cung
                                                                cấp</label>
                                                            <input type="text" class="form-control bg-light"
                                                                id="actual_service" name="actual_service"
                                                                value="{{ $server->actual_service }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="actual_server" class="form-label">Máy chủ nhà cung
                                                                cấp</label>
                                                            <input type="text" class="form-control bg-light"
                                                                id="actual_server" name="actual_server"
                                                                value="{{ $server->actual_server }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3" style="display:none;">
                                                        <div class="col-md-12">
                                                            <label for="actual_path" class="form-label">Đường dẫn
                                                                nguồn</label>
                                                            <input type="text" class="form-control" id="actual_path"
                                                                name="actual_path" value="{{ $server->actual_path }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="action" class="form-label">Thao tác</label>
                                                            <select id="action_{{ $server->id }}" name="action"
                                                                class="form-select">
                                                                <option value="default"
                                                                    @if ($server->action == 'default') selected @endif>Mặc
                                                                    định</option>
                                                                <option value="get-uid"
                                                                    @if ($server->action == 'get-uid') selected @endif>Tự
                                                                    động get UID</option>
                                                                <option value="get-username-tiktok"
                                                                    @if ($server->action == 'get-username-tiktok') selected @endif>Tự
                                                                    động get Username tiktok</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="order_type" class="form-label">Tính năng hoàn
                                                                tiền</label>
                                                            <select id="order_type_{{ $server->id }}" name="order_type"
                                                                class="form-select">
                                                                <option value="default"
                                                                    @if ($server->order_type == 'default') selected @endif>Không
                                                                    hoàn tiền</option>
                                                                <option value="refund"
                                                                    @if ($server->order_type == 'refund') selected @endif>Được
                                                                    hoàn tiền</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="warranty" class="form-label">Tính năng bảo
                                                                hành</label>
                                                            <select id="warranty_{{ $server->id }}" name="warranty"
                                                                class="form-select">
                                                                <option value="no"
                                                                    @if ($server->warranty == 'no') selected @endif>Không
                                                                    bảo hành</option>
                                                                <option value="yes"
                                                                    @if ($server->warranty == 'yes') selected @endif>Được
                                                                    bảo hành</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="status_{{ $server->id }}" class="form-label">Trạng
                                                            thái</label>
                                                        <select id="status_{{ $server->id }}" name="status"
                                                            class="form-select">
                                                            <option value="Active"
                                                                @if ($server->status == 'Active') selected @endif>Hoạt động
                                                            </option>
                                                            <option value="InActive"
                                                                @if ($server->status == 'InActive') selected @endif>Không
                                                                hoạt động</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div id="basic-1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="history"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                        aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="select-all">
                                                </th>
                                                <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1" aria-sort="descending"
                                                    aria-label="#: activate to sort column ascending"
                                                    style="width: 18.2125px;">#</th>
                                                <th data-sortable="false" width="370" class="sorting_disabled"
                                                    rowspan="1" colspan="1" aria-label="Thao tác"
                                                    style="width: 370px;">Thao tác</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Dịch vụ: activate to sort column ascending"
                                                    style="width: 52.0625px;">Dịch vụ</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Máy chủ: activate to sort column ascending"
                                                    style="width: 62.375px;">Máy chủ</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Giá gốc: activate to sort column ascending"
                                                    style="width: 103.525px;">Giá gốc</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Giá thành viên: activate to sort column ascending"
                                                    style="width: 103.525px;">Giá thành viên </th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Giá cộng tác viên: activate to sort column ascending"
                                                    style="width: 77.15px;">Giá cộng tác viên</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Giá đại lý: activate to sort column ascending"
                                                    style="width: 67.0375px;">Giá đại lý</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Giá nhà phân phối" style="width: 61.8625px;">Giá nhà phân
                                                    phối</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Tối đa" style="width: 61.8625px;">Tối thiểu</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Tối thiểu" style="width: 61.8625px;">Tối đa</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Tiêu đề máy chủ: activate to sort column ascending"
                                                    style="width: 81.775px;">Tiêu đề máy chủ</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Miêu tả: activate to sort column ascending"
                                                    style="width: 81.775px;">Miêu tả</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Trạng thái" style="width: 61.8625px;">Trạng thái</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Nguồn" style="width: 61.8625px;">Nguồn</th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Máy chủ nguồn" style="width: 61.8625px;">Máy chủ nguồn
                                                </th>
                                                <th data-sortable="false" width="30"
                                                    class="text-center sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Thời gian tạo" style="width: 61.8625px;">Thời gian tạo
                                                </th>

                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title sparkle-text">Thêm dịch vụ mới</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.server.new.post') }}" method="POST" request="duymedia">
                                @csrf

                                <!-- Nền tảng MXH và dịch vụ -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="social" class="form-label">Chọn nền tảng MXH</label>
                                        <select class="form-control" id="social" name="social">
                                            <option value="">Vui lòng chọn nền tảng</option>
                                            @foreach ($social as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service" class="form-label">Chọn dịch vụ MXH</label>
                                        <select class="form-control" id="service" name="service">
                                            <option value="">Vui lòng chọn dịch vụ</option>
                                            @if (isset($service) && $service->count() > 0)
                                                @foreach ($service as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="mainOption" class="form-label">Chọn loại MXH</label>
                                        <select class="form-control" id="mainOption" name="mainOption">
                                            <option value="" selected>Chọn loại MXH</option>
                                            <option value="vietnam">Việt Nam</option>
                                            <option value="smmpanel">SMM PANEL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="vietnamOptions" style="display: none;">
                                        <label for="actual_service_vietnam" class="form-label">Chọn nhà cung cấp Việt
                                            Nam</label>
                                        <select class="form-control" id="actual_service_vietnam" name="actual_service">
                                            <option value="" selected>Chọn nguồn MXH Việt Nam</option>
                                            <option value="tuongtaccheo">tuongtaccheo.com (LOVE)</option>
                                            <option value="tuongtaccheo1">tuongtaccheo.com (CARE)</option>
                                            <option value="tuongtaccheo2">tuongtaccheo.com (HAHA)</option>
                                            <option value="tuongtaccheo3">tuongtaccheo.com (WOW)</option>
                                            <option value="tuongtaccheo4">tuongtaccheo.com (SAD)</option>
                                            <option value="tuongtaccheo5">tuongtaccheo.com (ANGRY)</option>
                                            <option value="autofb">autofb.pro</option>
                                            <option value="subgiare">Subgiare.vn</option>
                                            <option value="hacklike17">Hacklike17.com</option>
                                            <option value="2mxh">2mxh.com</option>
                                            <option value="trumvip">Trum.vip (chỉ bot và proxy)</option>
                                            <option value="traodoisub">Traodoisub.com</option>
                                            <option value="dontay">Default</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="providerSelect" style="display: none;">
                                        <label for="actual_service_smm" class="form-label">Chọn nhà cung cấp SMM
                                            Panel</label>
                                        <select class="form-control" id="actual_service_smm" name="actual_service">
                                            <option value="" selected>Chọn nhà cung cấp SMM Panel</option>
                                            @if ($providers->isEmpty())
                                                <option value="">No providers available</option>
                                            @else
                                                @foreach ($providers as $provider)
                                                    @php
                                                        $parsedUrl = parse_url($provider->url);
                                                        $providerDomain = isset($parsedUrl['host'])
                                                            ? preg_replace('/^www\./', '', $parsedUrl['host'])
                                                            : $provider->url;
                                                    @endphp
                                                    <option value="{{ $providerDomain }}"
                                                        data-url="{{ $provider->url }}" data-key="{{ $provider->key }}">
                                                        {{ $providerDomain }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" id="providerKey" name="provider_key">
                                    </div>
                                </div>
                                <div class="row mb-3" id="servicesDiv" style="display: none;">
                                    <div class="col-md-12">
                                        <label for="services" class="form-label">Dịch vụ nhà cung cấp</label>
                                        <select name="services[]" id="services" class="form-control select2">
                                            <option value="">Vui lòng chọn nhà cung cấp</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Máy chủ MXH và tiêu đề -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="server_service" class="form-label">Chọn máy chủ MXH</label>
                                        <select class="form-control" id="server_service" name="server_service">
                                            <option value="">Vui lòng chọn máy chủ</option>
                                            @for ($i = 1; $i < 35; $i++)
                                                <option value="{{ $i }}">Máy chủ: {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Tiêu đề</label>
                                        <input class="form-control" type="text" id="title" name="title"
                                            required>
                                    </div>
                                </div>

                                <!-- Miêu tả và giá -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Miêu tả</label>
                                        <textarea class="form-control border border-info" name="description" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="actual_price" class="form-label text-primary">Giá gốc</label>
                                        <input class="form-control" type="text" id="actual_price" name="actual_price"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price" class="form-label text-success">Giá thành viên</label>
                                        <input class="form-control" type="text" id="price" name="price"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price_collaborator" class="form-label text-danger">Giá Cộng tác
                                            viên</label>
                                        <input class="form-control" type="text" id="price_collaborator"
                                            name="price_collaborator" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price_agency" class="form-label text-warning">Giá Đại lý</label>
                                        <input class="form-control" type="text" id="price_agency" name="price_agency"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price_distributor" class="form-label text-info">Giá Nhà phân
                                            phối</label>
                                        <input class="form-control" type="text" id="price_distributor"
                                            name="price_distributor" required>
                                    </div>
                                </div>


                                <!-- Tối đa, Tối thiểu và Loại MXH -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="max" class="form-label">Tối đa</label>
                                        <input class="form-control" type="text" id="max" name="max"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="min" class="form-label">Tối thiểu</label>
                                        <input class="form-control" type="text" id="min" name="min"
                                            required>
                                    </div>
                                </div>


                                <!-- Máy chủ gốc và Đường dẫn nguồn -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="actual_server" class="form-label">Máy chủ gốc</label>
                                        <input class="form-control" type="text" id="actual_server"
                                            name="actual_server" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="actual_path" class="form-label">Đường dẫn nguồn</label>
                                        <input class="form-control" type="text" id="actual_path" name="actual_path"
                                            required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="flex-fill mx-1">
                                        <label for="action" class="form-label">Thao tác</label>
                                        <select class="form-control" id="action" name="action">
                                            <option value="default">Default</option>
                                            <option value="get-uid">Get UID</option>
                                            <option value="get-username-tiktok">Get Username TikTok</option>
                                            {{-- <option value="get-order">Tự động get Số lượng đơn (Chỉ Hacklike17)</option> --}}
                                        </select>
                                    </div>

                                    <div class="flex-fill mx-1">
                                        <label for="order_type" class="form-label">Tính năng hoàn tiền</label>
                                        <select class="form-control" id="order_type" name="order_type">
                                            <option value="default">Không hoàn tiền</option>
                                            <option value="refund">Được hoàn tiền</option>
                                        </select>
                                    </div>

                                    <div class="flex-fill mx-1">
                                        <label for="warranty" class="form-label">Tính năng bảo hành</label>
                                        <select class="form-control" id="warranty" name="warranty">
                                            <option value="no">Không bảo hành</option>
                                            <option value="yes">Được bảo hành</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Đóng</button>
                                    <button class="btn btn-success" type="submit">Thêm dịch vụ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal-notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Thông báo dịch vụ cho telegram</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.server.notification-telegram.post') }}" method="POST"
                                request="duymedia">
                                <div class="mb-3">
                                    <label for="social" class="form-label">Nền tảng</label>
                                    <select class="form-control" id="social" name="social">
                                        <option value="">Chọn dịch vụ</option>
                                        @foreach ($social as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="service" class="form-label">Dịch vụ</label>
                                    <select class="form-control" id="service" name="service">
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa giá dich vụ hàng loạt</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.server.auto-edit') }}" method="POST" request="duymedia">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Thao tác khi thêm</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="percent">Giá tiền tự thay đổi theo %</option>
                                        <option value="add">Tự cộng thêm số tiền giá nhập ở bên dưới</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Tăng/giảm giá theo %</label>
                                    <input class="form-control" type="text" id="price" name="price"
                                        placeholder="Nhập giá hoặc phần trăm" required>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Thực hiện</button>
                                    <button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Đóng</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@section('script')
    <script>
        // Cấu hình Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(document).ready(function() {
            $('select[name=social]').change(function() {
                $.ajax({
                    url: "{{ route('admin.service.checking.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == 'success') {
                            var service = $('select[name=service]');
                            service.empty();
                            $.each(data.data, function(key, value) {
                                service.append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            })
                        }
                    },
                    error: function(data) {
                        if (data.status == 500) {
                            toastr.error(data.responseJSON.message);
                        }
                    }
                })
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            createDataTable('#history', '{{ route('admin.list', 'list-server') }}', [{
                    data: null,
                    render: function(data) {
                        return `<input type="checkbox" class="delete-checkbox" data-server-id="${data.id}">`;
                    }
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                    <a href="javascript:void(0);" data-server-id="${data.id}" class="btn btn-outline-primary btn-sm edit-server-btn">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a href="javascript:void(0);" data-server-id="${data.id}" class="btn btn-outline-danger btn-sm delete-server-btn">
                        <i class="fa fa-trash"></i> Xóa
                    </a>
                `;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'server',
                    name: 'server'
                },
                {
                    data: 'actual_price',
                    name: 'actual_price'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'price_collaborator',
                    name: 'price_collaborator'
                },
                {
                    data: 'price_agency',
                    name: 'price_agency'
                },
                {
                    data: 'price_distributor',
                    name: 'price_distributor'
                },
                {
                    data: 'min',
                    name: 'min'
                },
                {
                    data: 'max',
                    name: 'max'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        return data === 'Active' ?
                            `<span class="badge bg-success">Hoạt động</span>` :
                            `<span class="badge bg-danger">Không hoạt động</span>`;
                    }
                },
                {
                    data: 'actual_service',
                    name: 'actual_service'
                },
                {
                    data: 'actual_server',
                    name: 'actual_server'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ]);

            // Xử lý sự kiện click trên nút sửa
            $(document).on('click', '.edit-server-btn', function() {
                const serverId = $(this).data('server-id');
                const modal = new bootstrap.Modal(document.getElementById(`modal-update-${serverId}`));
                modal.show();
            });

            // Xử lý sự kiện click trên nút xóa
            $(document).on('click', '.delete-server-btn', function() {
                const serverId = $(this).data('server-id');
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa dịch vụ này?',
                    text: "Bạn sẽ không thể khôi phục lại dịch vụ này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('admin.server.delete', ':id') }}`.replace(':id',
                                serverId),
                            type: 'GET',
                            data: {
                                _token: '{{ csrf_token() }}' // Nếu bạn vẫn muốn gửi token CSRF
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Đã xóa!',
                                        'Dịch vụ đã được xóa thành công.',
                                        'success'
                                    );
                                    $('#history').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Lỗi!',
                                        response.message ||
                                        'Không thể xóa dịch vụ. Vui lòng thử lại sau.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                let errorMessage =
                                    'Đã xảy ra lỗi trong quá trình xóa. Vui lòng thử lại sau.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                Swal.fire(
                                    'Lỗi!',
                                    errorMessage,
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mainOption = document.getElementById('mainOption');
            var vietnamOptions = document.getElementById('vietnamOptions');
            var providerSelect = document.getElementById('providerSelect');
            var servicesDiv = document.getElementById('servicesDiv');
            var serviceSelect = document.getElementById('services');
            var providerKeyInput = document.getElementById('providerKey');
            var actualServiceVietnam = document.getElementById('actual_service_vietnam');
            var actualServiceSmm = document.getElementById('actual_service_smm');

            mainOption.addEventListener('change', function() {
                var selectedOption = mainOption.value;
                toggleOptions(selectedOption);
            });

            // Hiển thị hoặc ẩn các phần tử dựa trên lựa chọn loại MXH
            mainOption.addEventListener('change', function() {
                var selectedOption = mainOption.value;
                if (selectedOption === 'smmpanel') {
                    vietnamOptions.style.display = 'none';
                    providerSelect.style.display = 'block';
                    servicesDiv.style.display = 'block'; // Hiển thị phần tử dịch vụ khi chọn SMM Panel
                } else if (selectedOption === 'vietnam') {
                    vietnamOptions.style.display = 'block';
                    providerSelect.style.display = 'none';
                    servicesDiv.style.display = 'none'; // Ẩn phần tử dịch vụ khi chọn Việt Nam
                } else {
                    vietnamOptions.style.display = 'none';
                    providerSelect.style.display = 'none';
                    servicesDiv.style.display = 'none'; // Ẩn phần tử dịch vụ khi không chọn gì
                }
            });

            // Cập nhật providerKey và tải dịch vụ khi chọn nhà cung cấp SMM Panel
            actualServiceSmm.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                providerKeyInput.value = selectedOption.getAttribute('data-key');
                loadServices(selectedOption.getAttribute('data-url'));
            });

            // Hàm để tải dịch vụ từ API hoặc một nguồn dữ liệu khác
            function loadServices(url) {
                fetch(`/api/getServices?url=${encodeURIComponent(url)}`)
                    .then(response => response.json())
                    .then(data => {
                        serviceSelect.innerHTML = '<option value="">Vui lòng chọn dịch vụ</option>';
                        data.services.forEach(service => {
                            var option = document.createElement('option');
                            option.value = service.id;
                            option.textContent = service.name;
                            serviceSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Lỗi khi tải dịch vụ:', error));
            }

            // Đồng bộ hóa lựa chọn của actual_service_vietnam và actual_service_smm
            function syncServiceOptions(value) {
                actualServiceVietnam.value = value;
                actualServiceSmm.value = value;
            }

            // Gộp sự kiện thay đổi cho cả hai dropdown
            actualServiceVietnam.addEventListener('change', function() {
                syncServiceOptions(this.value);
            });

            actualServiceSmm.addEventListener('change', function() {
                syncServiceOptions(this.value);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainOption = document.getElementById('mainOption');
            const vietnamOptions = document.getElementById('vietnamOptions');
            const providerSelect = document.getElementById('providerSelect');
            const servicesDiv = document.getElementById('servicesDiv');
            const serviceSelect = document.getElementById('services');
            const providerKeyInput = document.getElementById('providerKey');
            const actualServiceVietnam = document.getElementById('actual_service_vietnam');
            const actualServiceSmm = document.getElementById('actual_service_smm');

            function toggleOptions(selectedOption) {
                const displayStyle = {
                    smmpanel: ['none', 'block', 'block'],
                    vietnam: ['block', 'none', 'none'],
                    default: ['none', 'none', 'none']
                };

                [vietnamOptions.style.display, providerSelect.style.display, servicesDiv.style.display] =
                displayStyle[selectedOption] || displayStyle.default;
            }

            mainOption.addEventListener('change', () => toggleOptions(mainOption.value));

            actualServiceSmm.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                providerKeyInput.value = selectedOption.getAttribute('data-key');
                loadServices(selectedOption.getAttribute('data-url'));
            });

            function loadServices(url) {
                fetch(`/api/getServices?url=${encodeURIComponent(url)}`)
                    .then(response => response.json())
                    .then(data => {
                        serviceSelect.innerHTML = '<option value="">Vui lòng chọn dịch vụ</option>';
                        data.services.forEach(service => {
                            serviceSelect.add(new Option(service.name, service.id));
                        });
                    })
                    .catch(error => console.error('Lỗi khi tải dịch vụ:', error));
            }

            function syncServiceOptions(value) {
                actualServiceVietnam.value = value;
                actualServiceSmm.value = value;
            }

            [actualServiceVietnam, actualServiceSmm].forEach(element =>
                element.addEventListener('change', function() {
                    syncServiceOptions(this.value);
                })
            );
        });
    </script>



    <script>
        $(document).ready(function() {
            // Xử lý sự kiện thay đổi của dropdown dịch vụ
            $('#actual_service_smm').on('change', function() {
                const providerUrl = $(this).val();
                const providerKey = $(this).find('option:selected').data('key');

                if (providerUrl && providerKey) {
                    $.ajax({
                        url: '{{ route('admin.get.services') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            provider_url: providerUrl,
                            provider_key: providerKey
                        },
                        success: function(response) {
                            const services = response.services || [];
                            const $servicesDropdown = $('#services');

                            $servicesDropdown.empty().append(
                                services.length ?
                                services.map(service =>
                                    $('<option></option>').val(service.service)
                                    .data('name', service.name)
                                    .data('desc', service.desc)
                                    .data('rate', service.rate)
                                    .data('min', service.min)
                                    .data('max', service.max)
                                    .data('service', service.service)
                                    .text(
                                        `ID ${service.service ?? ''} - ${service.name ?? ''} | ${service.type ?? ''} | ${service.category ?? ''} | Giá: ${service.rate ?? ''} | Tối thiểu: ${service.min ?? ''} | Tối đa: ${service.max ?? ''} | Mô tả: ${service.desc ?? ''}`
                                    )
                                ) :
                                $('<option></option>').val('').text('Không có dịch vụ nào.')
                            );
                            $('#servicesDiv').show();
                        },
                        error: function(xhr) {
                            console.error('Có lỗi xảy ra:', xhr.responseText);
                        }
                    });
                } else {
                    $('#services').empty().append($('<option></option>').val('').text(
                        'Vui lòng chọn nhà cung cấp'));
                    $('#servicesDiv').hide();
                }
            });

            // Update form fields on service selection
            $('#services').on('change', function() {
                const selectedOption = $(this).find('option:selected');

                // Extract data from the selected option
                const serviceName = selectedOption.data('name') || '';
                const serviceRate = selectedOption.data('rate') || '';
                const serviceMin = selectedOption.data('min') || '';
                const serviceMax = selectedOption.data('max') || '';
                const serviceDesc = selectedOption.data('desc') || '';
                const serviceId = selectedOption.data('service') || '';
                const servicePath = '/';

                // Update form inputs
                $('#title').val(serviceName);
                $('#actual_price').val(serviceRate);
                $('#price').val(serviceRate);
                $('#price_collaborator').val(serviceRate);
                $('#price_agency').val(serviceRate);
                $('#price_distributor').val(serviceRate);
                $('#min').val(serviceMin);
                $('#max').val(serviceMax);
                $('textarea[name="description"]').val(serviceDesc);
                $('input[name="actual_server"]').val(serviceId);
                $('input[name="actual_path"]').val(servicePath);


                // Log for debugging
                console.log('Selected Service Description:', serviceDesc);
            });

            $('#delete-selected').on('click', function() {
                const selectedIds = $('.delete-checkbox:checked').map(function() {
                    return $(this).data('server-id');
                }).get();

                if (selectedIds.length) {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa các dịch vụ đã chọn?',
                        text: "Bạn sẽ không thể khôi phục lại các dịch vụ này!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `{{ route('admin.server.bulk-delete') }}`,
                                type: 'POST',
                                data: {
                                    ids: selectedIds,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.fire('Đã xóa!',
                                        'Các dịch vụ đã được xóa thành công.',
                                        'success');
                                    // Cập nhật giao diện hoặc tải lại dữ liệu nếu cần
                                },
                                error: function(xhr) {
                                    Swal.fire('Lỗi!', xhr.responseJSON?.message ||
                                        'Không thể xóa các dịch vụ. Vui lòng thử lại sau.',
                                        'error');
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire('Chú ý', 'Vui lòng chọn ít nhất một dịch vụ để xóa.', 'warning');
                }
            });

            $('#select-all').on('change', function() {
                $('.delete-checkbox').prop('checked', this.checked);
            });

            $('.delete-checkbox').on('change', function() {
                $('#select-all').prop('checked', $('.delete-checkbox:checked').length === $(
                    '.delete-checkbox').length);
            });

            // Cập nhật dữ liệu nhà cung cấp
            function updateProviderData(selectElement) {
                var selectedOption = $(selectElement).find('option:selected');
                var providerDomain = selectedOption.val();
                var providerUrl = selectedOption.data('url');
                var providerKey = selectedOption.data('key');

                $('#providerKey').val(providerKey);
            }

            // Đồng bộ hóa giá trị của các trường
            document.getElementById('actual_service').addEventListener('change', function() {
                document.getElementById('actual_service_smm').value = this.value;
            });

            document.getElementById('actual_service_smm').addEventListener('change', function() {
                document.getElementById('actual_service').value = this.value;
            });
        });
    </script>
    <script>
        function updateProviderData(selectElement) {
            var selectedOption = $(selectElement).find('option:selected');
            var providerDomain = selectedOption.val();
            var providerUrl = selectedOption.data('url');
            var providerKey = selectedOption.data('key');

            $('#providerKey').val(providerKey);
        }
        document.getElementById('actual_service').addEventListener('change', function() {
            document.getElementById('actual_service_smm').value = this.value;
        });

        document.getElementById('actual_service_smm').addEventListener('change', function() {
            document.getElementById('actual_service').value = this.value;
        });
    </script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi nhấn nút "Xóa đã chọn"
            $('#delete-selected').on('click', function() {
                const selectedIds = [];
                $('.delete-checkbox:checked').each(function() {
                    selectedIds.push($(this).data('server-id'));
                });

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa các dịch vụ đã chọn?',
                        text: "Bạn sẽ không thể khôi phục lại các dịch vụ này!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `{{ route('admin.server.bulk-delete') }}`,
                                type: 'POST',
                                data: {
                                    ids: selectedIds,
                                    _token: '{{ csrf_token() }}' // Ensure CSRF token is correctly set
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire(
                                            'Đã xóa!',
                                            'Các dịch vụ đã được xóa thành công.',
                                            'success'
                                        );
                                        // Optionally, reload the data or update the UI
                                    } else {
                                        Swal.fire(
                                            'Lỗi!',
                                            response.message ||
                                            'Không thể xóa các dịch vụ. Vui lòng thử lại sau.',
                                            'error'
                                        );
                                    }
                                },
                                error: function(xhr) {
                                    let errorMessage =
                                        'Đã xảy ra lỗi trong quá trình xóa. Vui lòng thử lại sau.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                    Swal.fire('Lỗi!', errorMessage, 'error');
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire('Chú ý', 'Vui lòng chọn ít nhất một dịch vụ để xóa.', 'warning');
                }
            });

            // Chọn tất cả checkbox khi click vào <th> input checkbox
            $('#select-all').on('change', function() {
                $('.delete-checkbox').prop('checked', this.checked);
            });

            // Khi bất kỳ checkbox nào được chọn hoặc bỏ chọn, cập nhật trạng thái của #select-all
            $('.delete-checkbox').on('change', function() {
                if ($('.delete-checkbox:checked').length === $('.delete-checkbox').length) {
                    $('#select-all').prop('checked', true);
                } else {
                    $('#select-all').prop('checked', false);
                }
            });
        });
    </script>
@endsection
