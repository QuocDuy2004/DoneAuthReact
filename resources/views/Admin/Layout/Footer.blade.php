<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
        <span class="text-muted"> Copyright © <span id="year">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var currentYear = new Date().getFullYear();
                        document.getElementById('year').textContent = currentYear;
                    });
                </script>
            </span> <a href="javascript:void(0);" class="text-dark fw-semibold">{{ DataSite('namesite') }}</a>.
            All rights reserved.
        </span>
    </div>
</footer>
<!-- Footer End -->

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
</div>
<div id="responsive-overlay" class=""></div>
<!-- Scroll To Top --> 

<!-- Popper JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="//smmpanel-v3.baocms.net//_assets/js/defaultmenu.min.js"></script>

<!-- Node Waves JS-->
<script src="//smmpanel-v3.baocms.net//_assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="//smmpanel-v3.baocms.net//_assets/js/sticky.js"></script>

<!-- Simplebar JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/simplebar/simplebar.min.js"></script>
<script src="//smmpanel-v3.baocms.net//_assets/js/simplebar.js"></script>

<!-- Color Picker JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- Custom JS -->
<script src="//smmpanel-v3.baocms.net//_assets/js/custom.js"></script>
<div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="left: 0px; top: 8px;">
    <div class="pcr-selection">
        <div class="pcr-color-preview">
            <button type="button" class="pcr-last-color" aria-label="use previous color"
                style="--pcr-color: rgba(132, 90, 223, 1);"></button>
            <div class="pcr-current-color" style="--pcr-color: rgba(132, 90, 223, 1);"></div>
        </div>

        <div class="pcr-color-palette">
            <div class="pcr-picker"
                style="left: calc(59.6413% - 9px); top: calc(12.549% - 9px); background: rgb(132, 90, 223);">
            </div>
            <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox"
                style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(81, 0, 255), rgb(255, 255, 255));">
            </div>
        </div>

        <div class="pcr-color-chooser">
            <div class="pcr-picker" style="left: calc(71.9298% - 9px); background-color: rgb(81, 0, 255);">
            </div>
            <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider">
            </div>
        </div>

        <div class="pcr-color-opacity" style="display:none" hidden="">
            <div class="pcr-picker"></div>
            <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider">
            </div>
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
<div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window"
    style="left: 0px; top: 8px;">
    <div class="pcr-selection">
        <div class="pcr-color-preview">
            <button type="button" class="pcr-last-color" aria-label="use previous color"
                style="--pcr-color: rgba(132, 90, 223, 1);"></button>
            <div class="pcr-current-color" style="--pcr-color: rgba(132, 90, 223, 1);"></div>
        </div>

        <div class="pcr-color-palette">
            <div class="pcr-picker"
                style="left: calc(59.6413% - 9px); top: calc(12.549% - 9px); background: rgb(132, 90, 223);">
            </div>
            <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox"
                style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(81, 0, 255), rgb(255, 255, 255));">
            </div>
        </div>

        <div class="pcr-color-chooser">
            <div class="pcr-picker" style="left: calc(71.9298% - 9px); background-color: rgb(81, 0, 255);">
            </div>
            <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider">
            </div>
        </div>

        <div class="pcr-color-opacity" style="display:none" hidden="">
            <div class="pcr-picker"></div>
            <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider">
            </div>
        </div>
    </div>

    <div class="pcr-swatches "></div>

    <div class="pcr-interaction">
        <input class="pcr-result" type="text" spellcheck="false" aria-label="color input field">

        <input class="pcr-type" data-type="HEXA" value="HEXA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type active" data-type="RGBA" value="RGBA" type="button">
        <input class="pcr-type" data-type="HSLA" value="HSLA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="HSVA" value="HSVA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="CMYK" value="CMYK" type="button" style="display:none"
            hidden="">

        <input class="pcr-save" value="Save" type="button" style="display:none" hidden=""
            aria-label="save and close">
        <input class="pcr-cancel" value="Cancel" type="button" style="display:none" hidden=""
            aria-label="cancel and close">
        <input class="pcr-clear" value="Clear" type="button" style="display:none" hidden=""
            aria-label="clear and close">
    </div>
