<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical"
    data-theme-mode="light" data-header-styles="light" data-menu-styles="light" loader="disable"
    data-vertical-style="overlay" data-select2-id="select2-data-118-2zfi" data-toggled="close">

<head>
    <!-- --> 
    <title>@yield('title')</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="{{ DataSite('description') }}" />
    <meta name="keywords" content="{{ DataSite('keyword') }}" />
    <meta name="title" content="{{ DataSite('title') }}" />
    <meta property="og:image" content="{{ DataSite('image_seo') }}" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::check())
        <meta name="api-token" content="{{ Auth::user()->api_token }}" />
    @endif
    <style>
        .codepro-trungthu-left {
            position: fixed;
            top: 0;
            left: 0;
            width: 166px;
            z-index: 9999
        }

        .codepro-trungthu-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 166px;
            z-index: 9999
        }

        .codepro-trungthu-bottom {
            position: fixed;
            bottom: -8px;
            left: 0;
            width: 333px;
            z-index: 9999
        }

        @media(max-width:1024px) {

            .codepro-trungthu-left,
            .codepro-trungthu-right,
            .codepro-trungthu-bottom {
                display: none !important
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Choices JS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-5Kg4FgSEyJ12NKJLTYdOJF9peCRzS+IJpZdp8wst8Auub+/c/rdth+f59U7BsOo7" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zN/5oxYlY8pWoyJyKX6Uv1nA/CR9fH/j4PcjlLrRDI8COmI5bZqZScRDMUl+z59C" crossorigin="anonymous">
    </script>

    @yield('css')
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">

    <link rel="stylesheet" href="{{ asset('/plugins/pace-js/flash.min.css') }}">
    <script src="{{ asset('plugins/pace-js/pace.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&amp;display=swap">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.2/sweetalert2.min.css">

    <link rel="preload" as="style" href="{{ asset('build/assets/app-DjhSsAid.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DjhSsAid.css') }}">
    <style>
        :root {
            --primary: #1038d5;
            --primary-rgb: 16, 56, 213;
            --primary-hover: #1086f4;
        }

        body {
            font-family: 'Archivo', sans-serif;
            letter-spacing: 0.5px;
        }

        .card-header>.card-title {
            text-transform: uppercase !important;
        }

        .table thead tr th {
            background-color: var(--primary) !important;
            color: var(--primary-hover);
        }
    </style>
    <style>
        .custom-card {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            /* Đảm bảo thẻ nằm giữa */
        }

        .custom-card h1 {
            text-align: center;
            font-size: 2rem;
            /* Giảm kích thước tiêu đề */
            font-weight: bold;
            margin: 1rem 0;
            color: var(--text-color, #333);
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            width: 100%;
            /* Đảm bảo lưới chiếm toàn bộ chiều rộng */
            padding: 1rem;
            /* Thêm khoảng cách bên trong lưới */
        }

        @media (min-width: 640px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .btn-service {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background-color: #f0f0f0;
            border-radius: 0.5rem;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            text-align: center;
        }

        .btn-service:hover {
            transform: translateY(-0.25rem);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dark .btn-service {
            background-color: #0E2954;
        }

        .dark .btn-service h2 {
            color: #FAF0E4;
        }

        .btn-service img {
            height: 2.25rem;
            width: 2.25rem;
        }

        .btn-service h2 {
            margin-top: 0.75rem;
            font-size: 1rem;
            /* Giảm kích thước văn bản */
            font-weight: bold;
            text-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        #form-buy .server__name:hover {
            color: #10ac84;
            transform: scale(1.05);
            margin-left: 5px;
        }

        #form-buy label {
            font-weight: bold;
        }

        #form-buy .total_price,
        .total_price_usd {
            font-weight: bold;
            font-size: 2rem;
        }

        #form-buy .panel-descr {
            background-color: #FFE0B5;
            color: #000;
            padding: 10px;
            border-radius: 8px;
        }

        .price_box {
            border: 1px solid #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            background-color: transparent;
        }

        .price_box .total_price {
            background-color: black;
            padding: 0 10px 0 10px;
            border-radius: 5px;
            color: yellow;
        }

        .new-feeds {
            max-height: 483px;
            overflow-y: auto;
        }
    </style>


    <style>
        .swal2-popup.swal2-toast {
            box-sizing: border-box;
            grid-column: 1/4 !important;
            grid-row: 1/4 !important;
            grid-template-columns: min-content auto min-content;
            padding: 1em;
            overflow-y: hidden;
            background: #fff;
            box-shadow: 0 0 1px rgba(0, 0, 0, .075), 0 1px 2px rgba(0, 0, 0, .075), 1px 2px 4px rgba(0, 0, 0, .075), 1px 3px 8px rgba(0, 0, 0, .075), 2px 4px 16px rgba(0, 0, 0, .075);
            pointer-events: all
        }

        .swal2-popup.swal2-toast>* {
            grid-column: 2
        }

        .swal2-popup.swal2-toast .swal2-title {
            margin: .5em 1em;
            padding: 0;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-loading {
            justify-content: center
        }

        .swal2-popup.swal2-toast .swal2-input {
            height: 2em;
            margin: .5em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-validation-message {
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-footer {
            margin: .5em 0 0;
            padding: .5em 0 0;
            font-size: .8em
        }

        .swal2-popup.swal2-toast .swal2-close {
            grid-column: 3/3;
            grid-row: 1/99;
            align-self: center;
            width: .8em;
            height: .8em;
            margin: 0;
            font-size: 2em
        }

        .swal2-popup.swal2-toast .swal2-html-container {
            margin: .5em 1em;
            padding: 0;
            overflow: initial;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-html-container:empty {
            padding: 0
        }

        .swal2-popup.swal2-toast .swal2-loader {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            height: 2em;
            margin: .25em
        }

        .swal2-popup.swal2-toast .swal2-icon {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            min-width: 2em;
            height: 2em;
            margin: 0 .5em 0 0
        }

        .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 1.8em;
            font-weight: bold
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
            top: .875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: .3125em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: .3125em
        }

        .swal2-popup.swal2-toast .swal2-actions {
            justify-content: flex-start;
            height: auto;
            margin: 0;
            margin-top: .5em;
            padding: 0 .5em
        }

        .swal2-popup.swal2-toast .swal2-styled {
            margin: .25em .5em;
            padding: .4em .6em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-success {
            border-color: #a5dc86
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 1.6em;
            height: 3em;
            border-radius: 50%
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.8em;
            left: -0.5em;
            transform: rotate(-45deg);
            transform-origin: 2em 2em;
            border-radius: 4em 0 0 4em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.25em;
            left: .9375em;
            transform-origin: 0 1.5em;
            border-radius: 0 4em 4em 0
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
            top: 0;
            left: .4375em;
            width: .4375em;
            height: 2.6875em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line] {
            height: .3125em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip] {
            top: 1.125em;
            left: .1875em;
            width: .75em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long] {
            top: .9375em;
            right: .1875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-toast-animate-success-line-tip .75s
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-toast-animate-success-line-long .75s
        }

        .swal2-popup.swal2-toast.swal2-show {
            animation: swal2-toast-show .5s
        }

        .swal2-popup.swal2-toast.swal2-hide {
            animation: swal2-toast-hide .1s forwards
        }

        div:where(.swal2-container) {
            display: grid;
            position: fixed;
            z-index: 1060;
            inset: 0;
            box-sizing: border-box;
            grid-template-areas: "top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";
            grid-template-rows: minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);
            height: 100%;
            padding: .625em;
            overflow-x: hidden;
            transition: background-color .1s;
            -webkit-overflow-scrolling: touch
        }

        div:where(.swal2-container).swal2-backdrop-show,
        div:where(.swal2-container).swal2-noanimation {
            background: rgba(0, 0, 0, .4)
        }

        div:where(.swal2-container).swal2-backdrop-hide {
            background: rgba(0, 0, 0, 0) !important
        }

        div:where(.swal2-container).swal2-top-start,
        div:where(.swal2-container).swal2-center-start,
        div:where(.swal2-container).swal2-bottom-start {
            grid-template-columns: minmax(0, 1fr) auto auto
        }

        div:where(.swal2-container).swal2-top,
        div:where(.swal2-container).swal2-center,
        div:where(.swal2-container).swal2-bottom {
            grid-template-columns: auto minmax(0, 1fr) auto
        }

        div:where(.swal2-container).swal2-top-end,
        div:where(.swal2-container).swal2-center-end,
        div:where(.swal2-container).swal2-bottom-end {
            grid-template-columns: auto auto minmax(0, 1fr)
        }

        div:where(.swal2-container).swal2-top-start>.swal2-popup {
            align-self: start
        }

        div:where(.swal2-container).swal2-top>.swal2-popup {
            grid-column: 2;
            place-self: start center
        }

        div:where(.swal2-container).swal2-top-end>.swal2-popup,
        div:where(.swal2-container).swal2-top-right>.swal2-popup {
            grid-column: 3;
            place-self: start end
        }

        div:where(.swal2-container).swal2-center-start>.swal2-popup,
        div:where(.swal2-container).swal2-center-left>.swal2-popup {
            grid-row: 2;
            align-self: center
        }

        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center
        }

        div:where(.swal2-container).swal2-center-end>.swal2-popup,
        div:where(.swal2-container).swal2-center-right>.swal2-popup {
            grid-column: 3;
            grid-row: 2;
            place-self: center end
        }

        div:where(.swal2-container).swal2-bottom-start>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-left>.swal2-popup {
            grid-column: 1;
            grid-row: 3;
            align-self: end
        }

        div:where(.swal2-container).swal2-bottom>.swal2-popup {
            grid-column: 2;
            grid-row: 3;
            place-self: end center
        }

        div:where(.swal2-container).swal2-bottom-end>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-right>.swal2-popup {
            grid-column: 3;
            grid-row: 3;
            place-self: end end
        }

        div:where(.swal2-container).swal2-grow-row>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-column: 1/4;
            width: 100%
        }

        div:where(.swal2-container).swal2-grow-column>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-row: 1/4;
            align-self: stretch
        }

        div:where(.swal2-container).swal2-no-transition {
            transition: none !important
        }

        div:where(.swal2-container) div:where(.swal2-popup) {
            display: none;
            position: relative;
            box-sizing: border-box;
            grid-template-columns: minmax(0, 100%);
            width: 32em;
            max-width: 100%;
            padding: 0 0 1.25em;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #545454;
            font-family: inherit;
            font-size: 1rem
        }

        div:where(.swal2-container) div:where(.swal2-popup):focus {
            outline: none
        }

        div:where(.swal2-container) div:where(.swal2-popup).swal2-loading {
            overflow-y: hidden
        }

        div:where(.swal2-container) h2:where(.swal2-title) {
            position: relative;
            max-width: 100%;
            margin: 0;
            padding: .8em 1em 0;
            color: inherit;
            font-size: 1.875em;
            font-weight: 600;
            text-align: center;
            text-transform: none;
            word-wrap: break-word
        }

        div:where(.swal2-container) div:where(.swal2-actions) {
            display: flex;
            z-index: 1;
            box-sizing: border-box;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: auto;
            margin: 1.25em auto 0;
            padding: 0
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled] {
            opacity: .4
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover {
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active {
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))
        }

        div:where(.swal2-container) div:where(.swal2-loader) {
            display: none;
            align-items: center;
            justify-content: center;
            width: 2.2em;
            height: 2.2em;
            margin: 0 1.875em;
            animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
            border-width: .25em;
            border-style: solid;
            border-radius: 100%;
            border-color: #2778c4 rgba(0, 0, 0, 0) #2778c4 rgba(0, 0, 0, 0)
        }

        div:where(.swal2-container) button:where(.swal2-styled) {
            margin: .3125em;
            padding: .625em 1.1em;
            transition: box-shadow .1s;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0);
            font-weight: 500
        }

        div:where(.swal2-container) button:where(.swal2-styled):not([disabled]) {
            cursor: pointer
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #7066e0;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(112, 102, 224, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #dc3741;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus {
            box-shadow: 0 0 0 3px rgba(220, 55, 65, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #6e7881;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus {
            box-shadow: 0 0 0 3px rgba(110, 120, 129, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled):focus {
            outline: none
        }

        div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) div:where(.swal2-footer) {
            margin: 1em 0 0;
            padding: 1em 1em 0;
            border-top: 1px solid #eee;
            color: inherit;
            font-size: 1em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-timer-progress-bar-container {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            grid-column: auto !important;
            overflow: hidden;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px
        }

        div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
            width: 100%;
            height: .25em;
            background: rgba(0, 0, 0, .2)
        }

        div:where(.swal2-container) img:where(.swal2-image) {
            max-width: 100%;
            margin: 2em auto 1em
        }

        div:where(.swal2-container) button:where(.swal2-close) {
            z-index: 2;
            align-items: center;
            justify-content: center;
            width: 1.2em;
            height: 1.2em;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: -1.2em;
            padding: 0;
            overflow: hidden;
            transition: color .1s, box-shadow .1s;
            border: none;
            border-radius: 5px;
            background: rgba(0, 0, 0, 0);
            color: #ccc;
            font-family: monospace;
            font-size: 2.5em;
            cursor: pointer;
            justify-self: end
        }

        div:where(.swal2-container) button:where(.swal2-close):hover {
            transform: none;
            background: rgba(0, 0, 0, 0);
            color: #f27474
        }

        div:where(.swal2-container) button:where(.swal2-close):focus {
            outline: none;
            box-shadow: inset 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) .swal2-html-container {
            z-index: 1;
            justify-content: center;
            margin: 1em 1.6em .3em;
            padding: 0;
            overflow: auto;
            color: inherit;
            font-size: 1.125em;
            font-weight: normal;
            line-height: normal;
            text-align: center;
            word-wrap: break-word;
            word-break: break-word
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea),
        div:where(.swal2-container) select:where(.swal2-select),
        div:where(.swal2-container) div:where(.swal2-radio),
        div:where(.swal2-container) label:where(.swal2-checkbox) {
            margin: 1em 2em 3px
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea) {
            box-sizing: border-box;
            width: auto;
            transition: border-color .1s, box-shadow .1s;
            border: 1px solid #d9d9d9;
            border-radius: .1875em;
            background: rgba(0, 0, 0, 0);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,
        div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,
        div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror {
            border-color: #f27474 !important;
            box-shadow: 0 0 2px #f27474 !important
        }

        div:where(.swal2-container) input:where(.swal2-input):focus,
        div:where(.swal2-container) input:where(.swal2-file):focus,
        div:where(.swal2-container) textarea:where(.swal2-textarea):focus {
            border: 1px solid #b4dbed;
            outline: none;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) input:where(.swal2-input)::placeholder,
        div:where(.swal2-container) input:where(.swal2-file)::placeholder,
        div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder {
            color: #ccc
        }

        div:where(.swal2-container) .swal2-range {
            margin: 1em 2em 3px;
            background: #fff
        }

        div:where(.swal2-container) .swal2-range input {
            width: 80%
        }

        div:where(.swal2-container) .swal2-range output {
            width: 20%;
            color: inherit;
            font-weight: 600;
            text-align: center
        }

        div:where(.swal2-container) .swal2-range input,
        div:where(.swal2-container) .swal2-range output {
            height: 2.625em;
            padding: 0;
            font-size: 1.125em;
            line-height: 2.625em
        }

        div:where(.swal2-container) .swal2-input {
            height: 2.625em;
            padding: 0 .75em
        }

        div:where(.swal2-container) .swal2-file {
            width: 75%;
            margin-right: auto;
            margin-left: auto;
            background: rgba(0, 0, 0, 0);
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-textarea {
            height: 6.75em;
            padding: .75em
        }

        div:where(.swal2-container) .swal2-select {
            min-width: 50%;
            max-width: 100%;
            padding: .375em .625em;
            background: rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio,
        div:where(.swal2-container) .swal2-checkbox {
            align-items: center;
            justify-content: center;
            background: #fff;
            color: inherit
        }

        div:where(.swal2-container) .swal2-radio label,
        div:where(.swal2-container) .swal2-checkbox label {
            margin: 0 .6em;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio input,
        div:where(.swal2-container) .swal2-checkbox input {
            flex-shrink: 0;
            margin: 0 .4em
        }

        div:where(.swal2-container) label:where(.swal2-input-label) {
            display: flex;
            justify-content: center;
            margin: 1em auto 0
        }

        div:where(.swal2-container) div:where(.swal2-validation-message) {
            align-items: center;
            justify-content: center;
            margin: 1em 0 0;
            padding: .625em;
            overflow: hidden;
            background: #f0f0f0;
            color: #666;
            font-size: 1em;
            font-weight: 300
        }

        div:where(.swal2-container) div:where(.swal2-validation-message)::before {
            content: "!";
            display: inline-block;
            width: 1.5em;
            min-width: 1.5em;
            height: 1.5em;
            margin: 0 .625em;
            border-radius: 50%;
            background-color: #f27474;
            color: #fff;
            font-weight: 600;
            line-height: 1.5em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps {
            flex-wrap: wrap;
            align-items: center;
            max-width: 100%;
            margin: 1.25em auto;
            padding: 0;
            background: rgba(0, 0, 0, 0);
            font-weight: 600
        }

        div:where(.swal2-container) .swal2-progress-steps li {
            display: inline-block;
            position: relative
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step {
            z-index: 20;
            flex-shrink: 0;
            width: 2em;
            height: 2em;
            border-radius: 2em;
            background: #2778c4;
            color: #fff;
            line-height: 2em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
            background: #2778c4
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step {
            background: #add8e6;
            color: #fff
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
            background: #add8e6
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line {
            z-index: 10;
            flex-shrink: 0;
            width: 2.5em;
            height: .4em;
            margin: 0 -1px;
            background: #2778c4
        }

        div:where(.swal2-icon) {
            position: relative;
            box-sizing: content-box;
            justify-content: center;
            width: 5em;
            height: 5em;
            margin: 2.5em auto .6em;
            border: 0.25em solid rgba(0, 0, 0, 0);
            border-radius: 50%;
            border-color: #000;
            font-family: inherit;
            line-height: 5em;
            cursor: default;
            user-select: none
        }

        div:where(.swal2-icon) .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 3.75em
        }

        div:where(.swal2-icon).swal2-error {
            border-color: #f27474;
            color: #f27474
        }

        div:where(.swal2-icon).swal2-error .swal2-x-mark {
            position: relative;
            flex-grow: 1
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
            display: block;
            position: absolute;
            top: 2.3125em;
            width: 2.9375em;
            height: .3125em;
            border-radius: .125em;
            background-color: #f27474
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: 1.0625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: 1em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            animation: swal2-animate-error-x-mark .5s
        }

        div:where(.swal2-icon).swal2-warning {
            border-color: #facea8;
            color: #f8bb86
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .5s
        }

        div:where(.swal2-icon).swal2-info {
            border-color: #9de0f6;
            color: #3fc3ee
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .8s
        }

        div:where(.swal2-icon).swal2-question {
            border-color: #c9dae1;
            color: #87adbd
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-question-mark .8s
        }

        div:where(.swal2-icon).swal2-success {
            border-color: #a5dc86;
            color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 3.75em;
            height: 7.5em;
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.4375em;
            left: -2.0635em;
            transform: rotate(-45deg);
            transform-origin: 3.75em 3.75em;
            border-radius: 7.5em 0 0 7.5em
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.6875em;
            left: 1.875em;
            transform: rotate(-45deg);
            transform-origin: 0 3.75em;
            border-radius: 0 7.5em 7.5em 0
        }

        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            position: absolute;
            z-index: 2;
            top: -0.25em;
            left: -0.25em;
            box-sizing: content-box;
            width: 100%;
            height: 100%;
            border: .25em solid rgba(165, 220, 134, .3);
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success .swal2-success-fix {
            position: absolute;
            z-index: 1;
            top: .5em;
            left: 1.625em;
            width: .4375em;
            height: 5.625em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
            display: block;
            position: absolute;
            z-index: 2;
            height: .3125em;
            border-radius: .125em;
            background-color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip] {
            top: 2.875em;
            left: .8125em;
            width: 1.5625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long] {
            top: 2.375em;
            right: .5em;
            width: 2.9375em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-animate-success-line-tip .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-animate-success-line-long .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
            animation: swal2-rotate-success-circular-line 4.25s ease-in
        }

        [class^=swal2] {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        .swal2-show {
            animation: swal2-show .3s
        }

        .swal2-hide {
            animation: swal2-hide .15s forwards
        }

        .swal2-noanimation {
            transition: none
        }

        .swal2-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll
        }

        .swal2-rtl .swal2-close {
            margin-right: initial;
            margin-left: 0
        }

        .swal2-rtl .swal2-timer-progress-bar {
            right: 0;
            left: auto
        }

        @keyframes swal2-toast-show {
            0% {
                transform: translateY(-0.625em) rotateZ(2deg)
            }

            33% {
                transform: translateY(0) rotateZ(-2deg)
            }

            66% {
                transform: translateY(0.3125em) rotateZ(2deg)
            }

            100% {
                transform: translateY(0) rotateZ(0deg)
            }
        }

        @keyframes swal2-toast-hide {
            100% {
                transform: rotateZ(1deg);
                opacity: 0
            }
        }

        @keyframes swal2-toast-animate-success-line-tip {
            0% {
                top: .5625em;
                left: .0625em;
                width: 0
            }

            54% {
                top: .125em;
                left: .125em;
                width: 0
            }

            70% {
                top: .625em;
                left: -0.25em;
                width: 1.625em
            }

            84% {
                top: 1.0625em;
                left: .75em;
                width: .5em
            }

            100% {
                top: 1.125em;
                left: .1875em;
                width: .75em
            }
        }

        @keyframes swal2-toast-animate-success-line-long {
            0% {
                top: 1.625em;
                right: 1.375em;
                width: 0
            }

            65% {
                top: 1.25em;
                right: .9375em;
                width: 0
            }

            84% {
                top: .9375em;
                right: 0;
                width: 1.125em
            }

            100% {
                top: .9375em;
                right: .1875em;
                width: 1.375em
            }
        }

        @keyframes swal2-show {
            0% {
                transform: scale(0.7)
            }

            45% {
                transform: scale(1.05)
            }

            80% {
                transform: scale(0.95)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes swal2-hide {
            0% {
                transform: scale(1);
                opacity: 1
            }

            100% {
                transform: scale(0.5);
                opacity: 0
            }
        }

        @keyframes swal2-animate-success-line-tip {
            0% {
                top: 1.1875em;
                left: .0625em;
                width: 0
            }

            54% {
                top: 1.0625em;
                left: .125em;
                width: 0
            }

            70% {
                top: 2.1875em;
                left: -0.375em;
                width: 3.125em
            }

            84% {
                top: 3em;
                left: 1.3125em;
                width: 1.0625em
            }

            100% {
                top: 2.8125em;
                left: .8125em;
                width: 1.5625em
            }
        }

        @keyframes swal2-animate-success-line-long {
            0% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            65% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            84% {
                top: 2.1875em;
                right: 0;
                width: 3.4375em
            }

            100% {
                top: 2.375em;
                right: .5em;
                width: 2.9375em
            }
        }

        @keyframes swal2-rotate-success-circular-line {
            0% {
                transform: rotate(-45deg)
            }

            5% {
                transform: rotate(-45deg)
            }

            12% {
                transform: rotate(-405deg)
            }

            100% {
                transform: rotate(-405deg)
            }
        }

        @keyframes swal2-animate-error-x-mark {
            0% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            50% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            80% {
                margin-top: -0.375em;
                transform: scale(1.15)
            }

            100% {
                margin-top: 0;
                transform: scale(1);
                opacity: 1
            }
        }

        @keyframes swal2-animate-error-icon {
            0% {
                transform: rotateX(100deg);
                opacity: 0
            }

            100% {
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @keyframes swal2-rotate-loading {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        @keyframes swal2-animate-question-mark {
            0% {
                transform: rotateY(-360deg)
            }

            100% {
                transform: rotateY(0)
            }
        }

        @keyframes swal2-animate-i-mark {
            0% {
                transform: rotateZ(45deg);
                opacity: 0
            }

            25% {
                transform: rotateZ(-25deg);
                opacity: .4
            }

            50% {
                transform: rotateZ(15deg);
                opacity: .8
            }

            75% {
                transform: rotateZ(-5deg);
                opacity: 1
            }

            100% {
                transform: rotateX(0);
                opacity: 1
            }
        }

        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            overflow: hidden
        }

        body.swal2-height-auto {
            height: auto !important
        }

        body.swal2-no-backdrop .swal2-container {
            background-color: rgba(0, 0, 0, 0) !important;
            pointer-events: none
        }

        body.swal2-no-backdrop .swal2-container .swal2-popup {
            pointer-events: all
        }

        body.swal2-no-backdrop .swal2-container .swal2-modal {
            box-shadow: 0 0 10px rgba(0, 0, 0, .4)
        }

        @media print {
            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
                overflow-y: scroll !important
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true] {
                display: none
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
                position: static !important
            }
        }

        body.swal2-toast-shown .swal2-container {
            box-sizing: border-box;
            width: 360px;
            max-width: 100%;
            background-color: rgba(0, 0, 0, 0);
            pointer-events: none
        }

        body.swal2-toast-shown .swal2-container.swal2-top {
            inset: 0 auto auto 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-top-end,
        body.swal2-toast-shown .swal2-container.swal2-top-right {
            inset: 0 0 auto auto
        }

        body.swal2-toast-shown .swal2-container.swal2-top-start,
        body.swal2-toast-shown .swal2-container.swal2-top-left {
            inset: 0 auto auto 0
        }

        body.swal2-toast-shown .swal2-container.swal2-center-start,
        body.swal2-toast-shown .swal2-container.swal2-center-left {
            inset: 50% auto auto 0;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center {
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center-end,
        body.swal2-toast-shown .swal2-container.swal2-center-right {
            inset: 50% 0 auto auto;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-start,
        body.swal2-toast-shown .swal2-container.swal2-bottom-left {
            inset: auto auto 0 0
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom {
            inset: auto auto 0 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-end,
        body.swal2-toast-shown .swal2-container.swal2-bottom-right {
            inset: auto 0 0 auto
        }
    </style>
    <style data-jss="" data-meta="MuiDialog">
        @media print {
            .MuiDialog-root {
                position: absolute !important;
            }
        }

        .MuiDialog-scrollPaper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .MuiDialog-scrollBody {
            overflow-x: hidden;
            overflow-y: auto;
            text-align: center;
        }

        .MuiDialog-scrollBody:after {
            width: 0;
            height: 100%;
            content: "";
            display: inline-block;
            vertical-align: middle;
        }

        .MuiDialog-container {
            height: 100%;
            outline: 0;
        }

        @media print {
            .MuiDialog-container {
                height: auto;
            }
        }

        .MuiDialog-paper {
            margin: 32px;
            position: relative;
            overflow-y: auto;
        }

        @media print {
            .MuiDialog-paper {
                box-shadow: none;
                overflow-y: visible;
            }
        }

        .MuiDialog-paperScrollPaper {
            display: flex;
            max-height: calc(100% - 64px);
            flex-direction: column;
        }

        .MuiDialog-paperScrollBody {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }

        .MuiDialog-paperWidthFalse {
            max-width: calc(100% - 64px);
        }

        .MuiDialog-paperWidthXs {
            max-width: 444px;
        }

        @media (max-width:507.95px) {
            .MuiDialog-paperWidthXs.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthSm {
            max-width: 600px;
        }

        @media (max-width:663.95px) {
            .MuiDialog-paperWidthSm.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthMd {
            max-width: 960px;
        }

        @media (max-width:1023.95px) {
            .MuiDialog-paperWidthMd.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthLg {
            max-width: 1280px;
        }

        @media (max-width:1343.95px) {
            .MuiDialog-paperWidthLg.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperWidthXl {
            max-width: 1920px;
        }

        @media (max-width:1983.95px) {
            .MuiDialog-paperWidthXl.MuiDialog-paperScrollBody {
                max-width: calc(100% - 64px);
            }
        }

        .MuiDialog-paperFullWidth {
            width: calc(100% - 64px);
        }

        .MuiDialog-paperFullScreen {
            width: 100%;
            height: 100%;
            margin: 0;
            max-width: 100%;
            max-height: none;
            border-radius: 0;
        }

        .MuiDialog-paperFullScreen.MuiDialog-paperScrollBody {
            margin: 0;
            max-width: 100%;
        }
    </style>
    <style>
        .swal2-popup.swal2-toast {
            box-sizing: border-box;
            grid-column: 1/4 !important;
            grid-row: 1/4 !important;
            grid-template-columns: min-content auto min-content;
            padding: 1em;
            overflow-y: hidden;
            background: #fff;
            box-shadow: 0 0 1px rgba(0, 0, 0, .075), 0 1px 2px rgba(0, 0, 0, .075), 1px 2px 4px rgba(0, 0, 0, .075), 1px 3px 8px rgba(0, 0, 0, .075), 2px 4px 16px rgba(0, 0, 0, .075);
            pointer-events: all
        }

        .swal2-popup.swal2-toast>* {
            grid-column: 2
        }

        .swal2-popup.swal2-toast .swal2-title {
            margin: .5em 1em;
            padding: 0;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-loading {
            justify-content: center
        }

        .swal2-popup.swal2-toast .swal2-input {
            height: 2em;
            margin: .5em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-validation-message {
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-footer {
            margin: .5em 0 0;
            padding: .5em 0 0;
            font-size: .8em
        }

        .swal2-popup.swal2-toast .swal2-close {
            grid-column: 3/3;
            grid-row: 1/99;
            align-self: center;
            width: .8em;
            height: .8em;
            margin: 0;
            font-size: 2em
        }

        .swal2-popup.swal2-toast .swal2-html-container {
            margin: .5em 1em;
            padding: 0;
            overflow: initial;
            font-size: 1em;
            text-align: initial
        }

        .swal2-popup.swal2-toast .swal2-html-container:empty {
            padding: 0
        }

        .swal2-popup.swal2-toast .swal2-loader {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            height: 2em;
            margin: .25em
        }

        .swal2-popup.swal2-toast .swal2-icon {
            grid-column: 1;
            grid-row: 1/99;
            align-self: center;
            width: 2em;
            min-width: 2em;
            height: 2em;
            margin: 0 .5em 0 0
        }

        .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 1.8em;
            font-weight: bold
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
            top: .875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: .3125em
        }

        .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: .3125em
        }

        .swal2-popup.swal2-toast .swal2-actions {
            justify-content: flex-start;
            height: auto;
            margin: 0;
            margin-top: .5em;
            padding: 0 .5em
        }

        .swal2-popup.swal2-toast .swal2-styled {
            margin: .25em .5em;
            padding: .4em .6em;
            font-size: 1em
        }

        .swal2-popup.swal2-toast .swal2-success {
            border-color: #a5dc86
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 1.6em;
            height: 3em;
            transform: rotate(45deg);
            border-radius: 50%
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.8em;
            left: -0.5em;
            transform: rotate(-45deg);
            transform-origin: 2em 2em;
            border-radius: 4em 0 0 4em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.25em;
            left: .9375em;
            transform-origin: 0 1.5em;
            border-radius: 0 4em 4em 0
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
            width: 2em;
            height: 2em
        }

        .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
            top: 0;
            left: .4375em;
            width: .4375em;
            height: 2.6875em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line] {
            height: .3125em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip] {
            top: 1.125em;
            left: .1875em;
            width: .75em
        }

        .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long] {
            top: .9375em;
            right: .1875em;
            width: 1.375em
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-toast-animate-success-line-tip .75s
        }

        .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-toast-animate-success-line-long .75s
        }

        .swal2-popup.swal2-toast.swal2-show {
            animation: swal2-toast-show .5s
        }

        .swal2-popup.swal2-toast.swal2-hide {
            animation: swal2-toast-hide .1s forwards
        }

        div:where(.swal2-container) {
            display: grid;
            position: fixed;
            z-index: 1060;
            inset: 0;
            box-sizing: border-box;
            grid-template-areas: "top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";
            grid-template-rows: minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);
            height: 100%;
            padding: .625em;
            overflow-x: hidden;
            transition: background-color .1s;
            -webkit-overflow-scrolling: touch
        }

        div:where(.swal2-container).swal2-backdrop-show,
        div:where(.swal2-container).swal2-noanimation {
            background: rgba(0, 0, 0, .4)
        }

        div:where(.swal2-container).swal2-backdrop-hide {
            background: rgba(0, 0, 0, 0) !important
        }

        div:where(.swal2-container).swal2-top-start,
        div:where(.swal2-container).swal2-center-start,
        div:where(.swal2-container).swal2-bottom-start {
            grid-template-columns: minmax(0, 1fr) auto auto
        }

        div:where(.swal2-container).swal2-top,
        div:where(.swal2-container).swal2-center,
        div:where(.swal2-container).swal2-bottom {
            grid-template-columns: auto minmax(0, 1fr) auto
        }

        div:where(.swal2-container).swal2-top-end,
        div:where(.swal2-container).swal2-center-end,
        div:where(.swal2-container).swal2-bottom-end {
            grid-template-columns: auto auto minmax(0, 1fr)
        }

        div:where(.swal2-container).swal2-top-start>.swal2-popup {
            align-self: start
        }

        div:where(.swal2-container).swal2-top>.swal2-popup {
            grid-column: 2;
            align-self: start;
            justify-self: center
        }

        div:where(.swal2-container).swal2-top-end>.swal2-popup,
        div:where(.swal2-container).swal2-top-right>.swal2-popup {
            grid-column: 3;
            align-self: start;
            justify-self: end
        }

        div:where(.swal2-container).swal2-center-start>.swal2-popup,
        div:where(.swal2-container).swal2-center-left>.swal2-popup {
            grid-row: 2;
            align-self: center
        }

        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            align-self: center;
            justify-self: center
        }

        div:where(.swal2-container).swal2-center-end>.swal2-popup,
        div:where(.swal2-container).swal2-center-right>.swal2-popup {
            grid-column: 3;
            grid-row: 2;
            align-self: center;
            justify-self: end
        }

        div:where(.swal2-container).swal2-bottom-start>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-left>.swal2-popup {
            grid-column: 1;
            grid-row: 3;
            align-self: end
        }

        div:where(.swal2-container).swal2-bottom>.swal2-popup {
            grid-column: 2;
            grid-row: 3;
            justify-self: center;
            align-self: end
        }

        div:where(.swal2-container).swal2-bottom-end>.swal2-popup,
        div:where(.swal2-container).swal2-bottom-right>.swal2-popup {
            grid-column: 3;
            grid-row: 3;
            align-self: end;
            justify-self: end
        }

        div:where(.swal2-container).swal2-grow-row>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-column: 1/4;
            width: 100%
        }

        div:where(.swal2-container).swal2-grow-column>.swal2-popup,
        div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
            grid-row: 1/4;
            align-self: stretch
        }

        div:where(.swal2-container).swal2-no-transition {
            transition: none !important
        }

        div:where(.swal2-container) div:where(.swal2-popup) {
            display: none;
            position: relative;
            box-sizing: border-box;
            grid-template-columns: minmax(0, 100%);
            width: 32em;
            max-width: 100%;
            padding: 0 0 1.25em;
            border: none;
            border-radius: 5px;
            background: #fff;
            color: #545454;
            font-family: inherit;
            font-size: 1rem
        }

        div:where(.swal2-container) div:where(.swal2-popup):focus {
            outline: none
        }

        div:where(.swal2-container) div:where(.swal2-popup).swal2-loading {
            overflow-y: hidden
        }

        div:where(.swal2-container) h2:where(.swal2-title) {
            position: relative;
            max-width: 100%;
            margin: 0;
            padding: .8em 1em 0;
            color: inherit;
            font-size: 1.875em;
            font-weight: 600;
            text-align: center;
            text-transform: none;
            word-wrap: break-word
        }

        div:where(.swal2-container) div:where(.swal2-actions) {
            display: flex;
            z-index: 1;
            box-sizing: border-box;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: auto;
            margin: 1.25em auto 0;
            padding: 0
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled] {
            opacity: .4
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover {
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))
        }

        div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active {
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))
        }

        div:where(.swal2-container) div:where(.swal2-loader) {
            display: none;
            align-items: center;
            justify-content: center;
            width: 2.2em;
            height: 2.2em;
            margin: 0 1.875em;
            animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
            border-width: .25em;
            border-style: solid;
            border-radius: 100%;
            border-color: #2778c4 rgba(0, 0, 0, 0) #2778c4 rgba(0, 0, 0, 0)
        }

        div:where(.swal2-container) button:where(.swal2-styled) {
            margin: .3125em;
            padding: .625em 1.1em;
            transition: box-shadow .1s;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0);
            font-weight: 500
        }

        div:where(.swal2-container) button:where(.swal2-styled):not([disabled]) {
            cursor: pointer
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #7066e0;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(112, 102, 224, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #dc3741;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus {
            box-shadow: 0 0 0 3px rgba(220, 55, 65, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
            border: 0;
            border-radius: .25em;
            background: initial;
            background-color: #6e7881;
            color: #fff;
            font-size: 1em
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus {
            box-shadow: 0 0 0 3px rgba(110, 120, 129, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
            box-shadow: 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-styled):focus {
            outline: none
        }

        div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) div:where(.swal2-footer) {
            margin: 1em 0 0;
            padding: 1em 1em 0;
            border-top: 1px solid #eee;
            color: inherit;
            font-size: 1em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-timer-progress-bar-container {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            grid-column: auto !important;
            overflow: hidden;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px
        }

        div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
            width: 100%;
            height: .25em;
            background: rgba(0, 0, 0, .2)
        }

        div:where(.swal2-container) img:where(.swal2-image) {
            max-width: 100%;
            margin: 2em auto 1em
        }

        div:where(.swal2-container) button:where(.swal2-close) {
            z-index: 2;
            align-items: center;
            justify-content: center;
            width: 1.2em;
            height: 1.2em;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: -1.2em;
            padding: 0;
            overflow: hidden;
            transition: color .1s, box-shadow .1s;
            border: none;
            border-radius: 5px;
            background: rgba(0, 0, 0, 0);
            color: #ccc;
            font-family: monospace;
            font-size: 2.5em;
            cursor: pointer;
            justify-self: end
        }

        div:where(.swal2-container) button:where(.swal2-close):hover {
            transform: none;
            background: rgba(0, 0, 0, 0);
            color: #f27474
        }

        div:where(.swal2-container) button:where(.swal2-close):focus {
            outline: none;
            box-shadow: inset 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner {
            border: 0
        }

        div:where(.swal2-container) .swal2-html-container {
            z-index: 1;
            justify-content: center;
            margin: 1em 1.6em .3em;
            padding: 0;
            overflow: auto;
            color: inherit;
            font-size: 1.125em;
            font-weight: normal;
            line-height: normal;
            text-align: center;
            word-wrap: break-word;
            word-break: break-word
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea),
        div:where(.swal2-container) select:where(.swal2-select),
        div:where(.swal2-container) div:where(.swal2-radio),
        div:where(.swal2-container) label:where(.swal2-checkbox) {
            margin: 1em 2em 3px
        }

        div:where(.swal2-container) input:where(.swal2-input),
        div:where(.swal2-container) input:where(.swal2-file),
        div:where(.swal2-container) textarea:where(.swal2-textarea) {
            box-sizing: border-box;
            width: auto;
            transition: border-color .1s, box-shadow .1s;
            border: 1px solid #d9d9d9;
            border-radius: .1875em;
            background: rgba(0, 0, 0, 0);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,
        div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,
        div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror {
            border-color: #f27474 !important;
            box-shadow: 0 0 2px #f27474 !important
        }

        div:where(.swal2-container) input:where(.swal2-input):focus,
        div:where(.swal2-container) input:where(.swal2-file):focus,
        div:where(.swal2-container) textarea:where(.swal2-textarea):focus {
            border: 1px solid #b4dbed;
            outline: none;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(100, 150, 200, .5)
        }

        div:where(.swal2-container) input:where(.swal2-input)::placeholder,
        div:where(.swal2-container) input:where(.swal2-file)::placeholder,
        div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder {
            color: #ccc
        }

        div:where(.swal2-container) .swal2-range {
            margin: 1em 2em 3px;
            background: #fff
        }

        div:where(.swal2-container) .swal2-range input {
            width: 80%
        }

        div:where(.swal2-container) .swal2-range output {
            width: 20%;
            color: inherit;
            font-weight: 600;
            text-align: center
        }

        div:where(.swal2-container) .swal2-range input,
        div:where(.swal2-container) .swal2-range output {
            height: 2.625em;
            padding: 0;
            font-size: 1.125em;
            line-height: 2.625em
        }

        div:where(.swal2-container) .swal2-input {
            height: 2.625em;
            padding: 0 .75em
        }

        div:where(.swal2-container) .swal2-file {
            width: 75%;
            margin-right: auto;
            margin-left: auto;
            background: rgba(0, 0, 0, 0);
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-textarea {
            height: 6.75em;
            padding: .75em
        }

        div:where(.swal2-container) .swal2-select {
            min-width: 50%;
            max-width: 100%;
            padding: .375em .625em;
            background: rgba(0, 0, 0, 0);
            color: inherit;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio,
        div:where(.swal2-container) .swal2-checkbox {
            align-items: center;
            justify-content: center;
            background: #fff;
            color: inherit
        }

        div:where(.swal2-container) .swal2-radio label,
        div:where(.swal2-container) .swal2-checkbox label {
            margin: 0 .6em;
            font-size: 1.125em
        }

        div:where(.swal2-container) .swal2-radio input,
        div:where(.swal2-container) .swal2-checkbox input {
            flex-shrink: 0;
            margin: 0 .4em
        }

        div:where(.swal2-container) label:where(.swal2-input-label) {
            display: flex;
            justify-content: center;
            margin: 1em auto 0
        }

        div:where(.swal2-container) div:where(.swal2-validation-message) {
            align-items: center;
            justify-content: center;
            margin: 1em 0 0;
            padding: .625em;
            overflow: hidden;
            background: #f0f0f0;
            color: #666;
            font-size: 1em;
            font-weight: 300
        }

        div:where(.swal2-container) div:where(.swal2-validation-message)::before {
            content: "!";
            display: inline-block;
            width: 1.5em;
            min-width: 1.5em;
            height: 1.5em;
            margin: 0 .625em;
            border-radius: 50%;
            background-color: #f27474;
            color: #fff;
            font-weight: 600;
            line-height: 1.5em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps {
            flex-wrap: wrap;
            align-items: center;
            max-width: 100%;
            margin: 1.25em auto;
            padding: 0;
            background: rgba(0, 0, 0, 0);
            font-weight: 600
        }

        div:where(.swal2-container) .swal2-progress-steps li {
            display: inline-block;
            position: relative
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step {
            z-index: 20;
            flex-shrink: 0;
            width: 2em;
            height: 2em;
            border-radius: 2em;
            background: #2778c4;
            color: #fff;
            line-height: 2em;
            text-align: center
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
            background: #2778c4
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step {
            background: #add8e6;
            color: #fff
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
            background: #add8e6
        }

        div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line {
            z-index: 10;
            flex-shrink: 0;
            width: 2.5em;
            height: .4em;
            margin: 0 -1px;
            background: #2778c4
        }

        div:where(.swal2-icon) {
            position: relative;
            box-sizing: content-box;
            justify-content: center;
            width: 5em;
            height: 5em;
            margin: 2.5em auto .6em;
            border: 0.25em solid rgba(0, 0, 0, 0);
            border-radius: 50%;
            border-color: #000;
            font-family: inherit;
            line-height: 5em;
            cursor: default;
            user-select: none
        }

        div:where(.swal2-icon) .swal2-icon-content {
            display: flex;
            align-items: center;
            font-size: 3.75em
        }

        div:where(.swal2-icon).swal2-error {
            border-color: #f27474;
            color: #f27474
        }

        div:where(.swal2-icon).swal2-error .swal2-x-mark {
            position: relative;
            flex-grow: 1
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
            display: block;
            position: absolute;
            top: 2.3125em;
            width: 2.9375em;
            height: .3125em;
            border-radius: .125em;
            background-color: #f27474
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
            left: 1.0625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
            right: 1em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            animation: swal2-animate-error-x-mark .5s
        }

        div:where(.swal2-icon).swal2-warning {
            border-color: #facea8;
            color: #f8bb86
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .5s
        }

        div:where(.swal2-icon).swal2-info {
            border-color: #9de0f6;
            color: #3fc3ee
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-i-mark .8s
        }

        div:where(.swal2-icon).swal2-question {
            border-color: #c9dae1;
            color: #87adbd
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show {
            animation: swal2-animate-error-icon .5s
        }

        div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content {
            animation: swal2-animate-question-mark .8s
        }

        div:where(.swal2-icon).swal2-success {
            border-color: #a5dc86;
            color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line] {
            position: absolute;
            width: 3.75em;
            height: 7.5em;
            transform: rotate(45deg);
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
            top: -0.4375em;
            left: -2.0635em;
            transform: rotate(-45deg);
            transform-origin: 3.75em 3.75em;
            border-radius: 7.5em 0 0 7.5em
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right] {
            top: -0.6875em;
            left: 1.875em;
            transform: rotate(-45deg);
            transform-origin: 0 3.75em;
            border-radius: 0 7.5em 7.5em 0
        }

        div:where(.swal2-icon).swal2-success .swal2-success-ring {
            position: absolute;
            z-index: 2;
            top: -0.25em;
            left: -0.25em;
            box-sizing: content-box;
            width: 100%;
            height: 100%;
            border: .25em solid rgba(165, 220, 134, .3);
            border-radius: 50%
        }

        div:where(.swal2-icon).swal2-success .swal2-success-fix {
            position: absolute;
            z-index: 1;
            top: .5em;
            left: 1.625em;
            width: .4375em;
            height: 5.625em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
            display: block;
            position: absolute;
            z-index: 2;
            height: .3125em;
            border-radius: .125em;
            background-color: #a5dc86
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip] {
            top: 2.875em;
            left: .8125em;
            width: 1.5625em;
            transform: rotate(45deg)
        }

        div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long] {
            top: 2.375em;
            right: .5em;
            width: 2.9375em;
            transform: rotate(-45deg)
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
            animation: swal2-animate-success-line-tip .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
            animation: swal2-animate-success-line-long .75s
        }

        div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
            animation: swal2-rotate-success-circular-line 4.25s ease-in
        }

        [class^=swal2] {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        .swal2-show {
            animation: swal2-show .3s
        }

        .swal2-hide {
            animation: swal2-hide .15s forwards
        }

        .swal2-noanimation {
            transition: none
        }

        .swal2-scrollbar-measure {
            position: absolute;
            top: -9999px;
            width: 50px;
            height: 50px;
            overflow: scroll
        }

        .swal2-rtl .swal2-close {
            margin-right: initial;
            margin-left: 0
        }

        .swal2-rtl .swal2-timer-progress-bar {
            right: 0;
            left: auto
        }

        @keyframes swal2-toast-show {
            0% {
                transform: translateY(-0.625em) rotateZ(2deg)
            }

            33% {
                transform: translateY(0) rotateZ(-2deg)
            }

            66% {
                transform: translateY(0.3125em) rotateZ(2deg)
            }

            100% {
                transform: translateY(0) rotateZ(0deg)
            }
        }

        @keyframes swal2-toast-hide {
            100% {
                transform: rotateZ(1deg);
                opacity: 0
            }
        }

        @keyframes swal2-toast-animate-success-line-tip {
            0% {
                top: .5625em;
                left: .0625em;
                width: 0
            }

            54% {
                top: .125em;
                left: .125em;
                width: 0
            }

            70% {
                top: .625em;
                left: -0.25em;
                width: 1.625em
            }

            84% {
                top: 1.0625em;
                left: .75em;
                width: .5em
            }

            100% {
                top: 1.125em;
                left: .1875em;
                width: .75em
            }
        }

        @keyframes swal2-toast-animate-success-line-long {
            0% {
                top: 1.625em;
                right: 1.375em;
                width: 0
            }

            65% {
                top: 1.25em;
                right: .9375em;
                width: 0
            }

            84% {
                top: .9375em;
                right: 0;
                width: 1.125em
            }

            100% {
                top: .9375em;
                right: .1875em;
                width: 1.375em
            }
        }

        @keyframes swal2-show {
            0% {
                transform: scale(0.7)
            }

            45% {
                transform: scale(1.05)
            }

            80% {
                transform: scale(0.95)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes swal2-hide {
            0% {
                transform: scale(1);
                opacity: 1
            }

            100% {
                transform: scale(0.5);
                opacity: 0
            }
        }

        @keyframes swal2-animate-success-line-tip {
            0% {
                top: 1.1875em;
                left: .0625em;
                width: 0
            }

            54% {
                top: 1.0625em;
                left: .125em;
                width: 0
            }

            70% {
                top: 2.1875em;
                left: -0.375em;
                width: 3.125em
            }

            84% {
                top: 3em;
                left: 1.3125em;
                width: 1.0625em
            }

            100% {
                top: 2.8125em;
                left: .8125em;
                width: 1.5625em
            }
        }

        @keyframes swal2-animate-success-line-long {
            0% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            65% {
                top: 3.375em;
                right: 2.875em;
                width: 0
            }

            84% {
                top: 2.1875em;
                right: 0;
                width: 3.4375em
            }

            100% {
                top: 2.375em;
                right: .5em;
                width: 2.9375em
            }
        }

        @keyframes swal2-rotate-success-circular-line {
            0% {
                transform: rotate(-45deg)
            }

            5% {
                transform: rotate(-45deg)
            }

            12% {
                transform: rotate(-405deg)
            }

            100% {
                transform: rotate(-405deg)
            }
        }

        @keyframes swal2-animate-error-x-mark {
            0% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            50% {
                margin-top: 1.625em;
                transform: scale(0.4);
                opacity: 0
            }

            80% {
                margin-top: -0.375em;
                transform: scale(1.15)
            }

            100% {
                margin-top: 0;
                transform: scale(1);
                opacity: 1
            }
        }

        @keyframes swal2-animate-error-icon {
            0% {
                transform: rotateX(100deg);
                opacity: 0
            }

            100% {
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @keyframes swal2-rotate-loading {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        @keyframes swal2-animate-question-mark {
            0% {
                transform: rotateY(-360deg)
            }

            100% {
                transform: rotateY(0)
            }
        }

        @keyframes swal2-animate-i-mark {
            0% {
                transform: rotateZ(45deg);
                opacity: 0
            }

            25% {
                transform: rotateZ(-25deg);
                opacity: .4
            }

            50% {
                transform: rotateZ(15deg);
                opacity: .8
            }

            75% {
                transform: rotateZ(-5deg);
                opacity: 1
            }

            100% {
                transform: rotateX(0);
                opacity: 1
            }
        }

        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            overflow: hidden
        }

        body.swal2-height-auto {
            height: auto !important
        }

        body.swal2-no-backdrop .swal2-container {
            background-color: rgba(0, 0, 0, 0) !important;
            pointer-events: none
        }

        body.swal2-no-backdrop .swal2-container .swal2-popup {
            pointer-events: all
        }

        body.swal2-no-backdrop .swal2-container .swal2-modal {
            box-shadow: 0 0 10px rgba(0, 0, 0, .4)
        }

        @media print {
            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
                overflow-y: scroll !important
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true] {
                display: none
            }

            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
                position: static !important
            }
        }

        body.swal2-toast-shown .swal2-container {
            box-sizing: border-box;
            width: 360px;
            max-width: 100%;
            background-color: rgba(0, 0, 0, 0);
            pointer-events: none
        }

        body.swal2-toast-shown .swal2-container.swal2-top {
            inset: 0 auto auto 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-top-end,
        body.swal2-toast-shown .swal2-container.swal2-top-right {
            inset: 0 0 auto auto
        }

        body.swal2-toast-shown .swal2-container.swal2-top-start,
        body.swal2-toast-shown .swal2-container.swal2-top-left {
            inset: 0 auto auto 0
        }

        body.swal2-toast-shown .swal2-container.swal2-center-start,
        body.swal2-toast-shown .swal2-container.swal2-center-left {
            inset: 50% auto auto 0;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center {
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-center-end,
        body.swal2-toast-shown .swal2-container.swal2-center-right {
            inset: 50% 0 auto auto;
            transform: translateY(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-start,
        body.swal2-toast-shown .swal2-container.swal2-bottom-left {
            inset: auto auto 0 0
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom {
            inset: auto auto 0 50%;
            transform: translateX(-50%)
        }

        body.swal2-toast-shown .swal2-container.swal2-bottom-end,
        body.swal2-toast-shown .swal2-container.swal2-bottom-right {
            inset: auto 0 0 auto
        }
    </style>

</head>

{!! DataSite('script_header') !!}
</head>

<body class="pace-done" style="" data-select2-id="select2-data-117-4a60">
    <div class="pace pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99"
            style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="border-bottom border-block-end-dashed">
                <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                    <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab"
                        data-bs-target="#switcher-home" type="button" role="tab" aria-controls="switcher-home"
                        aria-selected="true">Theme
                        Styles</button>
                    <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#switcher-profile" type="button" role="tab"
                        aria-controls="switcher-profile" aria-selected="false" tabindex="-1">Theme
                        Colors</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel"
                    aria-labelledby="switcher-home-tab" tabindex="0">
                    <div class="">
                        <p class="switcher-style-head">Theme Color Mode:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-light-theme">
                                        Light
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style"
                                        id="switcher-light-theme" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-dark-theme">
                                        Dark
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style"
                                        id="switcher-dark-theme">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Directions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-ltr">
                                        LTR
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction"
                                        id="switcher-ltr" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-rtl">
                                        RTL
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction"
                                        id="switcher-rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Navigation Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-vertical">
                                        Vertical
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style"
                                        id="switcher-vertical" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-horizontal">
                                        Horizontal
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style"
                                        id="switcher-horizontal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-menu-styles">
                        <p class="switcher-style-head">Vertical &amp; Horizontal Menu Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-click">
                                        Menu Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-hover">
                                        Menu Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-hover">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-click">
                                        Icon Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-hover">
                                        Icon Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-hover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidemenu-layout-styles">
                        <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-default-menu">
                                        Default Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-default-menu" checked="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-closed-menu">
                                        Closed Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-closed-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icontext-menu">
                                        Icon Text
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icontext-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-overlay">
                                        Icon Overlay
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icon-overlay">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-detached">
                                        Detached
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-detached">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-double-menu">
                                        Double Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-double-menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Page Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-regular">
                                        Regular
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-regular" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-classic">
                                        Classic
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-classic">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-modern">
                                        Modern
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles"
                                        id="switcher-modern">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Layout Width Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-full-width">
                                        Full Width
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width"
                                        id="switcher-full-width" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-boxed">
                                        Boxed
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width"
                                        id="switcher-boxed">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Menu Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions"
                                        id="switcher-menu-fixed" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions"
                                        id="switcher-menu-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Header Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-fixed" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Loader:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-enable">
                                        Enable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-enable" checked="">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-disable">
                                        Disable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-disable" checked="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel"
                    aria-labelledby="switcher-profile-tab" tabindex="0">
                    <div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Menu Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="menu-colors"
                                        id="switcher-menu-light" checked="" aria-label="Light Menu"
                                        data-bs-original-title="Light Menu">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="menu-colors"
                                        id="switcher-menu-dark" aria-label="Dark Menu"
                                        data-bs-original-title="Dark Menu">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="menu-colors"
                                        id="switcher-menu-primary" aria-label="Color Menu"
                                        data-bs-original-title="Color Menu">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                        data-bs-toggle="tooltip" data-bs-placement="top" type="radio"
                                        name="menu-colors" id="switcher-menu-gradient" aria-label="Gradient Menu"
                                        data-bs-original-title="Gradient Menu">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                        data-bs-toggle="tooltip" data-bs-placement="top" type="radio"
                                        name="menu-colors" id="switcher-menu-transparent"
                                        aria-label="Transparent Menu" data-bs-original-title="Transparent Menu">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Header Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="header-colors"
                                        id="switcher-header-light" checked="" aria-label="Light Header"
                                        data-bs-original-title="Light Header">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="header-colors"
                                        id="switcher-header-dark" aria-label="Dark Header"
                                        data-bs-original-title="Dark Header">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" type="radio" name="header-colors"
                                        id="switcher-header-primary" aria-label="Color Header"
                                        data-bs-original-title="Color Header">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                        data-bs-toggle="tooltip" data-bs-placement="top" type="radio"
                                        name="header-colors" id="switcher-header-gradient"
                                        aria-label="Gradient Header" data-bs-original-title="Gradient Header">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                        data-bs-toggle="tooltip" data-bs-placement="top" type="radio"
                                        name="header-colors" id="switcher-header-transparent"
                                        aria-label="Transparent Header" data-bs-original-title="Transparent Header">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Primary:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-1" type="radio"
                                        name="theme-primary" id="switcher-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-2" type="radio"
                                        name="theme-primary" id="switcher-primary1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-3" type="radio"
                                        name="theme-primary" id="switcher-primary2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-4" type="radio"
                                        name="theme-primary" id="switcher-primary3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-5" type="radio"
                                        name="theme-primary" id="switcher-primary4">
                                </div>
                                <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                    <div class="theme-container-primary"><button class="">nano</button></div>
                                    <div class="pickr-container-primary">
                                        <div class="pickr">

                                            <button type="button" class="pcr-button" role="button"
                                                aria-label="toggle color picker dialog"
                                                style="--pcr-color: rgba(98, 89, 202, 1);"></button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Background:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-1" type="radio"
                                        name="theme-background" id="switcher-background">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-2" type="radio"
                                        name="theme-background" id="switcher-background1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-3" type="radio"
                                        name="theme-background" id="switcher-background2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-4" type="radio"
                                        name="theme-background" id="switcher-background3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-5" type="radio"
                                        name="theme-background" id="switcher-background4">
                                </div>
                                <div
                                    class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                    <div class="theme-container-background"><button>nano</button></div>
                                    <div class="pickr-container-background">
                                        <div class="pickr">

                                            <button type="button" class="pcr-button" role="button"
                                                aria-label="toggle color picker dialog"
                                                style="--pcr-color: rgba(98, 89, 202, 1);"></button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-image mb-3">
                            <p class="switcher-style-head">Menu With Background Image:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img1" type="radio"
                                        name="theme-background" id="switcher-bg-img">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img2" type="radio"
                                        name="theme-background" id="switcher-bg-img1">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img3" type="radio"
                                        name="theme-background" id="switcher-bg-img2">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img4" type="radio"
                                        name="theme-background" id="switcher-bg-img3">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img5" type="radio"
                                        name="theme-background" id="switcher-bg-img4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid canvas-footer">
                    <a href="javascript:void(0);" id="reset-all" class="btn btn-danger btn-block m-1">Reset</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->

    <!-- Loader -->
    <div id="loader" class="d-none">
        <img src="{{ asset('assets/images/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page" data-select2-id="select2-data-116-zply">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->


                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle mx-0 my-auto"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>

                <!-- Start::header-content-right -->
                <div class="header-content-right">
                    <div class="header-element d-flex align-items-center justify-content-center">
                        <!-- Start::header-link|layout-setting -->
                        <a class="header-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <span class="light-layout d-flex align-items-center justify-content-center">
                                <!-- Start::header-link-icon -->
                                <i class="fa-solid fa-bell"></i>
                                <!-- End::header-link-icon -->
                            </span>
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </div>

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <a href="javascript:void(0);" class="header-link dropdown-toggle"
                            data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            @if (Auth::user()->lang == 'vi')
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/vn.svg"
                                    alt="img" width="20">
                            @elseif (Auth::user()->lang == 'en')
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/us.svg"
                                    alt="img" width="20">
                            @else
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/{{ Auth::user()->lang }}.svg"
                                    alt="img" width="20">
                            @endif
                        </a>
                        <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" style="max-width: 200px">
                            @foreach (['vi' => 'Tiếng Việt', 'en' => 'English', 'th' => 'Thai', 'fr' => 'French', 'jp' => 'Japanese', 'kr' => 'Korean', 'de' => 'German', 'es' => 'Spanish', 'it' => 'Italian'] as $code => $language)
                                <li title="{{ session('locale') == $code ? $language : __('Unknown Language') }}">
                                    <a class="dropdown-item d-flex align-items-center {{ session('locale') == $code ? 'active' : '' }}"
                                        href="javascript:void(0);" data-locale="{{ $code }}">
                                        <span class="avatar avatar-xs lh-1 me-2">
                                            @if ($code == 'vi')
                                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/vn.svg"
                                                    alt="{{ $language }}">
                                            @elseif ($code == 'en')
                                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/us.svg"
                                                    alt="{{ $language }}">
                                            @else
                                                <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/flags/4x3/{{ $code }}.svg"
                                                    alt="{{ $language }}">
                                            @endif
                                        </span>
                                        {{ $language }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>


                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('.dropdown-item').on('click', function() {
                                    var locale = $(this).data('locale');
                                    $.ajax({
                                        url: '{{ route('set-locale') }}',
                                        method: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            locale: locale
                                        },
                                        success: function(response) {
                                            location.reload(); // Tải lại trang để áp dụng ngôn ngữ mới
                                        }
                                    });
                                });
                            });
                        </script>




                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="javascript:void(0);" class="header-link dropdown-toggle"
                                data-bs-auto-close="outside" data-bs-toggle="dropdown">
                                <i class="fa fa-dollar-sign header-link-icon"></i>
                                <span class="pulse-danger"></span>
                            </a>
                            <!-- End::header-link|dropdown-toggle -->
                            <!-- Start::main-header-dropdown -->
                            <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                                data-popper-placement="none">
                                <div class="p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0 fs-17 fw-semibold">Chọn loại tiền tệ</p>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>

                                <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                    <form action="{{ route('update.balance') }}" method="POST" id="currencyForm">
                                        @csrf
                                        <input type="hidden" name="currency_code" id="currency_code">
                                        <input type="hidden" name="currency_symbol" id="currency_symbol">
                                
                                        @foreach($currencies as $currency)
                                            <li class="dropdown-item cursor-pointer" onclick="setCurrency('{{ $currency->currency_code }}', '{{ $currency->currency_symbol }}')">
                                                <div class="d-flex align-items-start">
                                                    <div class="pe-2">
                                                        <span class="avatar avatar-md bg-primary box-shadow-primary avatar-rounded">
                                                            {{ $currency->currency_code }}
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <p class="mb-0 fw-semibold">{{ $currency->currency_name }}</p>
                                                            <span class="text-muted fw-normal fs-12 header-notification-text">{{ $currency->currency_code }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </form>
                                </ul>
                                

                                <script>
                                    function setCurrency(currencyCode, currencySymbol) {
                                        // Gán giá trị vào các input ẩn trong form
                                        document.getElementById('currency_code').value = currencyCode;
                                        document.getElementById('currency_symbol').value = currencySymbol;

                                        // Gửi form để cập nhật loại tiền tệ
                                        document.getElementById('currencyForm').submit();
                                    }
                                </script>

                                <script>
                                    function setCurrency(currencyCode, currencySymbol) {
                                        // Gán giá trị vào các input ẩn trong form
                                        document.getElementById('currency_code').value = currencyCode;
                                        document.getElementById('currency_symbol').value = currencySymbol;

                                        // Gửi form để cập nhật loại tiền tệ
                                        document.getElementById('currencyForm').submit();
                                    }
                                </script>



                                <div class="p-5 empty-item1 d-none">
                                    <div class="text-center">
                                        <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                            <i class="ri-notification-off-line fs-2"></i>
                                        </span>
                                        <h6 class="fw-semibold mt-3">Không có loại tiền tệ thay thế</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- End::main-header-dropdown -->
                        </div>
                        <!-- End::header-element -->

                        <!-- Start::header-element -->
                        <div class="header-element header-theme-mode">
                            <!-- Start::header-link|layout-setting -->
                            <a href="javascript:void(0);" class="header-link layout-setting">
                                <span class="light-layout">
                                    <!-- Start::header-link-icon -->
                                    <i class="fa-solid fa-cloud-moon"></i>
                                    <!-- End::header-link-icon -->
                                </span>
                                <span class="dark-layout">
                                    <!-- Start::header-link-icon -->
                                    <i class="fa-regular fa-sun"></i>
                                    <!-- End::header-link-icon -->
                                </span>
                            </a>
                            <!-- End::header-link|layout-setting -->
                        </div>
                        <!-- End::header-element -->


                        <!-- Start::header-element -->
                        <div class="header-element profile-1">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="#" class=" dropdown-toggle leading-none d-flex px-1"
                                id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <img src="{{ DataSite('logo_mini') }}" alt="img"
                                            class="rounded-circle avatar  profile-user brround cover-image">
                                    </div>
                                </div>
                            </a>
                            <!-- End::header-link|dropdown-toggle -->
                            <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                                aria-labelledby="mainHeaderProfile">
                                <li>
                                    <a class="btn btn-link d-flex align-items-center no-underline"
                                        href="{{ route('recharge.transfer') }}">
                                        <i class="ti ti-credit-card fs-18 me-2 op-7"></i>{{ __('recharge') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-link d-flex align-items-center no-underline"
                                        href="{{ route('profile') }}">
                                        <i class="ti ti-user-circle fs-18 me-2 op-7"></i>{{ __('profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-link d-flex align-items-center no-underline"
                                        href="{{ route('logout') }}">
                                        <i class="ti ti-logout fs-18 me-2 op-7"></i>{{ __('logout') }}
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <!-- End::header-content-right -->

                </div>
                <!-- End::main-header-container -->
                {!! DataSite('script_header') !!}
        </header>
        <style>
            html:not([data-theme-mode="dark"]) {
                .slide__category {
                    padding: 10px 20px;
                    background-color: #F1F1F1;
                    border-radius: 0 10px 10px 0;
                }
            }

            /* Loại bỏ dấu gạch chân cho thẻ <a> trong danh sách */
            .header-profile-dropdown .no-underline {
                text-decoration: none;
                color: inherit;
                /* Đảm bảo màu chữ giống như phần còn lại của văn bản nếu cần */
            }

            /* Thay đổi màu khi di chuột qua liên kết */
            .header-profile-dropdown .no-underline:hover {
                color: #007bff;
                /* Thay đổi màu chữ khi hover nếu cần */
            }
        </style>
        @if ($effect == 1)
            @include('Effect.noen')
        @endif
