@extends('Layout.App')
@section('title', 'Bán tai khoản')
@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Mua tài khoản</h1>
                <div class="ms-md-1 ms-0">
                </div>
            </div>
            <div class="card custom-card">
                <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-3 p-4">
                    <div class="card custom-card shadow-sm h-100 border-0">
                        <div class="card-body p-2">
                            @foreach ($tainguyen as $item)
                                <form class="space-y-3 "
                                    action="{{ route('api.chuyenmuc.order', ['chuyenmuc' => $category->slug]) }}"
                                    method="POST" request="duymedia">

                                    <input name="id_tainguyen" value="{{ $item->id }}" hidden>

                                    <div class="text-center mb-2">
                                        <h6 class="form-label fs-14 text-dark mb-1">{{ $item->name }}</h6>
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                            class="img-fluid rounded shadow-sm" width="120">
                                    </div>

                                    <div class="mb-2">
                                        <label for="description" class="form-label fs-13 text-dark"><strong>Mô
                                                tả:</strong></label>
                                        <p class="text-muted fs-13 mb-1">{!! $item->description !!}</p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="badge bg-danger text-white px-2 py-1">
                                            <strong>Hiện có:</strong>
                                            {{ count(array_filter(explode("\n", trim($item->thongtin)), 'strlen')) }}
                                        </div>
                                        <div class="badge bg-info text-white px-2 py-1">
                                            <strong>Đã bán:</strong> {{ $item->daban }}
                                        </div>
                                        <div class="badge bg-warning text-white px-2 py-1">
                                            <strong>Giá:</strong>
                                            {{ number_format(priceServer1($item->id, Auth::user()->level)) }} đ / 1
                                        </div>
                                    </div>

                                    <div class="input-group mb-2">
                                        @if (count(array_filter(explode("\n", trim($item->thongtin)), 'strlen')) > 0)
                                            <input type="number" onkeyup="bill()" class="form-control form-control-sm"
                                                name="quantity" placeholder="Số lượng">
                                            <button type="submit" class="btn btn-primary btn-sm px-3"
                                                show="Bạn có muốn thanh toán đơn hàng?, chúng tôi sẽ không hoàn tiền với đơn đã thanh toán."><i
                                                    class="fa fa-shopping-cart"></i> Mua</button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-sm w-100" disabled>
                                                <i class="fa fa-shopping-cart"></i> Hết hàng
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <div id="basic-1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="history-order-tainguyen"
                                            class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                            aria-describedby="file_export_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                                        rowspan="1" colspan="1" aria-sort="descending"
                                                        aria-label="#: activate to sort column ascending"
                                                        style="width: 18.2125px;">#</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Mã đơn: activate to sort column ascending"
                                                        style="width: 52.0625px;">Mã đơn</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Thông tin: activate to sort column ascending"
                                                        style="width: 62.375px;">Thông tin</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Tổng giá thành: activate to sort column ascending"
                                                        style="width: 103.525px;">Tổng giá thành</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Ngày mua: activate to sort column ascending"
                                                        style="width: 103.525px;">Ngày mua</th>

                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            createDataTable('#history-order-tainguyen', '{{ route('user.list.action', 'tainguyen-order') }}', [{
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Tự động tạo số thứ tự
                    }
                },
                {
                    data: 'order_codes',
                    render: function(data) {
                        return `
                    <div class="cursor-pointer text-primary" id="${data}" onclick="coppy('${data}');">
                       ${data}
                    </div>
                `;
                    }
                },
                {
                    data: 'thongtin',
                    render: function(data) {
                        return `<div class="d-flex">
                    <textarea class="form-control" rows="2" readonly onclick="coppy1('${data}');">${data}</textarea>
                    <button class="btn btn-primary ms-2" onclick="coppy('${data}');"><i class="fas fa-copy"></i> Copy</button>
                </div>`;
                    }
                },
                {
                    data: 'total_payment',
                    render: function(data) {
                        return `<b class="text-primary">${formatNumber(data)} ₫</b>`;
                    }
                },
                {
                    data: 'created_at',
                    render: function(data) {
                        return `<b class="text-danger">${data}</b>`;
                    }
                }
            ], {
                paging: true, // Bật phân trang
                searching: false, // Tắt tính năng tìm kiếm
                ordering: true, // Bật sắp xếp cột
                order: [
                    [0, 'asc']
                ], // Sắp xếp theo cột đầu tiên
                lengthMenu: [5, 10, 25, 50], // Tùy chọn số hàng hiển thị
                language: {
                    paginate: {
                        next: '→', // Biểu tượng cho nút phân trang
                        previous: '←'
                    }
                }
            });
        });
    </script>
    <script>
        function bill() {
            var server_service = $('input[name="id_tainguyen"]:checked');
            var price = server_service.attr('price');

            var quantity = $('input[name="quantity"]');

            var total_payment = Math.round(price * quantity) ?? 0;
            var exchangeRate = 25000;
            var total_payment_usdt = (total_payment / exchangeRate).toFixed(2);
            $('#lamtilo_huong').html(
                `<span class="text-lg font-bold">Tổng thanh toán [<b class="text-danger">${price} đ</b> / lượt]  </span> `
            );
            $('#total_payment').html(
                `<h2 class="text-4xl font-bold"><b class="text-primary">${formatNumber(total_payment)} ₫ |</b><b class="text-danger"> $ ${formatNumber(total_payment_usdt)}</b></h2> `
            );
        }
        $(document).ready(function() {
            bill();
        })
    </script>

@endsection