</div>


<!-- Modal Xác Nhận Xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa dịch vụ này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom-Switcher JS -->
<script src="//smmpanel-v3.baocms.net//_assets/js/custom-switcher.min.js"></script>

<!-- Internal Datatables JS -->
<script src="//smmpanel-v3.baocms.net//_assets/js/datatables.js"></script>
<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- extra js-->
<script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.27/sweetalert2.min.js"></script>

<link rel="modulepreload" href="https://smmpanel-v3.baocms.net/build/assets/functions-D1PN9RJe.js">
<script type="module" src="https://smmpanel-v3.baocms.net/build/assets/functions-D1PN9RJe.js"></script>
<script>
    $(document).ready(function() {
        window.pageOverlay = $("#page-overlay");

        // basic datatable
        $('.datatable').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            },
            response: false,
            order: [
                [0, 'desc']
            ],
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100, 500, 1000, 5000, -1],
                [10, 25, 50, 100, 500, 1000, 5000, 'All']
            ]
        });

        // .axios-form

        $('.default-form').submit(async function(e) {
            // show page overlay
            pageOverlay.show()
            // submit form
            $(this).submit();
        })

        $('.axios-form').submit(async function(e) {
            e.preventDefault();

            let reload = $(this).data('reload'),
                button = $(this).find('button[type="submit"]'),
                confirm = $(this).data('confirm'),
                callback = $(this).data('callback');

            if (confirm) {
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be undo this action!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })

                if (!confirmResult.isConfirmed) {
                    return;
                }
            }

            let form = $(this);
            let url = form.attr('action');
            let method = form.attr('method');
            let data = form.serialize();

            pageOverlay.show()

            axios({
                method: method,
                url: url,
                data: data
            }).then(function(response) {
                if (response.data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.data.message,
                    }).then(() => {
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.data.message,
                    });
                }
            }).catch(function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: $catchMessage(error),
                });
            }).finally(function() {
                pageOverlay.hide()
            });
        });

    })
</script>

<!-- JSVector Maps JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

<!-- JSVector Maps MapsJS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/jsvectormap/maps/world-merc.js"></script>

<!-- Apex Charts JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Chartjs Chart JS -->
<script src="//smmpanel-v3.baocms.net//_assets/libs/chart.js/chart.min.js"></script>

