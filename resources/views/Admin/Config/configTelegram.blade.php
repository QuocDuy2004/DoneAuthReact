@extends('Admin.Layout.App')

@section('title', 'Cấu hình telegram')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Cấu hình telegram</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

           
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <form action="{{ route('admin.config.telegram.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="telegram_bot" class="form-label">Đường dẫn telegram dùng để xác thực tài khoản<span class="text-info">Xác thực</span></label>
                                <input class="form-control" type="text" id="telegram_bot" name="telegram_bot" value="{{ DataSite('telegram_bot') }}"
                                placeholder="Nhập đường dẫn bot telegram xác thực tài khoản">
                            </div>
                            <div class="mb-3">
                                <label for="telegram_token" class="form-label">Telegram Token <span class="text-info">Xác thực</span></label>
                                <input class="form-control" type="text" id="telegram_token" name="telegram_token" value="{{ DataSite('telegram_token') }}"
                                placeholder="Nhập token xác thực tài khoản">
                            </div>

                            <div class="mb-3">
                                <label for="telegram_token_tb" class="form-label">Telegram Token <span class="text-info">Thông báo</span></label>
                                <input class="form-control" type="text" id="telegram_token_tb" name="telegram_token_tb" value="{{ DataSite('telegram_token_tb') }}"
                                placeholder="Nhập token thông báo">
                            </div>
                           
                            <div class="mb-3">
                                <label for="telegram_chat_id" class="form-label">ID chat <span class="text-info">Tài khoản</span></label>
                                <input class="form-control" type="text" id="telegram_chat_id" name="telegram_chat_id" value="{{ DataSite('telegram_chat_id') }}"
                                placeholder="Nhập ID chat tài khoản">
                            </div>

                            <div class="mb-3">
                                <label for="balance_telegram" class="form-label">Tiền thường khi liên kết <span class="text-info">thành công</span></label>
                                <input class="form-control" type="text" id="balance_telegram" name="balance_telegram" value="{{ DataSite('balance_telegram') }}"
                                placeholder="Nhập số tiền thưởng">
                            </div>
                            
                            <div class="mb-3">
                                <button class="btn btn-primary col-12">
                                    Cập nhập
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
@endsection
