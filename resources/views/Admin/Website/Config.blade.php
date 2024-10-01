@extends('Admin.Layout.App')

@section('title', 'Cấu hình website')

@section('content')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: General Settings</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Cài đặt chung</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.config.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namesite" class="form-label">Tên website</label>
                                    <input type="text" class="form-control" id="namesite" name="namesite"
                                        value="{{ DataSite('namesite') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Tiêu đề website</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ DataSite('title') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="keyword" class="form-label">Từ khoá tìm kiếm</label>
                                    <input type="text" class="form-control" id="keyword" name="keyword"
                                        value="{{ DataSite('keyword') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả website</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        value="{{ DataSite('description') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image_seo" class="form-label">Image SEO</label>
                                    <input type="text" class="form-control" id="image_seo" name="image_seo"
                                        value="{{ DataSite('image_seo') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="collaborator" class="form-label">Mộc nạp cộng tác viên</label>
                                    <input type="text" class="form-control" id="collaborator" name="collaborator"
                                        value="{{ DataSite('collaborator') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="agency" class="form-label">Mộc nạp đại lý</label>
                                    <input type="text" class="form-control" id="agency" name="agency"
                                        value="{{ DataSite('agency') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="distributor" class="form-label">Mộc nạp nhà phân phối</label>
                                    <input type="text" class="form-control" id="distributor" name="distributor"
                                        value="{{ DataSite('distributor') }}">
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="primary_lang" class="form-label">Ngôn ngữ mặc định</label>
                                    <select class="form-control" id="primary_lang" name="primary_lang">
                                        <option value="vn" selected="">Vietnamese</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="code_tranfer" class="form-label">Nội dung chuyển khoản</label>
                                <input type="text" class="form-control" id="code_tranfer" name="code_tranfer"
                                    value="{{ DataSite('code_tranfer') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="recharge_promotion" class="form-label">Khuyến mãi thêm khi nạp theo %</label>
                                <input type="text" class="form-control" id="recharge_promotion" name="recharge_promotion"
                                    value="{{ DataSite('recharge_promotion') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nameadmin" class="form-label">Tên quản trị viên</label>
                                <input type="text" class="form-control" value="{{ DataSite('nameadmin') }}"
                                    id="nameadmin" name="nameadmin">

                            </div>
                            <div class="col-md-4">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" value="{{ DataSite('facebook') }}"
                                    id="facebook" name="facebook">

                            </div>
                            <div class="col-md-4">
                                <label for="zalo" class="form-label">Zalo</label>
                                <input type="text" class="form-control" value="{{ DataSite('zalo') }}"
                                    id="zalo" name="zalo">

                            </div>
                            <div class="col-md-4">
                                <label for="telegram" class="form-label">Telegram</label>
                                <input type="text" class="form-control" value="{{ DataSite('telegram') }}"
                                    id="telegram" name="telegram">

                            </div>
                            {{-- <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ DataSite('email') }}"
                                    id="email" name="email">

                            </div> --}}
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" value="{{ DataSite('phone') }}"
                                    id="phone" name="phone">

                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="card_discount" class="form-label">Chiết khấu nạp thẻ cào theo %</label>
                                <input type="text" class="form-control" value="{{ DataSite('card_discount') }}"
                                    id="card_discount" name="email">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="card_discount" class="form-label">Mail Host</label>
                                <input type="text" class="form-control" value="{{ DataSite('card_discount') }}"
                                    id="card_discount" name="email">

                            </div>
                            <div class="col-md-4">
                                <label for="card_discount" class="form-label">Mail Port</label>
                                <input type="text" class="form-control" value="{{ DataSite('card_discount') }}"
                                    id="card_discount" name="email">

                            </div>
                            <div class="col-md-4">
                                <label for="mail_username" class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ DataSite('mail_username') }}"
                                    id="mail_username" name="mail_username">

                            </div>
                            <div class="col-md-4">
                                <label for="mail_password" class="form-label">Email Passowrd</label>
                                <input type="password" class="form-control" value="{{ DataSite('mail_password') }}"
                                    id="mail_password" name="mail_password">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="idpage" class="form-label">ID Chat Fanpage Facebook</label>
                                <input type="text" class="form-control" value="{{ DataSite('idpage') }}"
                                    id="idpage" name="idpage">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="card custom-card">
                                    <div class="card-header justify-content-between">
                                        <div class="card-title">Header Code</div>
                                    </div>
                                    <div class="card-body">
            
                                        <div class="mb-3">
                                            <label for="script_header" class="form-label">Code</label>
                                            <textarea class="form-control" name="script_header" id="script_header" rows="10">{{ DataSite('script_header') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card custom-card">
                                    <div class="card-header justify-content-between">
                                        <div class="card-title">Footer Code</div>
                                    </div>
                                    <div class="card-body">
            
                                        <div class="mb-3">
                                            <label for="script_footer" class="form-label">Code</label>
                                            <textarea class="form-control" name="script_footer" id="script_footer" rows="10">{{ DataSite('script_footer') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <!-- Google Client ID -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="google_client_id" class="form-label">Google Client ID</label>
                                    <input type="text" class="form-control" value="{{ DataSite('google_client_id') }}" id="google_client_id" name="google_client_id">
                                </div>
                            </div>
                        
                            <!-- Google Client Secret -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="google_client_secret" class="form-label">Google Client Secret</label>
                                    <input type="text" class="form-control" value="{{ DataSite('google_client_secret') }}" id="google_client_secret" name="google_client_secret">
                                </div>
                            </div>
                        
                            <!-- Google Redirect -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="google_redirect" class="form-label">Google Redirect</label>
                                    <input type="text" class="form-control" value="{{ DataSite('google_redirect') }}" id="google_redirect" name="google_redirect">
                                </div>
                            </div>
                        
                            <!-- Facebook Client ID -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="facebook_client_id" class="form-label">Facebook Client ID</label>
                                    <input type="text" class="form-control" value="{{ DataSite('facebook_client_id') }}" id="facebook_client_id" name="facebook_client_id">
                                </div>
                            </div>
                        
                            <!-- Facebook Client Secret -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="facebook_client_secret" class="form-label">Facebook Client Secret</label>
                                    <input type="text" class="form-control" value="{{ DataSite('facebook_client_secret') }}" id="facebook_client_secret" name="facebook_client_secret">
                                </div>
                            </div>
                        
                            <!-- Facebook Redirect -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="facebook_redirect" class="form-label">Facebook Redirect</label>
                                    <input type="text" class="form-control" value="{{ DataSite('facebook_redirect') }}" id="facebook_redirect" name="facebook_redirect">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <!-- Notice Order Checkbox -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="notice_order" id="notice_order" {{ DataSite('notice_order') == 'on' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notice_order">
                                        Thông báo đơn về Telegram
                                    </label>
                                </div>
                            </div>
                        
                            <!-- Notice Login Checkbox -->
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="notice_login" id="notice_login" {{ DataSite('notice_login') == 'on' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notice_login">
                                        Cảnh báo đăng nhập
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="mb-3 text-end">
                            <button class="btn btn-primary" type="submit">Cập Nhật</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Giảm giá theo cấp bậc (%) - Giá gốc 10đ nhập 10% thì được giảm còn
                            <code>10-(10*10)/100 = 9đ</code>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=rank_discount"
                            method="POST" class="axios-form">
                            <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                autocomplete="off">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="bronze" class="form-label">Rank Đồng</label>
                                    <input type="text" class="form-control" id="bronze" name="bronze"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="silver" class="form-label">Rank Bạc</label>
                                    <input type="text" class="form-control" id="silver" name="silver"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="gold" class="form-label">Rank Vàng</label>
                                    <input type="text" class="form-control" id="gold" name="gold"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="platinum" class="form-label">Rank Bạch Kim</label>
                                    <input type="text" class="form-control" id="platinum" name="platinum"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="diamond" class="form-label">Rank Kim Cương</label>
                                    <input type="text" class="form-control" id="diamond" name="diamond"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="titanium" class="form-label">Rank Titanium</label>
                                    <input type="text" class="form-control" id="titanium" name="titanium"
                                        value="0" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="master" class="form-label">Rank Nhà Phân Phối</label>
                                    <input type="text" class="form-control" id="master" name="master"
                                        value="0" required="">
                                </div>
                            </div>
                            <div class="mb-3 text-end">
                                <button class="btn btn-primary" type="submit">Cập Nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Các mốc tự động lên rank</div>
                    </div>
                    <div class="card-body">
                        <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=rank_level"
                            method="POST" class="axios-form">
                            <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                autocomplete="off">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="bronze" class="form-label">Rank Đồng</label>
                                    <input type="text" class="form-control" id="bronze" name="bronze"
                                        value="0" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="silver" class="form-label">Rank Bạc</label>
                                    <input type="text" class="form-control" id="silver" name="silver"
                                        value="500000" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="gold" class="form-label">Rank Vàng</label>
                                    <input type="text" class="form-control" id="gold" name="gold"
                                        value="1000000" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="platinum" class="form-label">Rank Bạch Kim</label>
                                    <input type="text" class="form-control" id="platinum" name="platinum"
                                        value="1500000" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="diamond" class="form-label">Rank Kim Cương</label>
                                    <input type="text" class="form-control" id="diamond" name="diamond"
                                        value="2000000" required="">
                                </div>
                                <div class="col-md-2">
                                    <label for="titanium" class="form-label">Rank Titanium</label>
                                    <input type="text" class="form-control" id="titanium" name="titanium"
                                        value="0" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="bronze" class="form-label">Rank Đồng</label>
                                    <textarea name="features[bronze]" id="features" class="form-control" rows="3"
                                        placeholder="Mỗi chức năng là 1 dòng"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="silver" class="form-label">Rank Bạc</label>
                                    <textarea name="features[silver]" id="features" class="form-control" rows="3"
                                        placeholder="Mỗi chức năng là 1 dòng"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="gold" class="form-label">Rank Vàng</label>
                                    <textarea name="features[gold]" id="features" class="form-control" rows="3"
                                        placeholder="Mỗi chức năng là 1 dòng"></textarea>
                                </div>

                            </div>
                            <div class="mb-3 text-end">
                                <button class="btn btn-primary" type="submit">Cập Nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Tuỳ chỉnh giao diện</div>
                        </div>
                        <div class="card-body">
                            <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=theme_settings"
                                method="POST" class="default-form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                    autocomplete="off">
                                <div class="mb-3 row">
                                    <div class="col-md-4">
                                        <label for="ladi_name" class="form-label">Mẫu trang giới thiệu</label>
                                        <select name="ladi_name" id="ladi_name" class="form-control">
                                            <option value="">Chọn mẫu</option>
                                            <option value="none">Không sử dụng</option>
                                            <option value="default" selected="">Mặt định</option>
                                            <option value="modern">Hiện đại</option>
                                            <option value="classic">Cổ điển</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="auth_bg" class="form-label">Ảnh nền trang đăng nhập / đăng ký - <a
                                                href="/uploads/23-05-2024/076416a1-9250-4b09-967c-414071878173.jpg"
                                                target="_blank">Xem</a></label>
                                        <input type="file" class="form-control" id="auth_bg" name="auth_bg"
                                            accept="image/*">

                                        <div class="mb-2 mt-2 text-center">
                                            <img src="https://smmpanel-v3.baocms.net/uploads/23-05-2024/076416a1-9250-4b09-967c-414071878173.jpg"
                                                alt="Logo" class="img-fluid" style="max-height: 100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Thông Tin Nạp Tiền</div>
                        </div>
                        <div class="card-body">
                            <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=deposit_info"
                                method="POST" class="axios-form">
                                <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                    autocomplete="off">
                                <div class="mb-3">
                                    <label for="prefix" class="form-label">Cú Pháp</label>
                                    <input type="text" class="form-control" id="prefix" name="prefix"
                                        value="donate " required="">
                                    <small>Khi cấu hình xong, thì nội dung chuyển khoản của bạn là: <span
                                            class="text-danger">donate 1</span></small>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="discount" class="form-label">Khuyến Mãi [+ %]</label>
                                        <input type="text" class="form-control" id="discount" name="discount"
                                            value="10" required="">
                                        <small>% khuyến mãi sẽ được cộng vào số tiền mà khách nạp</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="min_amount" class="form-label">Tối Thiểu</label>
                                        <input type="text" class="form-control" id="min_amount" name="min_amount"
                                            value="0" required="">
                                        <small>Số tiền nạp tối thiểu và để áp dụng khuyến mãi</small>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Quản lý cổng nạp tiền</div>
                        </div>
                        <div class="card-body">
                            <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=deposit_status"
                                method="POST" class="axios-form">
                                <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                    autocomplete="off">
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="card" class="form-label">Thẻ cào</label>
                                        <select name="card" id="card" class="form-control">
                                            <option value="1" selected="">Bật</option>
                                            <option value="0">Tắt</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="crypto" class="form-label">Tiền mã hoá</label>
                                        <select name="crypto" id="crypto" class="form-control">
                                            <option value="1" selected="">Bật</option>
                                            <option value="0">Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="bank" class="form-label">Chuyển khoản ngân hàng</label>
                                        <select name="bank" id="bank" class="form-control">
                                            <option value="1" selected="">Bật</option>
                                            <option value="0">Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 text-center">
                                    <div class="text-danger">Tuỳ chỉnh ẩn hoặc hiện tại thanh menu</div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Thông tin liên hệ</div>
                        </div>
                        <div class="card-body">
                            <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=contact_info"
                                method="POST" class="axios-form">
                                <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                    autocomplete="off">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook"
                                            value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telegram" class="form-label">Telegram</label>
                                        <input type="text" class="form-control" id="telegram" name="telegram"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="phone_no" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone_no" name="phone_no"
                                            value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="">
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Cấu hình Affiliate Program</div>
                        </div>
                        <div class="card-body">
                            <form action="https://smmpanel-v3.baocms.net/admin/settings/general?type=affiliate_config"
                                method="POST" class="axios-form">
                                <input type="hidden" name="_token" value="SK5e3JRIr89tr0oFueltBJgExSe52IPdlXvy82ax"
                                    autocomplete="off">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="min_withdraw" class="form-label">Tối Thiểu</label>
                                        <input type="number" class="form-control" id="min_withdraw" name="min_withdraw"
                                            value="1000">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="max_withdraw" class="form-label">Tối Đa</label>
                                        <input type="number" class="form-control" id="max_withdraw" name="max_withdraw"
                                            value="200000">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="withdraw_status" class="form-label">Trạng Thái</label>
                                        <select class="form-control" id="withdraw_status" name="withdraw_status">
                                            <option value="1" selected="">Bật</option>
                                            <option value="0">Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary" type="submit">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> --}}

          
            <!-- End:: Content -->
        </div>
    </div>
@endsection