<script>
    $(document).ready(() => {
        /* basic column chart */
        var options = {
            series: [{
                name: 'Lợi nhuận',
                data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
            }, {
                name: 'Doanh thu',
                data: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2]
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    endingShape: 'rounded'
                },
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#845adf", "#23b7e5"],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["2024-08-01", "2024-08-02", "2024-08-03", "2024-08-04", "2024-08-05",
                    "2024-08-06", "2024-08-07", "2024-08-08", "2024-08-09", "2024-08-10", "2024-08-11",
                    "2024-08-12", "2024-08-13", "2024-08-14", "2024-08-15"
                ],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                title: {
                    text: 'VNĐ',
                    style: {
                        color: "#8c9097",
                    },
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                    formatter: function(val) {
                        return (val)
                    }
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return (val)
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#column-basic"), options);
        chart.render();

        var options = {
            series: [{
                name: 'Tiền nạp',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                name: 'Tiền tiêu',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "637.50", 0, 0, 0, 0]
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    endingShape: 'rounded'
                },
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#845adf", "#23b7e5"],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["2024-08-01", "2024-08-02", "2024-08-03", "2024-08-04", "2024-08-05",
                    "2024-08-06", "2024-08-07", "2024-08-08", "2024-08-09", "2024-08-10", "2024-08-11",
                    "2024-08-12", "2024-08-13", "2024-08-14", "2024-08-15"
                ],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                title: {
                    text: 'VNĐ',
                    style: {
                        color: "#8c9097",
                    },
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                    formatter: function(val) {
                        return (val)
                    }
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return (val)
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#column-basic1"), options);
        chart.render();
    })
</script>
<script type="text/javascript" async="" src="https://messenger.svc.chative.io/bundle.js"></script>
<script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    $(document).ready(function() {
        /* basic line chart */
        var options = {
            series: [{
                "name": "Pending",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0]
            }, {
                "name": "Processing",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                "name": "Completed",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                "name": "Cancelled",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                "name": "Refund",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                "name": "Error",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }, {
                "name": "Others",
                "data": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            }],
            chart: {
                height: 320,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            colors: ["#f6ad55", "#68d391", "#4fd1c5", "#63b3ed", "#9f7aea", "#C40C0C", "#ed64a6"],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            title: {
                text: 'Đơn hàng gần đây',
                align: 'left',
                style: {
                    fontSize: '13px',
                    fontWeight: 'bold',
                    color: '#8c9097'
                },
            },
            xaxis: {
                categories: ["2024-08-01", "2024-08-02", "2024-08-03", "2024-08-04", "2024-08-05",
                    "2024-08-06", "2024-08-07", "2024-08-08", "2024-08-09", "2024-08-10", "2024-08-11",
                    "2024-08-12", "2024-08-13", "2024-08-14", "2024-08-15"
                ],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#orders-chart"), options);
        chart.render();

        /* basic pie chart */
        var options1 = {
            series: [8, 0, 0, 0, 0, 6, 0],
            chart: {
                height: 300,
                type: 'pie',
            },
            colors: ["#f6ad55", "#68d391", "#4fd1c5", "#63b3ed", "#9f7aea", "#C40C0C", "#ed64a6"],
            labels: ["Pending", "Processing", "Completed", "Cancelled", "Refund", "Error", "Others"],
            legend: {
                position: "bottom"
            },
            dataLabels: {
                dropShadow: {
                    enabled: false
                }
            },
        };
        var chart = new ApexCharts(document.querySelector("#pie-basic"), options1);
        chart.render();

    })
</script>

<script>
    $(document).ready(() => {

        const fixUpdate = () => {
            axios.get('/artisan/fix-update').then(r => {
                console.log(r.data);
            }).catch(e => {
                console.log(e);
            })
        }

        const callApi = async (force = 0) => {
            try {
                const {
                    data: result
                } = await axios.get('/admin/update', {
                    params: {
                        run: force
                    }
                });

                if (force === 0) return result.data?.can_update || false
                else return result
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: $catchMessage(error),
                })
            }
        }

        const runUpdate = async () => {
            try {
                const canUpdate = await callApi(0)

                if (canUpdate) {
                    $showLoading('Đang cập nhật, vui lòng đợi...')

                    const result = await callApi(1)

                    if (result.data?.version_code !== undefined) {
                        return Swal.fire({
                            icon: 'success',
                            title: 'Đã cập nhật!',
                            text: result.message || 'Cập nhật thành công!'
                        }).then(() => {
                            location.reload()
                        })
                    }
                }

                $hideLoading()

                console.log('Bạn đang dùng phiên bản mới nhất rồi keke')
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Cập nhật thất bại!',
                    text: $catchMessage(error),
                })
            }
        }

        runUpdate();
    })
</script>




<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
    style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
</svg>
<div id="E211B56A-C6B8-6025-E3F1-41919A979365"></div><a id="mycustomimage" href="#" download=""></a>
<div id="naptha_container0932014_0707" style="position: absolute; top: 0px; left: 0px;"></div>
</body><chatgpt-sidebar data-gpts-theme="light"></chatgpt-sidebar><chatgpt-sidebar-popups
    data-gpts-theme="light"></chatgpt-sidebar-popups>

<script src="/assets/js/style.js?time={{ time() }}"></script>

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
