@extends('Admin.Layout.App')

@section('title', 'Chỉnh sửa dịch vụ máy chủ')

@section('content')

    <div class="row ">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Chỉnh sửa máy chủ
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.order.edit.post', $order->id) }}" method="POST" request="duymedia">
                        <div class="form-floating mb-3">
                            <select name="status" id="" class="form-select border border-info">

                                <option value="Refunded" @if ($order->status == 'Refunded') selected @endif>Đã hoàn</option>
                                <option value="Success" @if ($order->status == 'Success') selected @endif>Hoàn thành
                                </option>
                                <option value="Active" @if ($order->status == 'Active') selected @endif>Hoạt động</option>
                                <option value="PendingOrder" @if ($order->status == 'PendingOrder') selected @endif>Chuẩn bị
                                </option>
                                <option value="Processing" @if ($order->status == 'Processing') selected @endif>Đang xử lý
                                </option>
                                <option value="Holding" @if ($order->status == 'Holding') selected @endif>Tạm hoãn</option>
                                <option value="Warranty" @if ($order->status == 'Warranty') selected @endif>Bảo hành</option>
                            </select>
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Trạng thái </span></label>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="start"
                                value="{{ $order->start }}" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Bắt đầu</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" value="{{ $order->buff }}"
                                name="buff" rows="5" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Đã chạy</span></label>
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary col-12">Chỉnh sửa</button>
                        </div>
                    </form>
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
