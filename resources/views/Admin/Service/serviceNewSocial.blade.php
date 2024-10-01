@extends('Admin.Layout.App')

@section('title', 'Nền tảng mạng xã hội')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Thêm nền tảng mới</h1>
                <div class="ms-md-1 ms-0">
                </div>
            </div>
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary"><i
                        class="fas fa-plus"></i> Thêm mới</button>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table id="list-social"
                            class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên nền tảng</th>
                                    <th>Đường dẫn</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Create -->
            <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm nền tảng mới</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.service.new.social.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="social_service" class="form-label">Tên nền tảng</label>
                                    <input class="form-control" type="text" value="{{ old('social_service') }}"
                                        id="social_service" name="social_service" required>
                                </div>
                                <div class="mb-3">
                                    <label for="social_path" class="form-label">Đường dẫn nền tảng</label>
                                    <input class="form-control" type="text" value="{{ old('social_path') }}"
                                        id="social_path" name="social_path" required>
                                    <span class="border-start border-primary ps-2">Đường dẫn dịch vụ (VD:
                                        facebook,tiktok,instagram,...)</span>
                                </div>
                                <div class="mb-3">
                                    <label for="social_image" class="form-label">Đường dẫn ảnh nền tảng</label>
                                    <input class="form-control" type="text" value="{{ old('social_image') }}"
                                        id="social_image" name="social_image" required>
                                </div>
                                <div class="mb-3">
                                    <label for="social_status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="social_status" name="social_status">
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
            @foreach ($socials as $social)
                <div class="modal fade" id="modal-update-{{ $social->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel{{ $social->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $social->id }}">Chỉnh sửa nền tảng
                                    #{{ $social->id }}</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.service.social.edit.post', $social->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="social_service_{{ $social->id }}" class="form-label">Tên nền
                                            tảng</label>
                                        <input class="form-control" type="text"
                                            value="{{ old('social_service', $social->name) }}"
                                            id="social_service_{{ $social->id }}" name="social_service" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="social_path_{{ $social->id }}" class="form-label">Đường dẫn nền
                                            tảng</label>
                                        <input class="form-control" type="text"
                                            value="{{ old('social_path', $social->slug) }}"
                                            id="social_path_{{ $social->id }}" name="social_path" required>
                                        <span class="border-start border-primary ps-2">Đường dẫn dịch vụ (VD:
                                            facebook,tiktok,instagram,...)</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="social_image_{{ $social->id }}" class="form-label">Đường dẫn ảnh
                                            nền tảng</label>
                                        <input class="form-control" type="text"
                                            value="{{ old('social_image', $social->image) }}"
                                            id="social_image_{{ $social->id }}" name="social_image" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="social_status_{{ $social->id }}" class="form-label">Trạng
                                            thái</label>
                                        <select class="form-control" id="social_status_{{ $social->id }}"
                                            name="social_status">
                                            <option value="show"
                                                {{ old('social_status', $social->status) == 'show' ? 'selected' : '' }}>
                                                Hiển thị</option>
                                            <option value="hide"
                                                {{ old('social_status', $social->status) == 'hide' ? 'selected' : '' }}>Ẩn
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
        $(document).ready(function() {
            createDataTable('#list-social', '{{ route('admin.list', 'list-social') }}', [{
                    data: 'id'
                },
                {
                    data: 'image',
                    render: function(data, type, row) {
                        return `<img src="${data}" alt="Image" style="width: 50px; height: auto;">`;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'status'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                    <button data-bs-toggle="modal" data-bs-target="#modal-update-${data.id}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-edit"></i> Sửa
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="deleteSocial(${data.id})">Xóa</button>
                `;
                    }
                }
            ]);
        });

        function deleteSocial(id) {
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
                        url: '{{ route('admin.service.delete', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Dịch vụ đã được xóa thành công.',
                                    'success'
                                );
                                $('#list-social').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Không thể xóa dịch vụ.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi trong quá trình xóa.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
