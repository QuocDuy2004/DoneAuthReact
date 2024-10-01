<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        @if (DataSite('logo'))
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-logo" width="200">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-logo" width="38">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-dark" width="200">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-dark" width="38">
            <img src="{{ DataSite('logo') }}" alt="logo" class="desktop-white" width="200">
            <img src="{{ DataSite('logo') }}" alt="logo" class="toggle-white" width="38">
        </a>
        @endif
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px 0px 80px;">

                            <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                                <div class="slide-left d-none" id="slide-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg>
                                </div>
                                @if (Auth::user()->position == 'admin')
                                    <li class="slide">
                                        <a href="{{ route('admin.dashboard') }}" class="side-menu__item ">

                                            <i class="fa-brands fa-slack side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('admin_dashboard') }}</span>
                                        </a>
                                    </li>
                                @endif
                                <ul class="main-menu" style="margin-left: 0px; margin-right: 0px;">
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span class="category-name">{{ __('info_area') }}</span>
                                    </li>
                                
                                    <li class="slide">
                                        <a href="/home" class="side-menu__item">
                                            <i class="fa fa-shopping-cart side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('home') }}</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('pages.services') }}" class="side-menu__item ">

                                            <i class="fas fa-server side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('service_list') }}</span>
                                        </a>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('create.website') }}" class="side-menu__item ">

                                            <i class="fa-solid fa-globe side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('create_website') }}</span>
                                        </a>
                                    </li>
                                    <li class="slide has-sub ">
                                        <a href="javascript:void(0);" class="side-menu__item ">
                                            <i class="fa fa-credit-card side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('recharge') }}</span>
                                            <i class="fa-solid fa-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1 mega-menu" data-popper-placement="bottom"
                                            style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(127.2px, 272px, 0px);">
                                            <li class="slide side-menu__label1">
                                                <a href="javascript:void(0)">{{ __('recharge') }}</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{ route('recharge.card') }}"
                                                    class="side-menu__item ">{{ __('recharge_card') }}</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{ route('recharge.transfer') }}"
                                                    class="side-menu__item ">{{ __('recharge_transfer') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide has-sub ">
                                        <a href="javascript:void(0);" class="side-menu__item ">
                                            <i class="fa-regular fa-user side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('account') }}</span>
                                            <i class="fa-solid fa-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1 mega-menu" data-popper-placement="bottom"
                                            style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(127.2px, 316px, 0px);">
                                            <li class="slide side-menu__label1">
                                                <a href="javascript:void(0)">{{ __('account') }}</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{ route('profile') }}"
                                                    class="side-menu__item ">{{ __('profile') }}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="slide">
                                        <a href="{{ route('user.history') }}" class="side-menu__item ">
                                            <i class="fa fa-list side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('account_activity') }}</span>
                                        </a>
                                    </li>
                                    <li class="slide__category"><span
                                            class="category-name">{{ __('service_area') }}</span>
                                    </li>
                                    <!-- End::slide -->
                                    @inject('service_social', 'App\Models\ServiceSocial')
                                    @inject('service', 'App\Models\Service')

                                    @foreach ($service_social->where('domain', env('PARENT_SITE'))->where('status', 'show')->get() as $item)
                                        <li class="slide has-sub">
                                            <a href="javascript:void(0);" class="side-menu__item"
                                                onclick="toggleMenu('{{ $item->slug }}')">
                                                <span class="side-menu__icon">
                                                    <img src="{{ $item->image }}" width="20"
                                                        alt="{{ $item->name }}">
                                                </span>
                                                <span class="side-menu__label">{{ $item->name }}</span>
                                                <i class="fa-solid fa-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul id="menu-{{ $item->slug }}" class="slide-menu child1 mega-menu"
                                                style="display: none;">
                                                @foreach ($service->where('domain', env('PARENT_SITE'))->where('status', 'show')->where('service_social', $item->slug)->get() as $sv)
                                                    <li class="slide">
                                                        <a href="{{ route('service.view', ['social' => $item->slug, 'service' => $sv->slug]) }}"
                                                            class="side-menu__item">
                                                            <span class="side-menu__icon">
                                                                @if ($sv->slug == 'proxy')
                                                                    <i class="ki-duotone ki-diamonds fs-3"><i
                                                                            class="path1"></i><i
                                                                            class="path2"></i></i>
                                                                @elseif ($sv->slug == 'bot')
                                                                    <i class="ki-duotone ki-emoji-happy fs-3"><i
                                                                            class="path1"></i><i
                                                                            class="path2"></i><i
                                                                            class="path3"></i><i
                                                                            class="path4"></i></i>
                                                                @elseif ($sv->slug == 'follow')
                                                                    <i class="fa fa-heart"></i>
                                                                @elseif (
                                                                    $sv->slug == 'like' ||
                                                                        $sv->slug == 'like-page' ||
                                                                        $sv->slug == 'like-comment' ||
                                                                        $sv->slug == 'vip-like' ||
                                                                        $sv->slug == 'like-share')
                                                                    <i class="fa fa-thumbs-up"></i>
                                                                @elseif ($sv->slug == 'sub')
                                                                    <i class="fa fa-heart"></i>
                                                                @elseif ($sv->slug == 'eye-live' || $sv->slug == 'view-video' || $sv->slug == 'view' || $sv->slug == 'view-story')
                                                                    <i class="fa fa-eye"></i>
                                                                @elseif ($sv->slug == 'comment')
                                                                    <i class="fa fa-comments"></i>
                                                                @elseif ($sv->slug == 'point' || $sv->slug == 'review')
                                                                    <i class="fa fa-star"></i>
                                                                @elseif ($sv->slug == 'action-story' || $sv->slug == 'save-video')
                                                                    <i class="fa fa-heart"></i>
                                                                @elseif ($sv->slug == 'member')
                                                                    <i class="fa fa-users"></i>
                                                                @elseif ($sv->slug == 'checkin')
                                                                    <i class="fa fa-check-circle"></i>
                                                                @elseif ($sv->slug == 'share')
                                                                    <i class="fa fa-share"></i>
                                                                @elseif ($sv->slug == 'retweet')
                                                                    <i class="fa fa-retweet"></i>
                                                                @elseif ($sv->slug == 'view-4k')
                                                                    <i class="fa fa-hourglass-start"></i>
                                                                @elseif ($sv->slug == 'review-maps')
                                                                    <i class="fa fa-search-location"></i>
                                                                @elseif ($sv->slug == 'pins')
                                                                    <i class="fa fa-map-pin"></i>
                                                                @elseif ($sv->slug == 'traffic')
                                                                    <i class="fa fa-globe-asia"></i>
                                                                @endif
                                                            </span>
                                                            <span class="side-menu__label">{{ $sv->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach

                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span
                                            class="category-name">{{ __('tools_area') }}</span>
                                    </li>
                                    <li class="slide has-sub ">
                                        <a href="javascript:void(0);" class="side-menu__item ">
                                            <i class="fa-regular fa-user side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('utility_tools') }}</span>
                                            <i class="fa-solid fa-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1 mega-menu" data-popper-placement="bottom"
                                            style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(127.2px, 316px, 0px);">
                                            <li class="slide">
                                                <a href="{{ route('tool.2fa') }}"
                                                    class="side-menu__item ">{{ __('facebook_2fa') }}</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{ route('tool.uid') }}"
                                                    class="side-menu__item ">{{ __('get_facebook_uid') }}</a>
                                            </li>
                                            <li class="slide">
                                                <a href="{{ route('tool.domain') }}"
                                                    class="side-menu__item ">{{ __('check_domain') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End::slide -->
                                    
                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('pages.affiliates') }}" class="side-menu__item ">
                                            <i class="fa-solid fa-code-branch side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('affiliate_marketing') }}</span>
                                        </a>
                                    </li>
                                   
                                    <!-- Start::slide__category -->
                                    <li class="slide__category"><span
                                            class="category-name">{{ __('affiliate_all') }}</span></li>
                                    <!-- End::slide__category -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('api.docs') }}" class="side-menu__item ">
                                            <i class="fa-solid fa-code side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('api_documentation') }}</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ route('term') }}" class="side-menu__item ">
                                            <i class="fa fa-shield side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('terms_of_service') }}</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ DataSite('telegram') }}" class="side-menu__item"
                                            target="_blank">
                                            <i class="fa-brands fa-telegram side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('contact_telegram') }}</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                    <!-- Start::slide -->
                                    <li class="slide">
                                        <a href="{{ DataSite('facebook') }}" class="side-menu__item"
                                            target="_blank">
                                            <i class="fab fa-facebook-f side-menu__icon"></i>
                                            <span class="side-menu__label">{{ __('contact_facebook') }}</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                </ul>
                                <li class="slide__category"><span class="category-name">Khác</span>
                                    @inject('category', 'App\Models\Category')
                                    @foreach ($category->where('domain', env('PARENT_SITE'))->where('status', 'show')->get() as $category)
                                        <li class="slide">
                                            <a href="/service/{{ $category->slug }}" class="side-menu__item ">
                                                <img src="{{ $category->image }}" width="20" height="20"
                                                    alt="">
                                                <span class="side-menu__label">{{ $category->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                <div class="slide-right d-none" id="slide-right"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg></div>
                            </nav>
                            <!-- End::nav -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 698px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 692px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
    <!-- End::main-sidebar -->

</aside>
@yield('content')
