@extends('Admin.Layout.App')
@section('title', 'Lịch sử đơn hỗ trợ')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Phản hồi báo cáo khách hàng</h1>
                <div class="ms-md-1 ms-0"></div>
            </div>
            <!-- Page Header Close -->
          
            @foreach ($tickets as $reply)
            <div class="modal fade" id="modal-update-{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $reply->id }}">Phản hồi báo cáo #{{ $reply->id }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form action="{{ route('admin.tickets.reply', $reply->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="text" class="form-label">Nội dung</label>
                                            <textarea class="form-control bg-light" id="text" name="text" readonly>{{ $reply->text }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reply" class="form-label">Phản hồi</label>
                                            <textarea class="form-control" id="text" name="reply">{{ $reply->reply }}</textarea>
                                        </div>
                                        <!-- Các trường dữ liệu còn lại -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <div id="" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="history-tickets"
                                        class="table border table-striped table-bordered display text-nowrap dataTable responsive w-100"
                                        aria-describedby="file_export_info">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nội dung</th>
                                                <th>Phản hồi</th>
                                                <th>Trạng thái</th>
                                                <th>Thời gian</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $ticket)
                                                <tr>
                                                    <td>{{ $ticket->id }}</td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3" readonly style="min-width: 200px;">
                                                            {{ $ticket->text }}
                                                        </textarea>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control note" rows="3" readonly style="min-width: 200px;">
                                                            {{ $ticket->reply ?? '' }}
                                                        </textarea>
                                                    </td>
                                                    <td>
                                                        @if ($ticket->status == 'Success')
                                                            <span class="badge bg-success">{{ $ticket->status }}</span>
                                                        @elseif ($ticket->status == 'Pending')
                                                            <span class="badge bg-warning">{{ $ticket->status }}</span>
                                                        @elseif ($ticket->status == 'Error')
                                                            <span class="badge bg-danger">{{ $ticket->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $reply->id }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-reply"></i>
                                                        </a>
                                                        
                                                        <a href="{{ route('admin.tickets.delete', $ticket->id) }}"
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                            <i class="fas fa-trash"></i>
                                                         </a>
                                                         
                                                    </td>
                                                </tr>
                                            @endforeach
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
@endsection
