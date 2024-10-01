@extends('Admin.Layout.App')
@section('title', 'Chuyên mục')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Add Resrouce</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary"><i
                        class="fas fa-plus"></i> Thêm mới</button>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="list-chuyenmuc"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_desc" tabindex="0" aria-controls="basic-1"
                                                    rowspan="1" colspan="1" aria-sort="descending"
                                                    aria-label="#: activate to sort column ascending"
                                                    style="width: 18.2125px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Chuyêm mục: activate to sort column ascending"
                                                    style="width: 81.775px;">Chuyêm mục</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Đường dẫn sản phẩm: activate to sort column ascending"
                                                    style="width: 52.0625px;">Đường dẫn sản phẩm</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Đường dẫn ảnh: activate to sort column ascending"
                                                    style="width: 62.375px;">Đường dẫn ảnh</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Trạng thái: activate to sort column ascending"
                                                    style="width: 103.525px;">Trạng thái</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1"
                                                    colspan="1" aria-label="Thao tác: activate to sort column ascending"
                                                    style="width: 77.15px;">Thao tác</th>
                                            </tr>
                                        </thead>
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
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.category.new.post') }}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Tên</label>
                                        <input class="form-control" type="text" id="name" {{ old('name') }}
                                            name="name">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Đường dẫn sản phẩm</label>
                                    <input class="form-control" type="text" id="slug" value="{{ old('slug') }}"
                                        name="slug">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Đường dẫn hình ảnh</label>
                                    <input class="form-control" type="text" id="image" value="{{ old('image') }}"
                                        name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="show">Hiển thị</option>
                                        <option value="hide">Ẩn</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($resources as $res)
                <!-- Modal chỉnh sửa thông tin -->
                <div class="modal fade" id="modal-update-{{ $res->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel{{ $res->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $res->id }}">Chỉnh sửa thông tin</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.tainguyen.edit.post', $res->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="name{{ $res->id }}" class="form-label">Tên</label>
                                            <input class="form-control" type="text" id="name{{ $res->id }}"
                                                value="{{ $res->name }}" name="name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug{{ $res->id }}" class="form-label">Đường dẫn sản
                                            phẩm</label>
                                        <input class="form-control" type="text" id="slug{{ $res->id }}"
                                            value="{{ $res->slug }}" name="slug">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image{{ $res->id }}" class="form-label">Đường dẫn hình
                                            ảnh</label>
                                        <input class="form-control" type="text" id="image{{ $res->id }}"
                                            value="{{ $res->image }}" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status{{ $res->id }}" class="form-label">Trạng thái</label>
                                        <select class="form-control" id="status{{ $res->id }}" name="status">
                                            <option value="show" @if ($res->status == 'show') selected @endif>Hiển
                                                thị</option>
                                            <option value="hide" @if ($res->status == 'hide') selected @endif>Ẩn
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        createDataTable('#list-chuyenmuc', '{{ route('admin.list', 'list-chuyenmuc') }}', [{
                data: 'id'
            },
            {
                data: 'name'
            }, {
                data: 'slug'
            }, {
                data: 'image',
                render: function(data) {
                    return `<img src="${data}" alt="" width="100px">`
                }
            }, {
                data: 'status'
            },
            {
                data: null,
                render: function(data) {
                    return `
                   <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-update-${data.id}" class="btn btn-outline-primary btn-sm">Sửa</a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteChuyenmuc(${data.id})">Xóa</button>`
                }
            }
        ])

        function deleteChuyenmuc(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa dịch vụ này?',
                text: "Bạn sẽ không thể khôi phục lại dịch vụ này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Xóa dịch vụ này!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.tainguyen.delete', 'id') }}'.replace('id', id),
                        type: 'DELETE',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Dịch vụ đã được xóa thành công.',
                                    'success'
                                )
                                $('#list-chuyenmuc').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Xóa thất bại!',
                                    'Dịch vụ chưa được xóa.',
                                    'error'
                                )
                            }
                        }
                    })
                }
            })
        }
    </script>
@endsection
