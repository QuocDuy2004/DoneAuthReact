<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" loader="disable" data-vertical-style="overlay">

<head>

    <!-- Meta Data -->
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
    @yield('css')
    
    <!-- Favicon -->
    <link rel="icon" href="//smmpanel-v3.baocms.net//_assets/images/brand-logos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">

    <!-- Choices JS -->
    <script src="//smmpanel-v3.baocms.net//_assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="//smmpanel-v3.baocms.net//_assets/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="//smmpanel-v3.baocms.net//_assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style Css -->
    <link href="//smmpanel-v3.baocms.net//_assets/css/styles.min.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="//smmpanel-v3.baocms.net//_assets/css/icons.css" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="//smmpanel-v3.baocms.net//_assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="//smmpanel-v3.baocms.net//_assets/libs/simplebar/simplebar.min.css" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="//smmpanel-v3.baocms.net//_assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="//smmpanel-v3.baocms.net//_assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet"
        href="//smmpanel-v3.baocms.net//_assets/libs/choices.js/public/assets/styles/choices.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&amp;display=swap" rel="stylesheet">

    <!-- Extra Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

    <!-- CoreJS -->
   

    <link rel="preload" as="style" href="https://smmpanel-v3.baocms.net/build/assets/app-DjhSsAid.css">
    <link rel="modulepreload" href="https://smmpanel-v3.baocms.net/build/assets/app-Bj6L1pPD.js">
    <link rel="stylesheet" href="https://smmpanel-v3.baocms.net/build/assets/app-DjhSsAid.css">
    <script type="module" src="https://smmpanel-v3.baocms.net/build/assets/app-Bj6L1pPD.js"></script>
    
    <!-- extra style -->
    <style>
        * {
            font-family: 'Archivo', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="//smmpanel-v3.baocms.net//_assets/libs/jsvectormap/css/jsvectormap.min.css">

    <link rel="stylesheet" href="//smmpanel-v3.baocms.net//_assets/libs/swiper/swiper-bundle.min.css">

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
    <style id="apexcharts-css">
        @keyframes opaque {
            0% {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes resizeanim {

            0%,
            to {
                opacity: 0
            }
        }

        .apexcharts-canvas {
            position: relative;
            user-select: none
        }

        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5)
        }

        .apexcharts-inner {
            position: relative
        }

        .apexcharts-text tspan {
            font-family: inherit
        }

        .legend-mouseover-inactive {
            transition: .15s ease all;
            opacity: .2
        }

        .apexcharts-legend-text {
            padding-left: 15px;
            margin-left: -15px;
        }

        .apexcharts-series-collapsed {
            opacity: 0
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: .15s ease all
        }

        .apexcharts-tooltip.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }

        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, .96)
        }

        .apexcharts-tooltip.apexcharts-theme-dark {
            color: #fff;
            background: rgba(30, 30, 30, .8)
        }

        .apexcharts-tooltip * {
            font-family: inherit
        }

        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px
        }

        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #eceff1;
            border-bottom: 1px solid #ddd
        }

        .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, .7);
            border-bottom: 1px solid #333
        }

        .apexcharts-tooltip-text-goals-value,
        .apexcharts-tooltip-text-y-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            margin-left: 5px;
            font-weight: 600
        }

        .apexcharts-tooltip-text-goals-label:empty,
        .apexcharts-tooltip-text-goals-value:empty,
        .apexcharts-tooltip-text-y-label:empty,
        .apexcharts-tooltip-text-y-value:empty,
        .apexcharts-tooltip-text-z-value:empty,
        .apexcharts-tooltip-title:empty {
            display: none
        }

        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            padding: 6px 0 5px
        }

        .apexcharts-tooltip-goals-group,
        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            display: flex
        }

        .apexcharts-tooltip-text-goals-label:not(:empty),
        .apexcharts-tooltip-text-goals-value:not(:empty) {
            margin-top: -6px
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0;
            margin-right: 10px;
            border-radius: 50%
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center
        }

        .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
            opacity: 1
        }

        .apexcharts-tooltip-series-group.apexcharts-active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px
        }

        .apexcharts-tooltip-series-group-hidden {
            opacity: 0;
            height: 0;
            line-height: 0;
            padding: 0 !important
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px
        }

        .apexcharts-custom-tooltip,
        .apexcharts-tooltip-box {
            padding: 4px 8px
        }

        .apexcharts-tooltip-boxPlot {
            display: flex;
            flex-direction: column-reverse
        }

        .apexcharts-tooltip-box>div {
            margin: 4px 0
        }

        .apexcharts-tooltip-box span.value {
            font-weight: 700
        }

        .apexcharts-tooltip-rangebar {
            padding: 5px 8px
        }

        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777
        }

        .apexcharts-tooltip-rangebar .series-name {
            font-weight: 700;
            display: block;
            margin-bottom: 5px
        }

        .apexcharts-xaxistooltip,
        .apexcharts-yaxistooltip {
            opacity: 0;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #eceff1;
            border: 1px solid #90a4ae
        }

        .apexcharts-xaxistooltip {
            padding: 9px 10px;
            transition: .15s ease all
        }

        .apexcharts-xaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, .7);
            border: 1px solid rgba(0, 0, 0, .5);
            color: #fff
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none
        }

        .apexcharts-xaxistooltip:after {
            border-color: transparent;
            border-width: 6px;
            margin-left: -6px
        }

        .apexcharts-xaxistooltip:before {
            border-color: transparent;
            border-width: 7px;
            margin-left: -7px
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #eceff1
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90a4ae
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after,
        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
            border-bottom-color: rgba(0, 0, 0, .5)
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #eceff1
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90a4ae
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after,
        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
            border-top-color: rgba(0, 0, 0, .5)
        }

        .apexcharts-xaxistooltip.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }

        .apexcharts-yaxistooltip {
            padding: 4px 10px
        }

        .apexcharts-yaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, .7);
            border: 1px solid rgba(0, 0, 0, .5);
            color: #fff
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none
        }

        .apexcharts-yaxistooltip:after {
            border-color: transparent;
            border-width: 6px;
            margin-top: -6px
        }

        .apexcharts-yaxistooltip:before {
            border-color: transparent;
            border-width: 7px;
            margin-top: -7px
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #eceff1
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90a4ae
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after,
        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
            border-left-color: rgba(0, 0, 0, .5)
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #eceff1
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90a4ae
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after,
        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
            border-right-color: rgba(0, 0, 0, .5)
        }

        .apexcharts-yaxistooltip.apexcharts-active {
            opacity: 1
        }

        .apexcharts-yaxistooltip-hidden {
            display: none
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: .15s ease all
        }

        .apexcharts-xcrosshairs.apexcharts-active,
        .apexcharts-ycrosshairs.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0
        }

        .apexcharts-selection-rect {
            cursor: move
        }

        .svg_select_boundingRect,
        .svg_select_points_rot {
            pointer-events: none;
            opacity: 0;
            visibility: hidden
        }

        .apexcharts-selection-rect+g .svg_select_boundingRect,
        .apexcharts-selection-rect+g .svg_select_points_rot {
            opacity: 0;
            visibility: hidden
        }

        .apexcharts-selection-rect+g .svg_select_points_l,
        .apexcharts-selection-rect+g .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible
        }

        .svg_select_points {
            fill: #efefef;
            stroke: #333;
            rx: 2
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-svg.apexcharts-zoomable.hovering-pan {
            cursor: move
        }

        .apexcharts-menu-icon,
        .apexcharts-pan-icon,
        .apexcharts-reset-icon,
        .apexcharts-selection-icon,
        .apexcharts-toolbar-custom-icon,
        .apexcharts-zoom-icon,
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6e8192;
            text-align: center
        }

        .apexcharts-menu-icon svg,
        .apexcharts-reset-icon svg,
        .apexcharts-zoom-icon svg,
        .apexcharts-zoomin-icon svg,
        .apexcharts-zoomout-icon svg {
            fill: #6e8192
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(.76)
        }

        .apexcharts-theme-dark .apexcharts-menu-icon svg,
        .apexcharts-theme-dark .apexcharts-pan-icon svg,
        .apexcharts-theme-dark .apexcharts-reset-icon svg,
        .apexcharts-theme-dark .apexcharts-selection-icon svg,
        .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomout-icon svg {
            fill: #f3f4f5
        }

        .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg {
            fill: #008ffb
        }

        .apexcharts-theme-light .apexcharts-menu-icon:hover svg,
        .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
        .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
        .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg {
            fill: #333
        }

        .apexcharts-menu-icon,
        .apexcharts-selection-icon {
            position: relative
        }

        .apexcharts-reset-icon {
            margin-left: 5px
        }

        .apexcharts-menu-icon,
        .apexcharts-reset-icon,
        .apexcharts-zoom-icon {
            transform: scale(.85)
        }

        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            transform: scale(.7)
        }

        .apexcharts-zoomout-icon {
            margin-right: 3px
        }

        .apexcharts-pan-icon {
            transform: scale(.62);
            position: relative;
            left: 1px;
            top: 0
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6e8192;
            stroke-width: 2
        }

        .apexcharts-pan-icon.apexcharts-selected svg {
            stroke: #008ffb
        }

        .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
            stroke: #333
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0 6px 2px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: .15s ease all;
            pointer-events: none
        }

        .apexcharts-menu.apexcharts-menu-open {
            opacity: 1;
            pointer-events: all;
            transition: .15s ease all
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer
        }

        .apexcharts-theme-light .apexcharts-menu-item:hover {
            background: #eee
        }

        .apexcharts-theme-dark .apexcharts-menu {
            background: rgba(0, 0, 0, .7);
            color: #fff
        }

        @media screen and (min-width:768px) {
            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1
            }
        }

        .apexcharts-canvas .apexcharts-element-hidden,
        .apexcharts-datalabel.apexcharts-element-hidden,
        .apexcharts-hide .apexcharts-series-points {
            opacity: 0
        }

        .apexcharts-hidden-element-shown {
            opacity: 1;
            transition: 0.25s ease all;
        }

        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value,
        .apexcharts-datalabels,
        .apexcharts-pie-label {
            cursor: default;
            pointer-events: none
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: .3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease
        }

        .apexcharts-annotation-rect,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-gridline,
        .apexcharts-line,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-point-annotation-label,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon,
        .apexcharts-toolbar svg,
        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-xaxis-annotation-label,
        .apexcharts-yaxis-annotation-label,
        .apexcharts-zoom-rect {
            pointer-events: none
        }

        .apexcharts-marker {
            transition: .15s ease all
        }

        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
            height: 100%;
            width: 100%;
            overflow: hidden
        }

        .contract-trigger:before,
        .resize-triggers,
        .resize-triggers>div {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0
        }

        .resize-triggers>div {
            height: 100%;
            width: 100%;
            background: #eee;
            overflow: auto
        }

        .contract-trigger:before {
            overflow: hidden;
            width: 200%;
            height: 200%
        }

        .apexcharts-bar-goals-markers {
            pointer-events: none
        }

        .apexcharts-bar-shadows {
            pointer-events: none
        }

        .apexcharts-rangebar-goals-markers {
            pointer-events: none
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

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
 
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		 
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                

<body>

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
                    aria-selected="true">Theme Styles</button>
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
                                    id="switcher-loader-enable">
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
                                    id="switcher-menu-light" aria-label="Light Menu"
                                    data-bs-original-title="Light Menu">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                    data-bs-placement="top" type="radio" name="menu-colors"
                                    id="switcher-menu-dark" checked="" aria-label="Dark Menu"
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
                                            style="--pcr-color: rgba(132, 90, 223, 1);"></button>


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
                                            style="--pcr-color: rgba(132, 90, 223, 1);"></button>


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
                <a href="javascript:void(0);" id="reset-all" class="btn btn-danger m-1">Reset</a>
            </div>
        </div>
    </div>
</div>
<!-- End Switcher -->

<!-- Loader -->
<div id="loader" class="d-none">
    <img src="//smmpanel-v3.baocms.net//_assets/images/media/loader.svg" alt="">
</div>
<style>
    /*page-overlay*/
    #page-overlay {
        opacity: 0;
        top: 0px;
        left: 0px;
        position: fixed;
        background-color: rgba(249, 249, 249, 0.8);
        height: 100%;
        width: 100%;
        z-index: 9998;
        -webkit-transition: opacity 0.2s linear;
        -moz-transition: opacity 0.2s linear;
        transition: opacity 0.2s linear;
    }

    #page-overlay.visible {
        opacity: 1;
        display: none;
    }

    #page-overlay.visible.active,
    #page-overlay.visible.active img {
        display: block;
    }

    #page-overlay.hidden {
        opacity: 0;
        height: 0px;
        width: 0px;
        z-index: -10000;
    }

    #page-overlay .loader-wrapper-outer {
        background-color: transparent;
        z-index: 9999;
        margin: auto;
        width: 100%;
        height: 100%;
        overflow: hidden;
        display: table;
        text-align: center;
        vertical-align: middle;
    }

    #page-overlay .loader-wrapper-inner {
        display: table-cell;
        vertical-align: middle;
    }

    #page-overlay .loader {
        margin: auto;
    }

    @keyframes lds-double-ring {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes lds-double-ring {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes lds-double-ring_reverse {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }

        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    @-webkit-keyframes lds-double-ring_reverse {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }

        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    #page-overlay .lds-double-ring {
        position: relative;
    }

    #page-overlay .lds-double-ring div {
        box-sizing: border-box;
    }

    #page-overlay .lds-double-ring>div {
        position: absolute;
        width: 44px;
        height: 44px;
        top: 78px;
        left: 78px;
        border-radius: 50%;
        border: 4px solid #000;
        border-color: #2196f3 transparent #2196f3 transparent;
        -webkit-animation: lds-double-ring 1s linear infinite;
        animation: lds-double-ring 1s linear infinite;
    }

    #page-overlay .lds-double-ring>div:nth-child(2),
    #page-overlay .lds-double-ring>div:nth-child(4) {
        width: 32px;
        height: 32px;
        top: 84px;
        left: 84px;
        -webkit-animation: lds-double-ring_reverse 1s linear infinite;
        animation: lds-double-ring_reverse 1s linear infinite;
    }

    #page-overlay .lds-double-ring>div:nth-child(2) {
        border-color: transparent #2196f3 transparent #2196f3;
    }

    #page-overlay .lds-double-ring>div:nth-child(3) {
        border-color: transparent;
    }

    #page-overlay .lds-double-ring>div:nth-child(3) div {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    #page-overlay .lds-double-ring>div:nth-child(3) div:before,
    #page-overlay .lds-double-ring>div:nth-child(3) div:after {
        content: "";
        display: block;
        position: absolute;
        width: 4px;
        height: 4px;
        top: -4px;
        left: 16px;
        background: #2196f3;
        border-radius: 50%;
        box-shadow: 0 40px 0 0 #2196f3;
    }

    #page-overlay .lds-double-ring>div:nth-child(3) div:after {
        left: -4px;
        top: 16px;
        box-shadow: 40px 0 0 0 #2196f3;
    }

    #page-overlay .lds-double-ring>div:nth-child(4) {
        border-color: transparent;
    }

    #page-overlay .lds-double-ring>div:nth-child(4) div {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    #page-overlay .lds-double-ring>div:nth-child(4) div:before,
    #page-overlay .lds-double-ring>div:nth-child(4) div:after {
        content: "";
        display: block;
        position: absolute;
        width: 4px;
        height: 4px;
        top: -4px;
        left: 10px;
        background: #2196f3;
        border-radius: 50%;
        box-shadow: 0 28px 0 0 #2196f3;
    }

    #page-overlay .lds-double-ring>div:nth-child(4) div:after {
        left: -4px;
        top: 10px;
        box-shadow: 28px 0 0 0 #2196f3;
    }

    #page-overlay .lds-double-ring {
        width: 200px !important;
        height: 200px !important;
        display: inline-block;
        -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
        transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
    }
