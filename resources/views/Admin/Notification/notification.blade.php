@extends('Admin.Layout.App')

@section('title', 'Quản lí thông báo')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Notices Settings</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Alert Component -->
            <!-- Alert Component Close -->

            <!-- Start:: Content -->
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Thông báo | hệ thống</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.notification.modal.post') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nội dung</label>
                            <textarea name="notice-modal" id="editor" cols="30" rows="10">{{ DataSite('notice') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary col-12">
                                Lưu thông báo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Thông báo | Trang chủ</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.notification.post') }}" method="POST">
                        @csrf
                         <div class="col-md-12X ">
                                <label for="title" class="form-label">Tên người thông báo</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Nội dung</label>
                            <textarea name="notice" id="editors" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary col-12">Thêm nội dung thông báo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: Content -->
    </div>
    </div>
@endsection
@section('script')
    {{-- Import link ckeditor 4  --}}
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
        /* onchange update */
        CKEDITOR.instances.editor.on('change', function() {
            document.getElementById("editor").value = CKEDITOR.instances.editor.getData();
        });

        CKEDITOR.replace('editors');
        /* onchange update */
        CKEDITOR.instances.editors.on('change', function() {
            document.getElementById("editors").value = CKEDITOR.instances.editors.getData();
        });
    </script>
    <script>
        createDataTable('#history', '{{ route('admin.list', 'history-notification') }}', [{
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
                render: function(row, type, index) {
                    return `
                        <button class="btn btn-danger" onclick="deleteNotification(${row.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    `
                }
            }
        ])

        function deleteNotification(id) {
            Swal.fire({
                title: "Thông báo!",
                text: 'Bạn có chắc chắn muốn xóa thông báo này không?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: `Xóa`,
                denyButtonText: `Không`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.notification.delete', 'id') }}".replace('id', id),
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire('Xóa thông báo thành công!', '', 'success')
                                $('#history').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Xóa thông báo thất bại!', '', 'error')
                            }
                        },
                        error: function(data) {
                            Swal.fire('Xóa thông báo thất bại!', '', 'error')
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Thông báo của bạn không bị xóa!', '', 'info')
                }
            })
        }
    </script>
@endsection
