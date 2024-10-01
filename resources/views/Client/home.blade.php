@extends('Layout.App')

@section('title', 'Trang chủ')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">

            </div>
            <!-- Page Header Close -->

            <div class="alert alert-primary">
                <p><span style="color:#c0392b;">Thông báo:</span><br>
                    - Nhóm zalo :&nbsp;<a href="https://zalo.me/g/">https://zalo.me/g/</a><br>
                    - Vui lòng nhập linh và bật công khai những mxh cần buff<br>
                    - Vui lòng không tạo đơn cho những bài viết vi phạm pháp luật<br>
                    - Hãy kéo xuống phần dịch vụ để xem thêm những dịch vụ hot của chúng tôi</p>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row total-sales-card-section">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="fw-normal fs-14">{{ __('current_balance') }}</h6>
                                            <h3 class="mb-2 number-font fs-24">₫{{ number_format($currentBalance) }}</h3>
                                            <p class="text-muted mb-0">
                                                <span
                                                    class="{{ $balanceChangePercentage >= 0 ? 'text-success' : 'text-danger' }}">
                                                    <i
                                                        class="ri-arrow-{{ $balanceChangePercentage >= 0 ? 'up' : 'down' }}-s-line bg-{{ $balanceChangePercentage >= 0 ? 'success' : 'danger' }} text-white rounded-circle fs-13 p-0 fw-semibold align-bottom"></i>
                                                    {{ number_format($balanceChangePercentage, 2) }}%
                                                </span> vào tháng trước
                                            </p>
                                        </div>
                                        <div class="col col-auto mt-2">
                                            <div class="d-flex justify-content-center align-items-center counter-icon bg-{{ $balanceChangePercentage >= 0 ? 'success' : 'danger' }}-gradient box-shadow-{{ $balanceChangePercentage >= 0 ? 'success' : 'danger' }} rounded-circle ms-auto mb-0"
                                                style="width: 50px; height: 50px;">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="fw-normal fs-14">{{ __('total_monthly_deposit') }}</h6>
                                            <h3 class="mb-2 number-font fs-24">
                                                ₫{{ number_format($totalDepositCurrentMonth) }}
                                            </h3>
                                            <p class="text-muted mb-0">
                                                <span
                                                    class="{{ $depositChangePercentage >= 0 ? 'text-success' : 'text-danger' }}">
                                                    <i
                                                        class="ri-arrow-{{ $depositChangePercentage >= 0 ? 'up' : 'down' }}-s-line bg-{{ $depositChangePercentage >= 0 ? 'success' : 'danger' }} text-white rounded-circle fs-13 p-0 fw-semibold align-bottom"></i>
                                                    {{ number_format($depositChangePercentage, 2) }}%
                                                </span> vào tháng trước
                                            </p>
                                        </div>
                                        <div class="col col-auto mt-2">
                                            <div class="d-flex justify-content-center align-items-center counter-icon bg-{{ $depositChangePercentage >= 0 ? 'success' : 'danger' }}-gradient box-shadow-{{ $depositChangePercentage >= 0 ? 'success' : 'danger' }} rounded-circle ms-auto mb-0"
                                                style="width: 50px; height: 50px;">
                                                <i class="fa-solid fa-arrow-trend-up"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="fw-normal fs-14">{{ __('total_order') }}</h6>
                                            <h3 class="mb-2 number-font fs-24">
                                                {{ $totalOrdersCurrentMonth }}
                                            </h3>
                                            <p class="text-muted mb-0">
                                                <span
                                                    class="{{ $ordersChangePercentage >= 0 ? 'text-success' : 'text-danger' }}">
                                                    <i
                                                        class="ri-arrow-{{ $ordersChangePercentage >= 0 ? 'up' : 'down' }}-s-line bg-{{ $ordersChangePercentage >= 0 ? 'success' : 'danger' }} text-white rounded-circle fs-13 p-0 fw-semibold align-bottom"></i>
                                                    {{ number_format($ordersChangePercentage, 2) }}%
                                                </span> vào tháng trước
                                            </p>
                                        </div>
                                        <div class="col col-auto mt-2">
                                            <div class="d-flex justify-content-center align-items-center counter-icon bg-{{ $ordersChangePercentage >= 0 ? 'success' : 'danger' }}-gradient box-shadow-{{ $ordersChangePercentage >= 0 ? 'success' : 'danger' }} rounded-circle ms-auto mb-0"
                                                style="width: 50px; height: 50px;">
                                                <i class="fa-solid fa-box"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row" data-select2-id="select2-data-115-kwsl">
                <div class="col-12 col-lg-8 col-md-8 col-sm-12" data-select2-id="select2-data-114-hwk4">
                    <div class="card custom-card">
                        @inject('service_social', 'App\Models\ServiceSocial')
                        @inject('service', 'App\Models\Service')

                        @foreach ($service_social->where('domain', env('PARENT_SITE'))->where('status', 'show')->get() as $item)
                            <h1 class="text-center text-dark">Dịch vụ {{ $item->name }}</h1>
                            <div class="grid-container">
                                @foreach ($service->where('domain', env('PARENT_SITE'))->where('status', 'show')->where('service_social', $item->slug)->get() as $sv)
                                    <div class="btn btn-light">
                                        <a
                                            href="{{ route('service.view', ['social' => $item->slug, 'service' => $sv->slug]) }}">
                                            <img src="https://2mxh.com/assets/images/category/facebook/like-post.svg"
                                                alt="{{ $sv->name }}">
                                            <h5 class="text-dark">{{ $sv->name }}</h5>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                    <div class="card overflow-hidden border-0 p-0 text-nowrap">
                        <div class="min-vh-25 p-4" style="background: linear-gradient(to right, #4361ee, #160f6b);">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <div
                                    class="d-flex align-items-center rounded-pill bg-opacity-50 bg-dark p-1 text-white fw-semibold pe-3">
                                    <img class="rounded-circle border-white me-2"
                                        src="/uploads/01-07-2024/985b204a-2bb2-41ea-b15b-35f83089afb8.jpg" alt="image"
                                        style="height: 2rem; width: 2rem; object-cover;">
                                    {{ Auth::user()->name }}
                                </div>
                                <a href="/transfer"
                                    class="btn btn-dark d-flex align-items-center justify-content-center rounded-circle p-0"
                                    style="height: 2.25rem; width: 2.25rem;">
                                    <svg class="m-auto" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        style="height: 1.5rem; width: 1.5rem;">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between ">
                                <p class="h5 mb-0 text-dark">{{ __('balance') }}</p>

                                @if (Auth::user()->type_balance == 'VND')
                                    <h5 class="h4 mb-0 ms-auto text-white">
                                        <span><span class="user-balance"> {{ $balance_s }}
                                                ({{ $currency_symbol }})</span></span>
                                    </h5>
                                @else
                                    <h5 class="h4 mb-0 ms-auto text-white">
                                        <span><span class="user-balance"> {{ $balance_s }}
                                                {{ $currency_symbol }}</span></span>
                                    </h5>
                                @endif


                            </div>
                        </div>
                        <div class="row g-2 px-4" style="margin-top: -20px">
                            <div class="col-6">
                                <div class="rounded bg-white p-3 shadow-sm dark-bg">
                                    <span class="d-flex align-items-center justify-content-between text-dark">
                                        Tổng nạp
                                        <svg class="text-success" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="height: 1rem; width: 1rem;">
                                            <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <div class="btn w-100 bg-light text-dark fw-semibold border-0 py-1 mt-2">
                                        ₫{{ number_format(Auth::user()->total_recharge, 2) }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rounded bg-white p-3 shadow-sm dark-bg">
                                    <span class="d-flex align-items-center justify-content-between text-dark">
                                        Tổng tiêu
                                        <svg class="text-danger" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="height: 1rem; width: 1rem;">
                                            <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <div class="btn w-100 bg-light text-dark fw-semibold border-0 py-1 mt-2">
                                        ₫{{ number_format(Auth::user()->total_deduct, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3>{{ __('new_message') }}</h3>
                    </div>
                    <div class="new-feeds">
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('new_message') }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p style="text-align:center;">Vui Lòng Kéo Xuống Ở Phần Dịch Vụ để xem nhiều dịch vụ cần
                                    thiết
                                    hơn</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            @if (Auth::check())
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($chart['labels']),
                        datasets: [{
                                label: 'Nạp tiền',
                                data: @json($chart['recharge']),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Mua hàng',
                                data: @json($chart['orders']),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                }
                            }]
                        }
                    }
                });
            @endif
        </script>
        <script>
            window.onload = function() {
                var modalLastClosed1 = localStorage.getItem('modalLastClosed');
                var delayTime = 5000 * 1000;
                if (!modalLastClosed1 || Date.now() - modalLastClosed1 > delayTime) {
                    $('#bs-example-modal-md').modal('show');
                }
            };

            $('#close-hourly').on('click', function() {
                localStorage.setItem('modalLastClosed', Date.now());
            });
        </script>
    @endsection
