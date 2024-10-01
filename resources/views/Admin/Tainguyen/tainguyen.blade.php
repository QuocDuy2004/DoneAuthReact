@extends('Admin.Layout.App')
@section('title', 'Thêm tài nguyên mới')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Quản lý tài nguyên</h1>
                <div class="ms-md-1 ms-0"></div>
            </div>
            <!-- Page Header Close -->

            <!-- Start:: Content -->
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary"><i
                        class="fas fa-plus"></i> Thêm mới</button>
            </div>
            @foreach ($tainguyen as $tain)
                <!-- Modal chỉnh sửa thông tin -->
                <div class="modal fade" id="modal-update-{{ $tain->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel{{ $tain->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $tain->id }}">Chỉnh sửa thông tin tài
                                    nguyên</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.taikhoan.tainguyen.edit.post', $tain->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Tên</label>
                                            <input class="form-control" type="text" id="name"
                                                value="{{ $tain->name }}" name="name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Đường dẫn ảnh quốc gia</label>
                                        <input class="form-control" type="text" id="image"
                                            value="{{ $tain->image }}" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Miêu tả</label>
                                        <input class="form-control" type="text" id="description"
                                            value="{{ $tain->description }}" name="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Thông tin tài nguyên (vd:
                                            tk:abcdef | mk: 123456 | mail: abc123@gmail.com | 2fa: SAUS OLGF)</label>
                                        <textarea name="thongtin" rows="5" style="height: 175px" class="form-control border border-info"
                                            placeholder="Name">{{ $tain->thongtin }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá thành viên</label>
                                        <input class="form-control" type="text" id="price"
                                            value="{{ $tain->price }}" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_collaborator" class="form-label">Giá cộng tác viên</label>
                                        <input class="form-control" type="text" id="price_collaborator"
                                            value="{{ $tain->price_collaborator }}" name="price_collaborator">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_agency" class="form-label">Giá đại lý</label>
                                        <input class="form-control" type="text" id="price_agency"
                                            value="{{ $tain->price_agency }}" name="price_agency">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price_distributor" class="form-label">Giá nhà phân phối</label>
                                        <input class="form-control" type="text" id="price_distributor"
                                            value="{{ $tain->price_distributor }}" name="price_distributor">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status{{ $tain->id }}" class="form-label">Trạng thái</label>
                                        <select class="form-control" id="status{{ $tain->id }}" name="status">
                                            <option value="show" @if ($tain->status == 'show') selected @endif>Hiển
                                                thị</option>
                                            <option value="hide" @if ($tain->status == 'hide') selected @endif>Ẩn
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
            <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm tài nguyên mới</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.taikhoan.tainguyen.new.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="chuyenmuc" class="form-label">Chuyên mục</label>
                                    <select class="form-control" id="chuyenmuc" name="chuyenmuc">
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Tên tài nguyên</label>
                                        <input class="form-control" type="text" id="name"
                                            value="{{ old('name') }}" name="name" placeholder="Tên tài nguyên">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Hình ảnh quốc gia</label>
                                        <input class="form-control" type="text" id="image"
                                            value="{{ old('image') }}" name="image" placeholder="Hình ảnh quốc gia">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Miêu tả</label>
                                        <textarea value="{{ old('description') }}" name="description" rows="5" class="form-control border border-info" placeholder="Chú ý" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="thongtin" class="form-label">Thông tin</label>
                                        <textarea value="{{ old('thongtin') }}" name="thongtin" rows="5" class="form-control border border-info" placeholder="Chú ý" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="price" class="form-label">Giá thành viên</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                                                placeholder="Giá thành viên" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price_collaborator" class="form-label">Giá cộng tác viên</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="price_collaborator" value="{{ old('price_collaborator') }}"
                                                placeholder="Giá cộng tác viên" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price_agency" class="form-label">Giá Đại lý</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="price_agency" value="{{ old('price_agency') }}"
                                                placeholder="Giá đại lý" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price_distributor" class="form-label">Giá Nhà phân phối</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="price_distributor" value="{{ old('price_distributor') }}"
                                                placeholder="Giá nhà phân phối" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary col-12">Thêm tài nguyên mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table id="list-tainguyen"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                        aria-describedby="file_export_info">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên tài nguyên</th>
                                    <th>Thông tin</th>
                                    <th>Miêu tả</th>
                                    <th>Giá thành viên</th>
                                    <th>Giá cộng tác viên</th>
                                    <th>Giá đại lý</th>
                                    <th>Giá nhà phân phối</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        createDataTable('#list-tainguyen', '{{ route('admin.list', 'list-tainguyen') }}', [{
                data: 'id'
            },
            {
                data: 'name'
            }, {
                data: 'thongtin'
            }, {
                data: 'description'
            }, {
                data: 'price',

            },
            {
                data: 'price_collaborator',

            },
            {
                data: 'price_agency',

            },
            {
                data: 'price_distributor',

            },

            {
                data: 'created_at',

            },
            {
                data: null,
                render: function(data) {
                    return `
                   <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-update-${data.id}" class="btn btn-outline-primary btn-sm">Sửa</a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteTainguyen(${data.id})">Xóa</button>`
                }
            }
        ])

        function deleteTainguyen(id) {
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
                        url: '{{ route('admin.tainguyen.tainguyen.delete', 'id') }}'.replace('id', id),
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
                                $('#list-tainguyen').DataTable().ajax.reload();
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
