@extends('Admin.Layout.App')

@section('title', 'Trang chủ')

@section('content')



    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Admin: Dashboard</h1>
                <div class="ms-md-1 ms-0">

                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Alert Component -->
            <!-- Alert Component Close -->

            <!-- Start:: Content -->
            <style>
                .card-stats h3 {
                    color: #9A3B3B;
                    font-size: 36px;
                }

                .card-stats h6 {
                    color: #9A3B3B;
                    font-size: 18px;
                }
            </style>
            <section>
                <div class="mb-3 alert alert-secondary alert-dismissible fade show custom-alert-icon shadow-sm"
                    role="alert">
                    <h5>SMMPanel-V2 Version: <strong style="color:blue;">1057</strong></h5>
                    <small>Hệ thống sẽ tự động cập nhật phiên bản mới khi bạn truy cập trang này</small>
                    <br><br>
                    <h6>Giấy phép kích hoạt website của bạn là: <strong style="color:red;"
                            id="copyKey">d474d460a4547faacda564c2a9a8d8f4</strong>
                        <button class="btn btn-info btn-sm shadow-sm btn-wave copy waves-effect waves-light"
                            data-clipboard-target="#copyKey" onclick="copy()">Copy</button>
                    </h6>
                    <small>Vui lòng bảo mật giấy phép của bạn, chỉ cung cấp cho <strong>CMSNT</strong> khi cần hỗ
                        trợ.</small>
                    <br>
                    <hr>

                    <p class="text-danger">Những thay đổi trong phiên bản này:</p>
                    <ul>
                        <li class="fw-bold text-blue">- Cho phép thay đổi tên Developer và link</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                             class="fa fa-x"></i></button>
                </div>
                <h5>Thống Kê Thành Viên</h5>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-danger rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng thành viên</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_user) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-primary rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Đăng ký hôm nay</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_user_today) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-success rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng số dư</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_balance) }} ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-warning rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng tiền nạp</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_recharge) }} ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Nạp Hôm Nay</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">0,00 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Nạp Tháng 08/2024</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">0,00 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Thống Kê Đơn Hàng</h5>
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-danger rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng Đơn Hàng</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_order) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-danger rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Đơn hàng hôm nay</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_order_today) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-success rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng thanh toán</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">0,00 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Đơn hàng tháng {{ $currentMonth }}</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_order_month) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng nạp tháng {{ $currentMonth }}</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_recharge_month) }} đ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tiêu thụ tháng {{ $currentMonth }}</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_deduct_month) }} đ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-primary rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Đơn Hàng Tuần Này</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-warning rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Đơn hàng chờ xử lý</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">8</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Thống Kê Lợi Nhuận</h5>
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-success rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng Doanh Thu</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">124.928,31 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-warning rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tổng Lợi Nhuận Tháng {{ $currentMonth }}</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($lai) }} ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-info rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Doanh thu tháng 08/2024</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">637,50 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-primary rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Lợi nhuận tháng 08/2024</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">212,50 ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-warning rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Tiêu thụ hôm nay</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_deduct_today) }} ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2 col-sm-6">
                        <div class="card custom-card border-top-card border-top-danger rounded-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="fs-14 fw-semibold mb-2">Nạp hôm nay</p>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                                        <h4 class="mb-0 fw-semibold">{{ number_format($total_recharge_today) }} ₫</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <section class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card shadow">
                                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                                        PHÂN TÍCH ĐƠN HÀNG
                                        <span class="ribbon-inner bg-default"></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3" id="order-statistics">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card shadow">
                                <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                                    <div class="ribbon-label text-uppercase fw-bold bg-default">
                                        PHÂN TÍCH DOANH THU
                                        <span class="ribbon-inner bg-default"></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="myChart"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endsection
            @section('script')
                <script>
                    createDataTable('#history', '{{ route('admin.list', 'history-user-today') }}', [{
                            data: 'id',
                        },
                        {
                            data: 'username',
                        },
                        {
                            data: 'action',
                            render: function(data) {
                                return `<span class="text-primary">` + data + `</span>`
                            }
                        },

                        {
                            data: 'old_data',
                            render: function(data) {
                                return `<span class="text-primary">` + formatNumber(parseInt(data)) + `</span>`
                            }
                        },
                        {
                            data: 'data',
                            render: function(data) {
                                return `<span class="text-danger">` + formatNumber(data) + `</span>`
                            }
                        },
                        {
                            data: 'new_data',
                            render: function(data) {
                                return `<span class="text-success">` + formatNumber(parseInt(data)) + `</span>`
                            }
                        },
                        {
                            data: 'description',
                        },
                        {
                            data: 'created_at',
                        },
                    ])
                </script>
                <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
                <script>
                    var options_pie = {
                        series: [{{ $order_completed }}, {{ $order_pending_order }}, {{ $order_active }},
                            {{ $order_suspended }}, {{ $order_failed }}, {{ $order_cancelled }}
                        ],
                        chart: {
                            fontFamily: '"Nunito Sans", sans-serif',
                            width: 480,
                            type: "pie",
                        },
                        colors: ["var(--bs-success)", "var(--bs-info)", "var(--bs-primary)", "var(--bs-secondary)",
                            "var(--bs-warning)",
                            "var(--bs-danger)"
                        ],
                        labels: ["Completed", "Pending", "Active", "Partial", "Error", "Cancel"],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200,
                                },
                                legend: {
                                    position: "bottom",
                                },
                            },
                        }, ],
                        legend: {
                            labels: {
                                colors: ["#a1aab2"],
                            },
                        },
                    }

                    var chart_order = new ApexCharts(document.querySelector("#order-statistics"), options_pie);
                    chart_order.render();

                    var options_line = {
                        series: [{
                            name: "Lượt truy cập",
                            data: [10, 90, 35, 51, 49, 62, 69, 91, 200],
                        }, ],
                        chart: {
                            height: 350,
                            type: "line",
                            fontFamily: '"Nunito Sans",sans-serif',
                            zoom: {
                                enabled: false,
                            },
                            toolbar: {
                                show: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        colors: ["var(--bs-primary)"],
                        stroke: {
                            curve: "straight",
                        },
                        grid: {
                            row: {
                                colors: ["rgba(0,0,0,0.2)", "transparent"], // takes an array which will be repeated on columns
                                opacity: 0.5,
                            },
                            borderColor: "transparent",
                        },
                        xaxis: {
                            categories: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                            ],
                            labels: {
                                style: {
                                    colors: [
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                    ],
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: [
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                        "#a1aab2",
                                    ],
                                },
                            },
                        },
                        tooltip: {
                            theme: "dark",
                        },
                    };

                    var chart_basic = new ApexCharts(document.querySelector("#traffic-website"), options_line);
                    chart_basic.render();
                </script>
            @endsection
