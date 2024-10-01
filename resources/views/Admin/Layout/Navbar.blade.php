<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="/admin/dashboard" class="header-logo">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-logo">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-logo">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-dark">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-dark">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-white">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -8px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 8px 0px 80px;">

                            <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                                <div class="slide-left d-none" id="slide-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg>
                                </div>
                                <ul class="main-menu" style="margin-left: 0px; margin-right: 0px;">
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Main</span></li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.dashboard') }}" class="side-menu__item ">
                                            <i class="bx bx-home side-menu__icon"></i>
                                            <span class="side-menu__label">Bảng Điều Khiển</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Services &amp;
                                            Products</span></li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide has-submenu">
                                        <a href="#" class="side-menu__item">
                                            <i class="bx bx-data side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý Dịch Vụ</span>
                                            <i class="bx bx-chevron-right submenu-toggle"></i>
                                            <!-- Thêm biểu tượng mũi tên với lớp 'submenu-toggle' -->
                                        </a>
                                        <ul class="side-menu submenu">
                                            <!-- Check domain to display additional menu items -->
                                            @if (getDomain() == env('PARENT_SITE'))
                                                <!-- Add Social Media Service -->
                                                <li class="slide">
                                                    <a class="menu-link" href="{{ route('admin.service.new.social') }}">
                                                        <i class="bx bx-plus side-menu__icon"></i>
                                                        <span class="side-menu__label">Thêm dịch vụ MXH</span>
                                                    </a>
                                                </li>
                                                <!-- Add New Service -->
                                                <li class="slide">
                                                    <a class="menu-link" href="{{ route('admin.service.new') }}">
                                                        <i class="bx bx-plus side-menu__icon"></i>
                                                        <span class="side-menu__label">Thêm dịch vụ</span>
                                                    </a>
                                                </li>
                                                <li class="slide">
                                                    <a class="menu-link" href="{{ route('admin.sync.log') }}">
                                                        <i class="bx bx-plus side-menu__icon"></i>
                                                        <span class="side-menu__label">Thông tin đồng bộ</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <!-- Server List -->
                                            <li class="slide">
                                                <a class="menu-link" href="{{ route('admin.server.list') }}">
                                                    <i class="bx bx-server side-menu__icon"></i>
                                                    <span class="side-menu__label">Danh sách máy chủ</span>
                                                </a>
                                            </li>
                                            <!-- Server Pricing -->
                                            <li class="slide">
                                                <a class="menu-link" href="{{ route('admin.server.price') }}">
                                                    <i class="bx bx-dollar side-menu__icon"></i>
                                                    <span class="side-menu__label">Chỉnh giá máy chủ</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>



                                    <style>
                                        /* Biểu tượng mũi tên */
                                        .submenu-toggle {
                                            font-size: 16px;
                                            transition: transform 0.3s;
                                            /* Hiệu ứng xoay mượt mà */
                                            margin-left: auto;
                                        }

                                        /* Biểu tượng mũi tên hướng sang phải khi menu đóng */
                                        .submenu-toggle {
                                            transform: rotate(0deg);
                                            /* Mũi tên hướng xuống dưới */
                                        }

                                        /* Biểu tượng mũi tên xoay 45 độ khi menu mở */
                                        .side-menu.submenu.active~.submenu-toggle {
                                            transform: rotate(90deg);
                                            /* Mũi tên xoay 45 độ */
                                        }

                                        /* Hiển thị menu con */
                                        .side-menu.submenu {
                                            display: none;
                                            list-style: none;
                                            padding-left: 20px;
                                        }

                                        /* Hiển thị khi có lớp 'active' */
                                        .side-menu.submenu.active {
                                            display: block;
                                        }
                                    </style>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var menuItems = document.querySelectorAll('.slide.has-submenu > a');

                                            menuItems.forEach(function(menuItem) {
                                                menuItem.addEventListener('click', function(event) {
                                                    event.preventDefault();
                                                    var parent = menuItem.parentElement;
                                                    var submenu = parent.querySelector('.submenu');
                                                    var toggleIcon = menuItem.querySelector('.submenu-toggle');

                                                    if (submenu) {
                                                        submenu.classList.toggle('active');
                                                        toggleIcon.style.transform = submenu.classList.contains('active') ?
                                                            'rotate(90deg)' : 'rotate(0deg)';
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <!-- End::slide -->

                                    <li class="slide">
                                        <a href="{{ route('admin.history.order') }}" class="side-menu__item ">
                                            <i class="bx bxs-basket side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý Đơn hàng</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.user.list') }}" class="side-menu__item ">
                                            <i class="bx bx-user side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý Người dùng</span>
                                        </a>
                                    </li>

                                    <li class="slide">
                                        <a href="{{ route('admin.tickets.list') }}" class="side-menu__item ">
                                            <i class="bx bx-ticket side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý báo cáo</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                    <li class="slide__category"><span class="category-name">Tài nguyên</span></li>
                                    <li class="slide has-submenu">
                                        <a href="#" class="side-menu__item">
                                            <i class="bx bx-data side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý tai nguyên</span>
                                            <i class="bx bx-chevron-right submenu-toggle"></i>
                                            <!-- Thêm biểu tượng mũi tên với lớp 'submenu-toggle' -->
                                        </a>
                                        <ul class="side-menu submenu">
                                            <!-- Server List -->
                                            <li class="slide">
                                                <a class="menu-link" href="{{ route('admin.category.new') }}">
                                                    <i class="bx bx-server side-menu__icon"></i>
                                                    <span class="side-menu__label">Thêm thương hiệu</span>
                                                </a>
                                            </li>
                                            <!-- Server Pricing -->
                                            <li class="slide">
                                                <a class="menu-link"
                                                    href="{{ route('admin.taikhoan.tainguyen.new') }}">
                                                    <i class="bx bx-dollar side-menu__icon"></i>
                                                    <span class="side-menu__label">Thêm tài nguyên</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Datas</span></li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.history.card') }}" class="side-menu__item ">
                                            <i class="bx bx-credit-card side-menu__icon"></i>
                                            <span class="side-menu__label">Lịch Sử Nạp Thẻ</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <li class="slide">
                                        <a href="{{ route('admin.history.recharge') }}" class="side-menu__item ">
                                            <i class="bx bx-credit-card side-menu__icon"></i>
                                            <span class="side-menu__label">Lịch Sử Chuyển Khoản</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.history.user') }}" class="side-menu__item ">
                                            <i class="bx bx-notification side-menu__icon"></i>
                                            <span class="side-menu__label">Lịch Sử Hoạt Động</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.recharge.config') }}" class="side-menu__item ">
                                            <i class="bx bx-qr side-menu__icon"></i>
                                            <span class="side-menu__label">Tài Khoản Ngân Hàng [Auto]</span>
                                        </a>
                                    </li>
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">Website Setting</span>
                                    </li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.website.config') }}" class="side-menu__item ">
                                            <i class="bx bx-cog side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Hệ Thống</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.website.config.landing') }}"
                                            class="side-menu__item ">
                                            <i class="bx bx-cog side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Landing</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.config.telegram') }}" class="side-menu__item ">
                                            <i class="bx bx-cog side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Telegram</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.website.theme') }}" class="side-menu__item ">
                                            <i class="bx bxs-component side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Logo</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="#" class="side-menu__item ">
                                            <i class="bx bxs-component side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Giao Diện</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('admin.recharge.add') }}" class="side-menu__item ">
                                            <i class="bx bxs-bank side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Nạp tiền</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.website-child.list') }}" class="side-menu__item ">
                                            <i class="bx bx-cog side-menu__icon"></i>
                                            <span class="side-menu__label">Cài Đặt Website con</span>
                                        </a>
                                    </li>
                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('providers.index') }}" class="side-menu__item ">
                                            <i class="bx bx-link-external side-menu__icon"></i>
                                            <span class="side-menu__label">Cấu Hình API Key</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                    <li class="slide">
                                        <a href="{{ route('admin.website.captcha') }}" class="side-menu__item ">
                                            <i class="bx bx-link-external side-menu__icon"></i>
                                            <span class="side-menu__label">Cấu Hình Captcha</span>
                                        </a>
                                    </li>

                                    {{-- <li class="slide">
                                        <a href="{{ route('admin.website.auto') }}"
                                            class="side-menu__item ">
                                            <i class="bx bx-link-external side-menu__icon"></i>
                                            <span class="side-menu__label">Cấu Hình Auto</span>
                                        </a>
                                    </li> --}}
                                    <li class="slide">
                                        <a href="{{ route('admin.currency.manager') }}" class="side-menu__item ">
                                            <i class="bx bx-link-external side-menu__icon"></i>
                                            <span class="side-menu__label">Quản lý tiền tệ</span>
                                        </a>
                                    </li>
                                    <!-- Start::slide -->



                                </ul>
                                <div class="slide-right d-none" id="slide-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg>
                                </div>
                            </nav>
                            <!-- End::nav -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1144px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 422px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
    <!-- End::main-sidebar -->

</aside>
@yield('content')
