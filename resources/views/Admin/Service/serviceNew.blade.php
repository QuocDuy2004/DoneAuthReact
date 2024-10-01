@extends('Admin.Layout.App')

@section('title', 'Thêm dịch vụ mới')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Thêm dịch vụ mới</h1>
            </div>
            <div class="mb-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#modal-create" class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                {{-- <button id="delete-selected" class="btn btn-outline-danger" disabled>
                    <i class="fas fa-trash"></i> Xóa đã chọn
                </button> --}}
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table id="list-service"
                            class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" id="select-all" /></th> --}}
                                    <th>#</th>
                                    <th>Tên nền tảng</th>
                                    <th>Tên dịch vụ</th>
                                    <th>Đường dẫn</th>
                                    <th>Thể loại</th>
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
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    @foreach ($services as $service)
        <div class="modal fade" id="modal-update-{{ $service->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $service->id }}">Chỉnh sửa nền tảng
                            #{{ $service->id }}</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.service.edit.post', $service->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên dịch vụ</label>
                                <input class="form-control" type="text" value="{{ $service->name }}" id="name"
                                    name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="status_{{ $service->id }}" class="form-label">Trạng thái</label>
                                <select class="form-control" id="status_{{ $service->id }}" name="status">
                                    <option value="show" {{ $service->status == 'show' ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="hide" {{ $service->status == 'hide' ? 'selected' : '' }}>Không hoạt
                                        động</option>
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

@section('script')
    <script>
        function openUpdateModal(id) {
            $('#modal-update-' + id).modal('show');
        }

        $(document).ready(function() {
            // let selectedIds = [];

            // Khởi tạo DataTable
            const table = createDataTable('#list-service', '{{ route('admin.list', 'list-service') }}', [
                // {
                //     data: null,
                //     render: function(data, type, row) {
                //         return `<input type="checkbox" class="service-checkbox" value="${data.id}" />`;
                //     }
                // },
                {
                    data: 'id'
                },
                {
                    data: 'social'
                },
                {
                    data: 'name'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'category'
                },
                {
                    data: 'status'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-outline-primary btn-sm" onclick="openUpdateModal(${data.id})">
                            <i class="fa fa-edit"></i> Sửa
                        </button>
                        <a href="{{ route('admin.service.delete', 'id') }}" class="btn btn-outline-danger btn-sm"> <i class="fa fa-trash"></i> Xóa</a>`
                            .replace(/id/g, data.id)
                    }
                }
            ]);

            // Lưu trạng thái checkbox khi DataTable reload
            // $('#list-service').on('draw.dt', function() {
            //     $('.service-checkbox').each(function() {
            //         if (selectedIds.includes($(this).val())) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            //     toggleDeleteButton();
            // });

            // Xử lý chọn tất cả
            // $('#select-all').on('click', function() {
            //     const isChecked = $(this).is(':checked');
            //     selectedIds = [];

            //     $('.service-checkbox').each(function() {
            //         $(this).prop('checked', isChecked);
            //         if (isChecked) {
            //             selectedIds.push($(this).val());
            //         }
            //     });
            //     toggleDeleteButton();
            // });

            // Xử lý checkbox cá nhân
            // $(document).on('click', '.service-checkbox', function() {
            //     const isChecked = $(this).is(':checked');
            //     const id = $(this).val();

            //     if (isChecked) {
            //         selectedIds.push(id);
            //     } else {
            //         selectedIds = selectedIds.filter(selectedId => selectedId !== id);
            //     }

            //     $('#select-all').prop('checked', $('.service-checkbox').length === $(
            //         '.service-checkbox:checked').length);
            //     toggleDeleteButton();
            // });

            // Xóa nhiều dịch vụ
            // $('#delete-selected').on('click', function() {
            //     if (selectedIds.length > 0) {
            //         Swal.fire({
            //             title: 'Bạn có chắc chắn muốn xóa các dịch vụ đã chọn?',
            //             text: "Bạn sẽ không thể khôi phục lại các dịch vụ này!",
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#dc3545',
            //             confirmButtonText: 'Xóa',
            //             cancelButtonText: 'Hủy'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 $.ajax({
            //                     url: '{{ route('admin.service.delete-multiple') }}',
            //                     type: 'DELETE',
            //                     data: {
            //                         ids: selectedIds,
            //                         _token: '{{ csrf_token() }}'
            //                     },
            //                     success: function(data) {
            //                         if (data.status === 'success') {
            //                             Swal.fire(
            //                                 'Đã xóa!',
            //                                 'Dịch vụ đã được xóa thành công.',
            //                                 'success'
            //                             );
            //                             $('#list-service').DataTable().ajax.reload();
            //                         } else {
            //                             Swal.fire(
            //                                 'Lỗi!',
            //                                 'Không thể xóa các dịch vụ.',
            //                                 'error'
            //                             );
            //                         }
            //                     },
            //                     error: function(xhr, status, error) {
            //                         Swal.fire(
            //                             'Lỗi!',
            //                             'Đã xảy ra lỗi trong quá trình xóa.',
            //                             'error'
            //                         );
            //                     }
            //                 });
            //             }
            //         });
            //     }
            // });

            // function toggleDeleteButton() {
            //     $('#delete-selected').prop('disabled', selectedIds.length === 0);
            // }

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
                                    $('#list-service').DataTable().ajax.reload();
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


        });
    </script>

@endsection
