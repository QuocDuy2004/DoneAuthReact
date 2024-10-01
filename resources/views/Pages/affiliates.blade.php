@extends('Layout.App')
@section('title', 'Tiếp thị liên kết')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">

                <div class="ms-auto pageheader-btn">
                    <button type="button" class="btn btn-primary btn-wave waves-effect waves-light me-2">
                        <i class="fe fe-plus mx-1 align-middle"></i>Số dư: <span
                            class="user-balance">{{ number_format(Auth::user()->balance) }} ₫</span>
                    </button>
                </div>
            </div>
            <!-- Page Header Close -->


            {{-- <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">0,00 ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Số dư hoa hồng</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-dollar-sign text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">0,00 ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Hoa hồng đã rút</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-wallet text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">1</h2>
                                    <p class="text-white mb-0 text-fixed-white">Đã giới thiệu</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-user-plus fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
            </div>
            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">{{ $totalClicks }}</h2>
                                    <p class="text-white mb-0 text-fixed-white">Lượt clicks</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-share text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-danger img-card box-danger-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">1</h2>
                                    <p class="text-white mb-0 text-fixed-white">Lượt đăng ký</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-users text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-warning img-card box-warning-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font text-fixed-white">0,00 ₫</h2>
                                    <p class="text-white mb-0 text-fixed-white">Tổng tiền nạp</p>
                                </div>
                                <div class="ms-auto"> <i class="fas fa-credit-card text-fixed-white fs-30 me-2 mt-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
            </div> --}}

            {{-- <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Hướng dẫn sử dụng</h3>
                </div>
                <div class="card-body">

                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin giới thiệu</h3>
                        </div>
                        @if (Auth::check())
                            <div class="card-body">
                                <div class="text-danger fw-bold mb-3">
                                    Bạn sẽ nhận được 10% hoa hồng khi người dùng bạn giới thiệu nạp tiền vào tài khoản.
                                </div>
                                <div>
                                    <label for="referral_code" class="form-label">Liên Kết Giới Thiệu:</label>
                                    <div class="input-group">
                                        <input type="text" id="referral_code" name="referral_code"
                                            class="form-control form-control-sm" value="{{ Auth::user()->referral_link }}"
                                            style="border-radius: 5px 0 0 5px" readonly>
                                        <button class="btn btn-primary copy" data-clipboard-target="#referral_code"
                                            style="border-radius: 0 5px 5px 0" type="button">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Yêu cầu rút tiền (Chưa cập nhập xong)</h3>
                        </div>
                        <div class="card-body">
                            <form action="/api/users/affiliates/withdraw" id="form-withdraw" method="POST">
                                <div class="mb-5">
                                    <div class="text-danger fw-bold">
                                        <i>
                                            Số tiền có thể rút: từ <span class="text-primary">1.000,00 ₫</span> đến <span
                                                class="text-success">200.000,00 ₫</span>
                                        </i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="amount" class="form-label">Số Tiền Rút</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        value="1000" required="">
                                </div>
                                <div class="mb-4">
                                    <label for="withdraw_to" class="form-label">Rút Về</label>
                                    <select name="withdraw_to" id="withdraw_to" class="form-control">
                                        <option value="bank">Ngân Hàng</option>
                                        <option value="wallet" selected="">Ví Tài Khoản</option>
                                    </select>
                                </div>
                                <div class="mb-4 group_banking d-none">
                                    <label for="bank_name" class="form-label">Ngân Hàng</label>
                                    <select name="bank_name" id="bank_name" class="form-control">
                                        <option value="">Chọn Ngân Hàng Rút</option>
                                        <option value="ICB">Ngân hàng ICB - VietinBank</option>
                                        <option value="VCB">Ngân hàng VCB - Vietcombank</option>
                                        <option value="BIDV">Ngân hàng BIDV - BIDV</option>
                                        <option value="VBA">Ngân hàng VBA - Agribank</option>
                                        <option value="OCB">Ngân hàng OCB - OCB</option>
                                        <option value="MB">Ngân hàng MB - MBBank</option>
                                        <option value="TCB">Ngân hàng TCB - Techcombank</option>
                                        <option value="ACB">Ngân hàng ACB - ACB</option>
                                        <option value="VPB">Ngân hàng VPB - VPBank</option>
                                        <option value="TPB">Ngân hàng TPB - TPBank</option>
                                        <option value="STB">Ngân hàng STB - Sacombank</option>
                                        <option value="HDB">Ngân hàng HDB - HDBank</option>
                                        <option value="VCCB">Ngân hàng VCCB - VietCapitalBank</option>
                                        <option value="SCB">Ngân hàng SCB - SCB</option>
                                        <option value="VIB">Ngân hàng VIB - VIB</option>
                                        <option value="SHB">Ngân hàng SHB - SHB</option>
                                        <option value="EIB">Ngân hàng EIB - Eximbank</option>
                                        <option value="MSB">Ngân hàng MSB - MSB</option>
                                        <option value="CAKE">Ngân hàng CAKE - CAKE</option>
                                        <option value="Ubank">Ngân hàng Ubank - Ubank</option>
                                        <option value="VTLMONEY">Ngân hàng VTLMONEY - ViettelMoney</option>
                                        <option value="VNPTMONEY">Ngân hàng VNPTMONEY - VNPTMoney</option>
                                        <option value="SGICB">Ngân hàng SGICB - SaigonBank</option>
                                        <option value="BAB">Ngân hàng BAB - BacABank</option>
                                        <option value="PVCB">Ngân hàng PVCB - PVcomBank</option>
                                        <option value="Oceanbank">Ngân hàng Oceanbank - Oceanbank</option>
                                        <option value="NCB">Ngân hàng NCB - NCB</option>
                                        <option value="SHBVN">Ngân hàng SHBVN - ShinhanBank</option>
                                        <option value="ABB">Ngân hàng ABB - ABBANK</option>
                                        <option value="VAB">Ngân hàng VAB - VietABank</option>
                                        <option value="NAB">Ngân hàng NAB - NamABank</option>
                                        <option value="PGB">Ngân hàng PGB - PGBank</option>
                                        <option value="VIETBANK">Ngân hàng VIETBANK - VietBank</option>
                                        <option value="BVB">Ngân hàng BVB - BaoVietBank</option>
                                        <option value="SEAB">Ngân hàng SEAB - SeABank</option>
                                        <option value="COOPBANK">Ngân hàng COOPBANK - COOPBANK</option>
                                        <option value="LPB">Ngân hàng LPB - LienVietPostBank</option>
                                        <option value="KLB">Ngân hàng KLB - KienLongBank</option>
                                        <option value="KBank">Ngân hàng KBank - KBank</option>
                                        <option value="VRB">Ngân hàng VRB - VRB</option>
                                        <option value="SCVN">Ngân hàng SCVN - StandardChartered</option>
                                        <option value="NHB HN">Ngân hàng NHB HN - Nonghyup</option>
                                        <option value="IVB">Ngân hàng IVB - IndovinaBank</option>
                                        <option value="IBK - HCM">Ngân hàng IBK - HCM - IBKHCM</option>
                                        <option value="KBHCM">Ngân hàng KBHCM - KookminHCM</option>
                                        <option value="KBHN">Ngân hàng KBHN - KookminHN</option>
                                        <option value="WVN">Ngân hàng WVN - Woori</option>
                                        <option value="HSBC">Ngân hàng HSBC - HSBC</option>
                                        <option value="CBB">Ngân hàng CBB - CBBank</option>
                                        <option value="IBK - HN">Ngân hàng IBK - HN - IBKHN</option>
                                        <option value="CIMB">Ngân hàng CIMB - CIMB</option>
                                        <option value="DBS">Ngân hàng DBS - DBSBank</option>
                                        <option value="DOB">Ngân hàng DOB - DongABank</option>
                                        <option value="GPB">Ngân hàng GPB - GPBank</option>
                                        <option value="PBVN">Ngân hàng PBVN - PublicBank</option>
                                        <option value="UOB">Ngân hàng UOB - UnitedOverseas</option>
                                        <option value="HLBVN">Ngân hàng HLBVN - HongLeong</option>
                                    </select>
                                </div>
                                <div class="row mb-4 group_banking d-none">
                                    <div class="col-md-6">
                                        <label for="account_number" class="form-label">Số Tài Khoản</label>
                                        <input type="text" class="form-control" id="account_number"
                                            name="account_number" value="" placeholder="Nhập số tài khoản">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="account_name" class="form-label">Chủ Tài Khoản</label>
                                        <input type="text" class="form-control" id="account_name" name="account_name"
                                            value="" placeholder="Nhập tên chủ tài khoản">
                                    </div>
                                </div>
                                <div class="mb-4 group_banking d-none">
                                    <label for="user_note" class="form-label">Ghi Chú</label>
                                    <textarea name="user_note" id="user_note" class="form-control" rows="3"
                                        placeholder="Nhập ghi chú cho admin nếu có"></textarea>
                                </div>
                                <div class="mb-3 text-end">
                                    <button class="btn btn-primary " type="submit">Rút Tiền Ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử giới thiệu</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive df-example demo-table">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input
                                                        type="search" class="form-control form-control-sm"
                                                        placeholder="Search..."
                                                        aria-controls="DataTables_Table_0"></label></div>
                                        </div>
                                    </div>
                                    <div class="row dt-row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-stripped datatable dataTable no-footer"
                                                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                                                <thead class=" border-t border-slate-100 dark:border-slate-800">
                                                    <tr>
                                                        <th class="table-th sorting sorting_desc" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1" aria-sort="descending"
                                                            aria-label="#: activate to sort column ascending"
                                                            style="width: 55.625px;">#</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Tài khoản: activate to sort column ascending"
                                                            style="width: 166px;">Tài khoản</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Tổng Tiền Nạp: activate to sort column ascending"
                                                            style="width: 231.325px;">Tổng Tiền Nạp</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Tiền Hoa Hồng: activate to sort column ascending"
                                                            style="width: 234.538px;">Tiền Hoa Hồng</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Thời Gian Tạo: activate to sort column ascending"
                                                            style="width: 280.913px;">Thời Gian Tạo</th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                                                    <tr class="odd">
                                                        <td class="table-td sorting_1">1</td>
                                                        <td class="table-td">bao***</td>
                                                        <td class="table-td">0,00 ₫</td>
                                                        <td class="table-td">0,00 ₫</td>
                                                        <td class="table-td">2024-05-22 22:40:12</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                                aria-live="polite">Showing 1 to 1 of 1 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_0_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled"
                                                        id="DataTables_Table_0_previous"><a
                                                            aria-controls="DataTables_Table_0" aria-disabled="true"
                                                            role="link" data-dt-idx="previous" tabindex="-1"
                                                            class="page-link">Previous</a></li>
                                                    <li class="paginate_button page-item active"><a href="#"
                                                            aria-controls="DataTables_Table_0" role="link"
                                                            aria-current="page" data-dt-idx="0" tabindex="0"
                                                            class="page-link">1</a></li>
                                                    <li class="paginate_button page-item next disabled"
                                                        id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0"
                                                            aria-disabled="true" role="link" data-dt-idx="next"
                                                            tabindex="-1" class="page-link">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử giao dịch</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive df-example demo-table overflow-auto">
                                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="DataTables_Table_1_filter" class="dataTables_filter"><label><input
                                                        type="search" class="form-control form-control-sm"
                                                        placeholder="Search..."
                                                        aria-controls="DataTables_Table_1"></label></div>
                                        </div>
                                    </div>
                                    <div class="row dt-row">
                                        <div class="col-sm-12">
                                            <table
                                                class="table table-bordered table-stripped text-nowrap datatable dataTable no-footer"
                                                id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                                                <thead>
                                                    <tr>
                                                        <th class="table-th sorting sorting_desc" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" aria-sort="descending"
                                                            aria-label="#: activate to sort column ascending"
                                                            style="width: 10.525px;">#</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Mã Giao Dịch: activate to sort column ascending"
                                                            style="width: 94.6875px;">Mã Giao Dịch</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Số Tiền: activate to sort column ascending"
                                                            style="width: 54.75px;">Số Tiền</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Số Dư Trước: activate to sort column ascending"
                                                            style="width: 87.1375px;">Số Dư Trước</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Số Dư Sau: activate to sort column ascending"
                                                            style="width: 74.2625px;">Số Dư Sau</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Giao Dịch: activate to sort column ascending"
                                                            style="width: 70.4125px;">Giao Dịch</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Trạng Thái: activate to sort column ascending"
                                                            style="width: 75.8px;">Trạng Thái</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Tài Khoản: activate to sort column ascending"
                                                            style="width: 71.1625px;">Tài Khoản</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Ghi Chú: activate to sort column ascending"
                                                            style="width: 58.125px;">Ghi Chú</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Hệ Thống: activate to sort column ascending"
                                                            style="width: 69.3px;">Hệ Thống</th>
                                                        <th class="table-th sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Thời Gian: activate to sort column ascending"
                                                            style="width: 69.4375px;">Thời Gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                    <tr class="odd">
                                                        <td valign="top" colspan="11" class="dataTables_empty">No
                                                            data available in table</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                                aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_1_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled"
                                                        id="DataTables_Table_1_previous"><a
                                                            aria-controls="DataTables_Table_1" aria-disabled="true"
                                                            role="link" data-dt-idx="previous" tabindex="-1"
                                                            class="page-link">Previous</a></li>
                                                    <li class="paginate_button page-item next disabled"
                                                        id="DataTables_Table_1_next"><a aria-controls="DataTables_Table_1"
                                                            aria-disabled="true" role="link" data-dt-idx="next"
                                                            tabindex="-1" class="page-link">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(() => {
      $('#withdraw_to').change(function() {
        if ($(this).val() == 'bank') {
          $('.group_banking').removeClass('d-none');
        } else {
          $('.group_banking').addClass('d-none');
        }
      })
      $("#withdraw_to").trigger('change')

      $("#form-withdraw").submit(async e => {
        e.preventDefault();

        const action = $(e.target).attr('action'),
          button = $(e.target).find('button[type="submit"]')
        payload = $formDataToPayload(new FormData(e.target));

        const confirm = await Swal.fire({
          title: 'Xác Nhận',
          html: `Bạn muốn rút <b>${$formatNumber(payload.amount)} VNĐ</b> về <b>${payload.withdraw_to === 'bank' ? 'ngân hàng' : 'website'}</b> đúng không?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Xác Nhận',
          cancelButtonText: 'Hủy',
        })

        if (!confirm.isConfirmed) return

        if (payload.amount < 1000) {
          return Swal.fire('Thất Bại', `Số tiền rút tối thiểu là 1,000 VNĐ`, 'error')
        }

        if (payload.amount > 200000) {
          return Swal.fire('Thất Bại', `Số tiền rút tối đa là 200,000 VNĐ`, 'error')
        }

        $setLoading(button)

        axios.post(action, payload).then(({
          data: result
        }) => {
          Swal.fire('Thành Công', result.message, 'success').then(() => location.reload())
        }).catch(e => {
          Swal.fire('Thất Bại', $catchMessage(e), 'error')
        }).finally(() => {
          $removeLoading(button)
        })
      })
    })
  </script>
@endsection
