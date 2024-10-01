@extends('Admin.Layout.App')

@section('title', 'Chỉnh sửa dịch vụ')

@section('content')

<div class="row ">
        
  <div class="col-md-12">
            <div class="card">
            <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                                        <div class="ribbon-label text-uppercase fw-bold bg-default">
                                        Chỉnh sửa dịch vụ
                                            <span class="ribbon-inner bg-default"></span>
                                        </div>
                                    </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.service.edit.post', $service->id) }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="name"
                                value="{{ $service->name }}" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Tên dịch vụ</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="status" id="" class="form-select mb-3">
                                <option value="show" @if ($service->status == 'show') selected @endif>Hoạt động</option>
                                <option value="hide" @if ($service->status == 'hide') selected @endif>Không hoạt động
                                </option>
                            </select>
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Trạng thái</span></label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary col-12">Chỉnh sửa dịch vụ</button>
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
