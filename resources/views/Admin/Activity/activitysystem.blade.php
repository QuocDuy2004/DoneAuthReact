@extends('Admin.Layout.App')

@section('title', 'Quản lí các thông báo hệ thống')

@section('content')

    <div class="row ">

        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Thêm thông báo hệ thống
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.activitysystem.post') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="name" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Tên thông báo</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="content" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Nội thông báo</span></label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary col-12">Thêm thông báo hệ thống</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Lịch sử thông báo hệ thống
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="history" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên người gửi</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
    <script>
        createDataTable('#history', '{{ route('admin.list', 'history-activitysystem') }}', [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'content'
            },
            {
                data: 'created_at'
            },
            {
                data: null,
                render: function(data) {
                    return `
                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deleteActivitysystem(${data.id})">
                            <i class="fas fa-trash"></i>
                        </a>
                    `
                }
            },
        ])

        function deleteActivitysystem(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa thông báo hệ thống này?',
                text: "Bạn sẽ không thể khôi phục lại thông báo hệ thống này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('admin.activitysystem.delete', 'id') }}`.replace('id', id),
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Đã xóa!',
                                'thông báo hệ thống đã được xóa thành công.',
                                'success'
                            )
                            $('#history').DataTable().ajax.reload()
                        }
                    })
                }
            })
        }
    </script>
@endsection
