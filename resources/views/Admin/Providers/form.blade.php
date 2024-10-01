@extends('Admin.Layout.App')

@section('title', 'Tạo Nhà Cung Cấp Mới')

@section('content')
    <div class="container">
        <h2>Tạo Nhà Cung Cấp Mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('provider.fetch') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="url">API URL</label>
                <input type="url" class="form-control" id="url" name="url" required>
            </div>
            <div class="form-group">
                <label for="key">API Key</label>
                <input type="text" class="form-control" id="key" name="key" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="sync">Sync</label>
                <select class="form-control" id="sync" name="sync" required>
                    <option value="1">On</option>
                    <option value="0">Off</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">On</option>
                    <option value="0">Off</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Fetch and Save</button>
        </form>

        @if (session('balance'))
            <div class="mt-4">
                <h3>Balance: {{ session('balance') }}</h3>
            </div>
        @endif
    </div>
@endsection
