</div>

<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container d-none d-md-block">
        <span class="text-muted"> Copyright © <span id="year">2024</span> <a href="javascript:void(0);"
                class="text-dark fw-semibold">{{ DataSite('namesite') }}</a>.
            Developed by <a href="{{ DataSite('namesite') }}">
                <span class="fw-semibold text-primary text-decoration-underline">{{ DataSite('namesite') }}</span>
            </a>
        </span>
    </div>
    <div class="container d-md-none" style="font-size: 10px">
        <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                class="text-dark fw-semibold">{{ DataSite('namesite') }}</a>.
            Developed by <a href="{{ DataSite('namesite') }}">
                <span class="fw-semibold text-primary text-decoration-underline">{{ DataSite('namesite') }}</span>
            </a>
        </span>
    </div>
</footer>
<!-- Footer End -->
</div>

  <!-- Main Theme Js -->
  <script src="{{ asset('assets/js/theme.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- extra js-->
<script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"></script>

<!-- Datatables Cdn -->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/autofill/2.6.0/js/dataTables.autoFill.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.6.0/js/autoFill.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Scroll To Top -->
<div class="scrollToTop" id="back-to-top" style="display: none;">
    <i class="fa-solid fa-arrow-up fs-20"></i>
</div>

<div id="responsive-overlay"></div>
<!-- Scroll To Top -->


<!-- Popper JS -->
<script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Defaultmenu JS -->
<script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

<!-- Node Waves JS-->
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<!-- Sticky JS -->
<script src="{{ asset('assets/js/sticky.js') }}"></script>

<!-- Simplebar JS -->
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.js') }}"></script>

<!-- Color Picker JS -->
<script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

<!-- Apex Charts JS -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>



<!-- Custom-Switcher JS -->
<script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="left: 0px; top: 8px;">
    <div class="pcr-selection">
        <div class="pcr-color-preview">
            <button type="button" class="pcr-last-color" aria-label="use previous color"
                style="--pcr-color: rgba(98, 89, 202, 1);"></button>
            <div class="pcr-current-color" style="--pcr-color: rgba(98, 89, 202, 1);"></div>
        </div>

        <div class="pcr-color-palette">
            <div class="pcr-picker"
                style="left: calc(55.9406% - 9px); top: calc(20.7843% - 9px); background: rgb(98, 89, 202);"></div>
            <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox"
                style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(20, 0, 255), rgb(255, 255, 255));">
            </div>
        </div>

        <div class="pcr-color-chooser">
            <div class="pcr-picker" style="left: calc(67.9941% - 9px); background-color: rgb(20, 0, 255);"></div>
            <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider"></div>
        </div>

        <div class="pcr-color-opacity" style="display:none" hidden="">
            <div class="pcr-picker"></div>
            <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider"></div>
        </div>
    </div>

    <div class="pcr-swatches "></div>

    <div class="pcr-interaction">
        <input class="pcr-result" type="text" spellcheck="false" aria-label="color input field">

        <input class="pcr-type" data-type="HEXA" value="HEXA" type="button" style="display:none" hidden="">
        <input class="pcr-type active" data-type="RGBA" value="RGBA" type="button">
        <input class="pcr-type" data-type="HSLA" value="HSLA" type="button" style="display:none" hidden="">
        <input class="pcr-type" data-type="HSVA" value="HSVA" type="button" style="display:none" hidden="">
        <input class="pcr-type" data-type="CMYK" value="CMYK" type="button" style="display:none" hidden="">

        <input class="pcr-save" value="Save" type="button" style="display:none" hidden=""
            aria-label="save and close">
        <input class="pcr-cancel" value="Cancel" type="button" style="display:none" hidden=""
            aria-label="cancel and close">
        <input class="pcr-clear" value="Clear" type="button" style="display:none" hidden=""
            aria-label="clear and close">
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<link rel="modulepreload" href="{{ asset('build/assets/app-Bj6L1pPD.js') }}">
<link rel="modulepreload" href="{{ asset('build/assets/functions-D1PN9RJe.js') }}">
<script type="module" src="{{ asset('build/assets/app-Bj6L1pPD.js') }}"></script>
<script type="module" src="{{ asset('build/assets/functions-D1PN9RJe.js') }}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>



    <script src = "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.all.min.js" >
</script>

<script src="{{ asset('assets/js/style.js') }}?time={{ time() }}"></script>

{!! DataSite('script_footer') !!}
<script>
    function googleTranslateElementInit2() {
        new google.translate.TranslateElement({
            pageLanguage: 'vi',
            autoDisplay: false
        }, 'google_translate_element2');
    }
    if (!window.gt_translate_script) {
        window.gt_translate_script = document.createElement('script');
        gt_translate_script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2';
        document.body.appendChild(gt_translate_script);
    }
</script>
<script>
    function GTranslateGetCurrentLang() {
        var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');
        return keyValue ? keyValue[2].split('/')[2] : null;
    }

    function GTranslateFireEvent(element, event) {
        try {
            if (document.createEventObject) {
                var evt = document.createEventObject();
                element.fireEvent('on' + event, evt)
            } else {
                var evt = document.createEvent('HTMLEvents');
                evt.initEvent(event, true, true);
                element.dispatchEvent(evt)
            }
        } catch (e) {}
    }

    function doGTranslate(lang_pair) {
        if (lang_pair.value) lang_pair = lang_pair.value;
        if (lang_pair == '') return;
        var lang = lang_pair.split('|')[1];
        if (GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0]) return;
        if (typeof ga == 'function') {
            ga('send', 'event', 'GTranslate', lang, location.hostname + location.pathname + location.search);
        }
        var teCombo;
        var sel = document.getElementsByTagName('select');
        for (var i = 0; i < sel.length; i++)
            if (sel[i].className.indexOf('goog-te-combo') != -1) {
                teCombo = sel[i];
                break;
            } if (document.getElementById('google_translate_element2') == null || document.getElementById(
                'google_translate_element2').innerHTML.length == 0 || teCombo.length == 0 || teCombo.innerHTML.length ==
            0) {
            setTimeout(function() {
                doGTranslate(lang_pair)
            }, 500)
        } else {
            teCombo.value = lang;
            GTranslateFireEvent(teCombo, 'change');
            GTranslateFireEvent(teCombo, 'change')
        }
    }
</script>
@if (session('error'))
    <script>
        swa1('{{ session('error') }}', 'error')
    </script>
@endif
@if (session('success'))
    <script>
        swa1('{{ session('success') }}', 'success')
    </script>
@endif
@if (Auth::check())
    <script>
        callAjax('{{ route('user.action', 'level-user') }}', {
            _token: '{{ csrf_token() }}',
            user: '{{ Auth::user()->level }}'
        }).then(res => {
            if (res.status == 'success') {
                swa1(res.message, 'success')
            }
        })
    </script>
@endif

@yield('script')

</body>

</html>
