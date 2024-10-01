@extends('Layout.App')

@section('title', 'Terms & Service')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">

                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fe fe-plus mx-1 align-middle"></i>Số dư: <span class="user-balance">{{ number_format(Auth::user()->balance) }} ₫</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->

            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Điều khoản sử dụng dịch vụ</h3>
                </div>
                <div class="card-body">
                    <p><strong>QUY ĐỊNH VỀ XU</strong></p>

                    <p>- Để có xu người dùng có thể donate để nhận số lượng xu tương đương giá trị đã thỏa thuận.</p>

                    <p>- Hình thức donate để lấy xu là hoàn toàn tự nguyện, không phải là dịch vụ trao đổi mua bán.</p>

                    <p>- Khi donate người dùng sẽ nhận được xu và số lượng xu này không thể quy đổi ngược lại.</p>

                    <p><strong>QUY ĐỊNH SEEDING</strong></p>

                    <p>- Người dùng có thể dùng xu đã donate để trao đổi các dịch vụ seeding có trên web.</p>

                    <p>- Mỗi dịch vụ có các quy định khác nhau, có thể xem chi tiết tại thông tin kênh từng dịch vụ trước
                        khi sử dụng.</p>

                    <p>- Các kênh seeding có quy định và các thức hoạt động có thể thay đổi theo thời gian.</p>

                    <p><strong>ĐỐI VỚI BÊN DONATE XU</strong></p>

                    <p>- Không seeding các nội dung vi phạm pháp luật, chính trị, đồi truỵ,... Nếu vi phạm, bạn sẽ bị khoá
                        tài khoản, trừ hết xu và chịu hoàn toàn trách nhiệm trước pháp luật.</p>

                    <p>- Có thể báo cáo các dịch vụ khi dùng xu trao đổi nhưng không đạt được hiệu quả mong muốn tại mục hỗ
                        trợ.</p>

                    <p><strong>ĐỐI VỚI BÊN NHẬN DONATE XU</strong></p>

                    <p>- Chúng tôi có trách nhiệm hoàn thành các nội dung seeding được yêu cầu.</p>

                    <p>- Tiếp nhận xử lý các lỗi do người dùng báo cáo.</p>

                    <p>- Từ chối hỗ trợ các ID có nội dung seeding vi phạm hoặc không thực hiện theo hướng dẫn.</p>

                    <p><strong>QUY ĐỊNH, CHÍNH SÁCH BẢO MẬT</strong></p>

                    <p>- Chúng tôi thu thập tất cả các thông tin người dùng như: số điện thoại, email, tài khoản ngân hàng,
                        IP, các ID và nội dung seeding,...</p>

                    <p>- Mọi thông tin người dùng sẽ được bảo mật.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
