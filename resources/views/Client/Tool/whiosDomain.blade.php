@extends('Layout.App')
@section('title', 'Whois Domain')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('check_domain') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tool.domain.post', 'whios-domain') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="domaincheck" class="form-label">Nhập DOMAIN</label>
                                    <input type="text" class="form-control" placeholder="Vui lòng nhập tên miền" 
                                           name="domaincheck" id="domaincheck" 
                                           value="{{ session('domaincheck') }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100" id="whois">Check Domain</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    

            @if (session('status') == true)
                <div class="mt-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin chi tiết domain</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <colgroup>
                                        <col width="28%">
                                        <col width="72%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>Tên miền</td>
                                            <td>
                                                <a href="https://{{ session('domaincheck') }}" target="_blank">
                                                    {{ session('domaincheck') }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ngày đăng ký:</td>
                                            <td>{{ session('creationDate') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày hết hạn:</td>
                                            <td>{{ session('expirationDate') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái:</td>
                                            <td>{{ session('statusdomain') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quản lý tại Nhà đăng ký:</td>
                                            <td>{{ session('registrar') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nameservers1:</td>
                                            <td>{{ session('nameServer1') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nameservers2:</td>
                                            <td>{{ session('nameServer2') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
