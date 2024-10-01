@extends('Admin.Layout.App')

@section('title', 'Lấy Dịch Vụ')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Provider: Import Services</h1>
            </div>

            <!-- Start:: Content -->
            {{-- <div class="card custom-card">
                <div class="card-body">
                    <!-- Form to select Provider -->
                   
                </div>
            </div> --}}

            <!-- Form để nhập dịch vụ -->
            <div class="card custom-card">
                <div class="card-body">
                    <form id="providerForm" action="{{ route('admin.import.services') }}" method="POST" class="axios-form">
                        @csrf
                        <input type="hidden" id="importProviderKey" name="provider_key">
                        <input type="hidden" id="actual_service" name="actual_service">

                        <div class="mb-3">
                            <label for="providerSelect" class="form-label">Nhà cung cấp</label>
                            <select id="providerSelect" name="provider_url" onchange="updateKey(this)" class="form-control">
                                <option value="">Chọn nhà cung cấp</option>
                                @if ($providers->isEmpty())
                                    <option value="">No providers available</option>
                                @else
                                    @foreach ($providers as $provider)
                                        @php
                                            $parsedUrl = parse_url($provider->url);
                                            $providerDomain = isset($parsedUrl['host'])
                                                ? preg_replace('/^www\./', '', $parsedUrl['host'])
                                                : $provider->url;
                                        @endphp
                                        <option value="{{ $providerDomain }}" data-url="{{ $provider->url }}"
                                            data-key="{{ $provider->key }}">
                                            {{ $providerDomain }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <input type="hidden" id="providerKey" name="provider_key">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="importService" class="form-label">Dịch vụ từ nhà cung cấp</label>
                                    <select class="form-control" id="importService" name="actual_server">
                                        <option value="">Vui lòng chọn dịch vụ</option>
                                        <!-- Các option sẽ được thêm động -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="social" class="form-label">Dịch vụ Mạng Xã Hội</label>
                                    <select class="form-control" id="social" name="social" required>
                                        <option value="">Vui lòng chọn nền tảng</option>
                                        @foreach ($social as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="service" class="form-label">Chọn dịch vụ MXH</label>
                                    <select class="form-control" id="service" name="service">
                                        <option value="">Vui lòng chọn dịch vụ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="server_service" class="form-label">Chọn máy chủ MXH</label>
                                    <select class="form-control" id="server_service" name="server_service">
                                        <option value="">Vui lòng chọn máy chủ</option>
                                        @for ($i = 1; $i < 99; $i++)
                                            <option value="{{ $i }}">ID: {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price_percentage_increase" class="form-label">Tăng giá (%)</label>
                                    <input type="number" class="form-control" name="price_percentage_increase"
                                        id="price_percentage_increase" value="0" step="0.01" required
                                        onchange="updatePrice()">
                                </div>
                            </div>

                            <!-- New Fields -->
                            <div class="col-md-6">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="col-md-6">
                                <label for="description" class="form-label">Miêu tả</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="min" class="form-label">Min</label>
                                <input type="number" class="form-control" id="min" name="min" required>
                            </div>

                            <div class="col-md-6">
                                <label for="max" class="form-label">Max</label>
                                <input type="number" class="form-control" id="max" name="max" required>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        step="0.01" value="1" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Hoạt động</option>
                                        <option value="inactive">Không hoạt động</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-primary" type="submit">Nhập dịch vụ</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            <!-- Danh sách dịch vụ -->
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách dịch vụ</h3>
                    <button id="addServicesButton" class="btn btn-primary" style="display: none;">Thêm Dịch Vụ</button>
                </div>

                <div class="card-body">
                    <table class="table table-bordered" id="servicesTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllCheckbox"></th>
                                <th>Tên</th>
                                <th>Loại</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Tối thiểu</th>
                                <th>Tối đa</th>
                                <th>Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Khi checkbox "Chọn tất cả" được thay đổi
            $('#selectAllCheckbox').on('change', function() {
                var isChecked = $(this).is(
                    ':checked'); // Kiểm tra xem checkbox "Chọn tất cả" có được chọn không
                // Chọn hoặc bỏ chọn tất cả các checkbox dịch vụ dựa trên trạng thái của checkbox "Chọn tất cả"
                $('#servicesTable tbody input[name="services[]"]').prop('checked', isChecked);
                // Cập nhật trạng thái hiển thị của nút "Thêm Dịch Vụ"
                updateAddButtonVisibility();
            });
            $('#servicesTable').on('change', 'input[name="services[]"]', function() {
                // Kiểm tra nếu tất cả checkbox dịch vụ đều được chọn
                var allChecked = $('#servicesTable tbody input[name="services[]"]').length ===
                    $('#servicesTable tbody input[name="services[]"]:checked').length;
                // Cập nhật trạng thái của checkbox "Chọn tất cả"
                $('#selectAllCheckbox').prop('checked', allChecked);
                // Cập nhật hiển thị nút "Thêm Dịch Vụ"
                updateAddButtonVisibility();
            });

            function updateAddButtonVisibility() {
                var selectedCount = $('#servicesTable tbody input[name="services[]"]:checked').length;
                // Nếu có ít nhất 1 checkbox được chọn, hiển thị nút "Thêm Dịch Vụ"
                if (selectedCount > 0) {
                    $('#addServicesButton').show();
                } else {
                    $('#addServicesButton').hide();
                }
            }

            $('#addServicesButton').on('click', function() {
                var selectedServices = $('input[name="services[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedServices.length > 0) {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn thêm các dịch vụ này không?',
                        text: `Bạn đã chọn ${selectedServices.length} dịch vụ.`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Thêm',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Gửi các dịch vụ đã chọn qua Ajax đến server
                            $.ajax({
                                url: '{{ route('admin.import.services') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    services: selectedServices
                                },
                                success: function(data) {
                                    if (data.status === 'success') {
                                        Swal.fire(
                                            'Thành công!',
                                            'Các dịch vụ đã được thêm thành công.',
                                            'success'
                                        );
                                        $('#servicesTable').DataTable().ajax.reload();
                                    } else {
                                        Swal.fire(
                                            'Lỗi!',
                                            'Không thể thêm dịch vụ.',
                                            'error'
                                        );
                                    }
                                },
                                error: function() {
                                    Swal.fire(
                                        'Lỗi!',
                                        'Đã xảy ra lỗi trong quá trình gửi yêu cầu.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                }
            });



            // Các phần khác của mã
            $('#providerSelect').change(function() {
                submitForm(); // Gửi yêu cầu AJAX để lấy dịch vụ
            });

            $('#social').change(function() {
                $.ajax({
                    url: "{{ route('admin.service.checking.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == 'success') {
                            var service = $('select[name=service]');
                            service.empty();
                            $.each(data.data, function(key, value) {
                                service.append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            })
                        }
                    },
                    error: function(data) {
                        if (data.status == 500) {
                            toastr.error(data.responseJSON.message);
                        }
                    }
                })
            });
        });

        function updateKey(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var providerUrl = selectedOption.getAttribute('data-url');
            var providerKey = selectedOption.getAttribute('data-key');

            // Cập nhật giá trị cho provider_key và actual_service
            document.getElementById('providerKey').value = providerKey;
            document.getElementById('actual_service').value = providerUrl;

            console.log('Provider URL:', providerUrl); // Debugging
            console.log('Provider Key:', providerKey); // Debugging
        }

        function submitForm() {
            var form = $('#providerForm');
            var formData = form.serialize(); // Serialize form data

            $.ajax({
                url: '{{ route('admin.get.services') }}', // URL gửi yêu cầu
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.services && Array.isArray(response.services)) {
                        updateServiceOptions(response.services);
                        updateServiceTable(response.services);
                        toastr.success('Dịch vụ được cập nhật thành công');
                    } else {
                        toastr.error('Dịch vụ cập nhật thất bại');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Đã xảy ra lỗi:', error);
                }
            });
        }


        function updateMin(minValue) {
            // Cập nhật input có id và name là 'min' với giá trị min
            $('#min').val(minValue); // hoặc $('input[name="min"]').val(minValue);
        }


        // Xử lý sự kiện khi người dùng chọn một tùy chọn
        $('#importService').on('change', function() {
            var selectedOption = $(this).find('option:selected'); // Lấy tùy chọn được chọn
            var selectedService = selectedOption.data('service'); // Lấy đối tượng service từ thuộc tính data

            // Nếu có dịch vụ được chọn, cập nhật các trường
            if (selectedService) {
                updateServiceFields(selectedService); // Gọi hàm để cập nhật các trường input
            } else {
                // Nếu không có dịch vụ nào được chọn, làm trống các input
                clearServiceFields();
            }
        });

        updateServiceTable(services);

        function updateServiceOptions(services) {
            var importServiceSelect = $('#importService');
            importServiceSelect.empty(); // Xóa các tùy chọn hiện có

            if (services.length > 0) {
                services.forEach(function(service) {
                    var optionText =
                        `ID ${service.service} - ${service.name} | ${service.type} | ${service.category} | Giá: ${service.rate} | Tối thiểu: ${service.min} | Tối đa: ${service.max} | Mô tả: ${service.desc}`;
                    var option = $('<option>')
                        .val(service.service) // Giá trị của option là ID dịch vụ
                        .data('service', service) // Lưu toàn bộ đối tượng service dưới dạng thuộc tính data
                        .text(optionText); // Nội dung hiển thị là thông tin dịch vụ
                    importServiceSelect.append(option);
                });
            } else {
                var noOption = $('<option>').val('').text('Không có dịch vụ nào.');
                importServiceSelect.append(noOption);
            }
        }

        function updateServiceTable(services) {
            var servicesTableBody = $('#servicesTable tbody');
            servicesTableBody.empty(); // Xóa các dòng hiện có

            if (services.length > 0) {
                services.forEach(function(service) {
                    var row = `<tr>
                <td class="checkbox-container">
                    <input type="checkbox" id="service-${service.service}" name="services[]" value="${service.service}">
                    <label for="service-${service.service}">${service.service ?? ''}</label>
                </td>
                <td>${service.name ?? ''}</td>
                <td>${service.type ?? ''}</td>
                <td>${service.category ?? ''}</td>
                <td>${service.rate ?? ''}</td>
                <td>${service.min ?? ''}</td>
                <td>${service.max ?? ''}</td>
                <td>${service.desc ?? ''}</td>
            </tr>`;
                    servicesTableBody.append(row);
                });
            } else {
                servicesTableBody.append('<tr><td colspan="8" class="text-center">Không có dịch vụ nào</td></tr>');
            }
        }
        // Xử lý sự kiện khi người dùng chọn một tùy chọn từ dropdown
        $('#importService').on('change', function() {
            var selectedOption = $(this).find('option:selected'); // Lấy tùy chọn được chọn
            var selectedService = selectedOption.data('service'); // Lấy đối tượng service từ thuộc tính data

            // Nếu có dịch vụ được chọn, cập nhật các trường
            if (selectedService) {
                updateServiceFields(selectedService); // Gọi hàm để cập nhật các trường input
            }
        });

        function updateServiceFields(service) {
            $('#title').val(service.name ?? '');
            $('#description').val(service.desc ?? '');
            $('#min').val(service.min ?? '');
            $('#max').val(service.max ?? '');

            var originalPrice = parseFloat(service.rate) || 1; // Sử dụng giá dịch vụ từ API
            $('#price').val(originalPrice.toFixed(2)); // Cập nhật giá trị của trường price
            $('#price').data('originalPrice', originalPrice); // Lưu giá trị gốc vào thuộc tính data
        }

        function clearServiceFields() {
            $('#title').val('');
            $('#description').val('');
            $('#min').val('');
            $('#max').val('');
            $('#price').val('').removeData('originalPrice'); // Xóa thuộc tính 'data-originalPrice'
        }

        //     function updateAddButtonVisibility() {
        //     // Nếu có ít nhất một checkbox dịch vụ được chọn thì hiển thị nút "Thêm Dịch Vụ"
        //     if ($('#servicesTable tbody input[name="services[]"]:checked').length > 0) {
        //         $('#addServicesButton').show();
        //     } else {
        //         $('#addServicesButton').hide();
        //     }
        // }

        //     $('#selectAllCheckbox').on('change', function() {
        //         var isChecked = $(this).is(':checked');
        //         $('input[name="services[]"]').prop('checked', isChecked);
        //         updateAddButtonVisibility();
        //     });

        // Xử lý sự kiện thay đổi checkbox
        //     $('#servicesTable').on('change', 'input[name="services[]"]', function() {
        //     // Kiểm tra nếu tất cả các checkbox đều được chọn thì checkbox "Chọn tất cả" cũng được chọn
        //     var allChecked = $('#servicesTable tbody input[name="services[]"]').length === 
        //                      $('#servicesTable tbody input[name="services[]"]:checked').length;
        //     $('#selectAllCheckbox').prop('checked', allChecked);

        //     // Cập nhật trạng thái hiển thị của nút "Thêm Dịch Vụ"
        //     updateAddButtonVisibility();
        // });


        $('#price_percentage_increase').on('change', function() {
            updatePrice(); // Gọi hàm cập nhật giá trị price
        });
        $('#price_percentage_increase').on('input', function() {
            updatePrice(); // Cập nhật giá trị của trường price ngay khi người dùng nhập liệu
        });
        $(document).ready(function() {
            var originalPrice = parseFloat($('#price').val()) ||
                1; // Lấy giá trị mặc định của 'price', nếu không có giá trị thì là 1
            $('#price').data('originalPrice', originalPrice); // Lưu giá trị gốc vào thuộc tính data
        });

        function updatePrice() {
            var percentageIncrease = parseFloat($('#price_percentage_increase').val()) || 0; // Giá trị phần trăm tăng
            var originalPrice = $('#price').data('originalPrice'); // Lấy giá trị gốc từ thuộc tính data

            var newPrice = originalPrice + (originalPrice * (percentageIncrease / 100)); // Tính toán giá trị mới
            $('#price').val(newPrice.toFixed(2)); // Cập nhật giá trị mới cho input price
        }
        $('#price_percentage_increase').on('input', function() {
            updatePrice(); // Gọi hàm cập nhật giá trị price ngay khi người dùng nhập liệu
        });



        $('#selectAllCheckbox').change(function() {
            var isChecked = $(this).is(':checked'); // Kiểm tra trạng thái của checkbox "Chọn tất cả"

            // Chọn tất cả checkbox trong bảng dựa trên trạng thái của checkbox "Chọn tất cả"
            $('#servicesTable tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        // Các phần khác của mã
        $('#providerSelect').change(function() {
            submitForm(); // Gửi yêu cầu AJAX để lấy dịch vụ
        });

        $('#selectAllCheckbox').on('change', function() {
            var isChecked = $(this).is(':checked');
            $('input[name="services[]"]').prop('checked', isChecked);
            updateAddButtonVisibility();
        });



        function validateForm() {
            var actualServiceValue = document.getElementById('actual_service').value;
            if (!actualServiceValue) {
                alert('Trường actual service không được bỏ trống.');
                return false; // Ngăn không cho form gửi đi
            }
            return true; // Cho phép form gửi đi
        }
    </script>
@endsection
