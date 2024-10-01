@extends('Layout.App')
@section('title', 'Cấp bậc tài khoản')

@section('content')
 
<div class="row mb-3">
        <div class="col-md-4 mb-3">
            <div class="card border shadow-none">
                <div class="card-body">
                    <h3 class="fw-bold text-center text-uppercase mt-3">Cộng tác viên</h3>
                    <div class="my-4 py-2 text-center">
                        <img src="/congtacvien.png" alt="Starter Image" height="30">
                    </div>

                    <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center">
                            <h1 class="fw-bold h1 mb-0">{{ number_format(DataSite('collaborator')) }} </h1>
                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                        </div>
                    </div>

                    <ul class="ps-3 pt-4 pb-2 list-ul">
                        <li class="mb-2">
                            Giảm giá dịch vụ, tạo
                            website riêng, giao diện riêng.
                        </li>
                        <li class="mb-2">
                            Không tạo thêm được site cháu, chắt, ...
                        </li>
                    </ul>

                    <a href="/recharge/transfer" class="btn btn-active btn-info">Cộng Tác Viên</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border shadow-none">
                <div class="card-body">
                    <h3 class="fw-bold text-center text-uppercase mt-3">Đại lý</h3>
                    <div class="my-4 py-2 text-center">
                        <img src="//daily.png" alt="Starter Image" height="30">
                    </div>

                    <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center">
                            <h1 class="fw-bold h1 mb-0">{{ number_format(DataSite('agency')) }} </h1>
                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                        </div>
                    </div>

                    <ul class="ps-3 pt-4 pb-2 list-ul">
                        <li class="mb-2">
                            Giảm giá dịch vụ, tạo
                            website riêng, hỗ trợ riêng, giao diện riêng.
                        </li>
                        <li class="mb-2">
                            Có thể tạo thêm được site cháu, chắt, ...
                        </li>
                    </ul>

                    <a href="/recharge/transfer" class="btn btn-active btn-danger">Đại Lý</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border shadow-none">
                <div class="card-body">
                    <h3 class="fw-bold text-center text-uppercase mt-3">Nhà phân phối</h3>
                    <div class="my-4 py-2 text-center">
                        <img src="//nhaphanphoi.png" alt="Starter Image" height="30">
                    </div>

                    <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center">
                            <h1 class="fw-bold h1 mb-0">{{ number_format(DataSite('distributor')) }} </h1>
                            <sub class="h5 pricing-duration mt-auto mb-2">coin</sub>
                        </div>
                    </div>

                    <ul class="ps-3 pt-4 pb-2 list-ul">
                        <li class="mb-2">
                            Giảm giá dịch vụ, tạo
                            website riêng, hỗ trợ riêng, giao diện riêng.
                        </li>
                        <li class="mb-2">
                            Có thể tạo thêm được site cháu, chắt, ...
                        </li>
                    </ul>

                    <a href="/recharge/transfer" class="btn btn-active btn-primary">Nhà Phân Phối</a>
                </div>
            </div>
        </div>
    </div>
@endsection
