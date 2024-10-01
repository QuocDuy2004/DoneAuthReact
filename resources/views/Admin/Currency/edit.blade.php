@extends('Admin.Layout.App')

@section('title', 'Chỉnh sửa tiền tệ')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h3 class="page-title">Chỉnh sửa tiền tệ</h3>
        </div>
        <!-- Page Header Close -->

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Currency Form -->
        <form id="editCurrencyForm" method="POST" action="{{ route('admin.currency.manager.update', $currency->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="currency_name" class="form-label">Tên tiền tệ</label>
                <input type="text" class="form-control @error('currency_name') is-invalid @enderror" id="currency_name" name="currency_name" value="{{ old('currency_name', $currency->currency_name) }}" required>
                @error('currency_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="currency_code" class="form-label">Mã tiền tệ</label>
                <input type="text" class="form-control @error('currency_code') is-invalid @enderror" id="currency_code" name="currency_code" value="{{ old('currency_code', $currency->currency_code) }}" required>
                @error('currency_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="currency_symbol" class="form-label">Ký hiệu</label>
                <input type="text" class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol', $currency->currency_symbol) }}" required>
                @error('currency_symbol')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Giá</label>
                <input type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" id="rate" name="rate" value="{{ old('rate', $currency->rate) }}" required>
                @error('rate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="currency_position" class="form-label">Vị trí</label>
                <select class="form-control @error('currency_position') is-invalid @enderror" id="currency_position" name="currency_position" required>
                    <option value="" disabled {{ old('currency_position', $currency->currency_position) == '' ? 'selected' : '' }}>Chọn vị trí</option>
                    <option value="left" {{ old('currency_position', $currency->currency_position) == 'left' ? 'selected' : '' }}>Bên trái</option>
                    <option value="right" {{ old('currency_position', $currency->currency_position) == 'right' ? 'selected' : '' }}>Bên phải</option>
                </select>
                @error('currency_position')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="" disabled {{ old('status', $currency->status) == '' ? 'selected' : '' }}>Chọn trạng thái</option>
                    <option value="active" {{ old('status', $currency->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status', $currency->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>
</div>
@endsection