</style>

<!-- Loader -->

<div class="page">
    <!-- app-header -->
    <header class="app-header">

        <!-- Start::main-header-container -->
        <div class="main-header-container container-fluid">

            <!-- Start::header-content-left -->
            <div class="header-content-left">

                <!-- Start::header-element -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a href="https://smmpanel-v3.baocms.net/admin" class="header-logo">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/desktop-logo.png"
                                alt="logo" class="desktop-logo">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/toggle-logo.png"
                                alt="logo" class="toggle-logo">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/desktop-dark.png"
                                alt="logo" class="desktop-dark">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/toggle-dark.png"
                                alt="logo" class="toggle-dark">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/desktop-white.png"
                                alt="logo" class="desktop-white">
                            <img src="//smmpanel-v3.baocms.net//_assets/images/brand-logos/toggle-white.png"
                                alt="logo" class="toggle-white">
                        </a>
                    </div>
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element">
                    <!-- Start::header-link -->
                    <a aria-label="Hide Sidebar"
                        class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                        data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->

            </div>
            <!-- End::header-content-left -->

            <!-- Start::header-content-right -->
            <div class="header-content-right">

                <!-- Start::header-element -->
                <div class="header-element header-search">
                    <!-- Start::header-link -->
                    <a href="{{ route('home') }}" class="header-link" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="Truy cập trang khách hàng">
                        <i class="bx bx-home header-link-icon"></i>
                    </a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element header-theme-mode">
                    <!-- Start::header-link|layout-setting -->
                    <a href="javascript:void(0);" class="header-link layout-setting">
                        <span class="light-layout">
                            <!-- Start::header-link-icon -->
                            <i class="bx bx-moon header-link-icon"></i>
                            <!-- End::header-link-icon -->
                        </span>
                        <span class="dark-layout">
                            <!-- Start::header-link-icon -->
                            <i class="bx bx-sun header-link-icon"></i>
                            <!-- End::header-link-icon -->
                        </span>
                    </a>
                    <!-- End::header-link|layout-setting -->
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element header-fullscreen">
                    <!-- Start::header-link -->
                    <a onclick="openFullscreen();" href="#" class="header-link">
                        <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                        <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                    </a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="javascript:void(0)" class="header-link dropdown-toggle" id="mainHeaderProfile"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div class="me-sm-2 me-0">
                                <img src="{{ DataSite('logo_mini') }}" alt="img"
                                    width="32" height="32" class="rounded-circle">
                            </div>
                            <div class="d-sm-block d-none">
                                <p class="fw-semibold mb-0 lh-1">admin</p>
                                <span class="op-7 fw-normal d-block fs-11">Web Developer</span>
                            </div>
                        </div>
                    </a>
                    <!-- End::header-link|dropdown-toggle -->
                    <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                        aria-labelledby="mainHeaderProfile">
                        <li><a class="dropdown-item d-flex" href="{{ route('logout') }}"><i
                                    class="ti ti-logout fs-18 me-2 op-7"></i>Đăng Xuất</a></li>
                    </ul>
                </div>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <div class="header-element">
                    <!-- Start::header-link|switcher-icon -->
                    <a href="#" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                        data-bs-target="#switcher-canvas">
                        <i class="bx bx-cog header-link-icon"></i>
                    </a>
                    <!-- End::header-link|switcher-icon -->
                </div>
                <!-- End::header-element -->

            </div>
            <!-- End::header-content-right -->

        </div>
        <!-- End::main-header-container -->

    </header>