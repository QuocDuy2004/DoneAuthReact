@extends('Admin.Layout.App')

@section('title', 'Thêm máy chủ mới')

@section('content')

    <div class="row ">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Thêm dịch vụ mới
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary col-12" id="import-btn">Import</button>
                </div>
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="new-server-tab" data-bs-toggle="tab" href="#new-server"
                            role="tab" aria-controls="new-server" aria-selected="true">Thêm dịch vụ mới</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="import-tab" data-bs-toggle="tab" href="#import" role="tab"
                            aria-controls="import" aria-selected="false">Import</a>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="myTabContent">
                    <!-- New Server Tab -->
                    <div class="tab-pane fade show active" id="new-server" role="tabpanel" aria-labelledby="new-server-tab">
                        <!-- Existing form content -->
                    </div>

                    <!-- Import Tab -->
                    <div class="tab-pane fade" id="import" role="tabpanel" aria-labelledby="import-tab">
                        <div class="form-floating mb-3">
                            <select id="provider-urls" class="form-select border border-info">
                                <option value="">Chọn URL từ Providers</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">URL Providers</span></label>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <form action="{{ route('admin.server.new.post') }}" method="POST" request="duymedia">
                            <div class="form-floating mb-3">
                                <select name="social" id="" class="form-select border border-info">
                                    <option value="">Chọn dịch vụ MXH</option>
                                    @foreach ($social as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Dịch vụ MXH</span></label>
                            </div>
                            <div class="form-floating mb-3">

                                <select name="service" id="" class="form-select border border-info">
                                    <option value="">Vui lòng chọn dịch vụ MXH</option>
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Dịch vụ </span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="server_service" id="" class="form-select border border-info">
                                    @for ($i = 1; $i < 35; $i++)
                                        <option value="{{ $i }}">Server: {{ $i }}</option>
                                    @endfor
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Máy chủ </span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-info" name="title"
                                    placeholder="Name">
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Tiêu đề</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea type="text" class="form-control border border-info" name="description" rows="5" placeholder="Name"></textarea>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Thông tin máy chủ</span></label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info" name="price"
                                            placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Giá Thành viên</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info"
                                            name="price_collaborator" placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Giá Cộng tác viên</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info" name="price_agency"
                                            placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Giá Đại lý</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info"
                                            name="price_distributor" placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Giá Nhà phân phối</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info" name="min"
                                            placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Mua tối thiểu</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border border-info" name="max"
                                            placeholder="Name">
                                        <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Mua tối đa</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-control border border-info" name="actual_service" placeholder="Name">
                                    <option value="tuongtaccheo">tuongtaccheo.com (LOVE)</option>
                                    <option value="tuongtaccheo1">tuongtaccheo.com (CARE)</option>
                                    <option value="tuongtaccheo2">tuongtaccheo.com (HAHA)</option>
                                    <option value="tuongtaccheo3">tuongtaccheo.com (WOW)</option>
                                    <option value="tuongtaccheo4">tuongtaccheo.com (SAD)</option>
                                    <option value="tuongtaccheo5">tuongtaccheo.com (ANGRY)</option>
                                    <option value="autofb">autofb.pro</option>
                                    <option value="msv">msv.vn</option>
                                    <option value="trumsubre">trumsubre.com</option>
                                    <option value="subgiare">Subgiare.vn</option>
                                    <option value="hacklike17">Hacklike17.com</option>
                                    <option value="smmraja">smmraja.com</option>
                                    <option value="2mxh">2mxh.com</option>

                                    <option value="1dg">1dg.me</option>
                                    <option value="submeta">Submeta.vn</option>
                                    <option value="tuongtacsale">Tuongtacsale.com</option>
                                    <option value="alosmm">Alosmm.com</option>
                                    <option value="trumvip">Trum.vip (chỉ bot và proxy)</option>

                                    <option value="traodoisub">Traodoisub.com</option>
                                    <option value="sainpanel">Sainpanel.com</option>
                                    <option value="dontay">Đơn tay</option>
                                    <option value="2four">Trum24H.Pro</option>
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Nguồn</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-info" name="   "
                                    placeholder="Name">
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Máy chủ nguồn</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-info" name="actual_path"
                                    placeholder="Name">
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Đường dẫn nguồn</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-select border border-info" name="action">
                                    <option value="default">Mặc định</option>
                                    <option value="get-uid">Tự động get UID</option>
                                    <option value="get-username-tiktok">Tự động get username-tiktok</option>
                                    <option value="get-order">Tự động get Số lượng đơn (Chỉ Hacklike17)</option>
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Thao tác khi chọn server</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-select border border-info" name="order_type">
                                    <option value="default">Không hoàn tiền</option>
                                    <option value="refund">Được hoàn tiền</option>
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Khi tạo đơn hàng</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-select border border-info" name="warranty">
                                    <option value="no">Không bảo hành</option>
                                    <option value="yes">Được bảo hành</option>
                                </select>
                                <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                        class="border-start border-info ps-3">Bảo hành</span></label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary col-12">Thêm máy chủ mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>



    <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            //change social value
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
            // Handle tab switching and populating options
            $('#import-btn').click(function() {
                $('#myTab a[href="#import"]').tab('show'); // Switch to Import tab

                $.ajax({
                    url: "{{ route('admin.providers.list') }}", // Đường dẫn tới API lấy danh sách providers
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == 'success') {
                            var providerUrls = $('#provider-urls');
                            providerUrls.empty();
                            providerUrls.append(
                                '<option value="">Chọn URL từ Providers</option>'
                            ); // Default option
                            $.each(data.data, function(key, value) {
                                providerUrls.append('<option value="' + value.url +
                                    '">' + value.url + '</option>');
                            });
                        }
                    },
                    error: function(data) {
                        if (data.status == 500) {
                            toastr.error(data.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
