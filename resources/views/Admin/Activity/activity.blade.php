@extends('Admin.Layout.App')

@section('title', 'Quản lí các hoạt động')

@section('content')

    <div class="row ">

        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Thêm hoạt động mới
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.activity.post') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="name" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Tên người tạo</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-info" name="content" placeholder="Name">
                            <label><i class="fa fa-star me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Nội dung mới</span></label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary col-12">Thêm hoạt động mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                        Lịch sử hoạt động
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
        createDataTable('#history', '{{ route('admin.list', 'history-activity') }}', [{
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
                        <a href="javascript:;" class="btn btn-danger btn-sm" onclick="deleteActivity(${data.id})">
                            <i class="fas fa-trash"></i>
                        </a>
                    `
                }
            },
        ])

        function deleteActivity(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa hoạt động này?',
                text: "Bạn sẽ không thể khôi phục lại hoạt động này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('admin.activity.delete', 'id') }}`.replace('id', id),
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Đã xóa!',
                                'Hoạt động đã được xóa thành công.',
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
