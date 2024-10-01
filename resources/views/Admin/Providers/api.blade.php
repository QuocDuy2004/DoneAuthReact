@extends('Admin.Layout.App')

@section('title', 'Quản lí nhà cung cấp')

@section('content')
    <div class="container">
        <h2>Quản lí nhà cung cấp</h2>

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

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="fetch-tab" data-bs-toggle="tab" href="#fetch" role="tab"
                    aria-controls="fetch" aria-selected="true">Fetch Data</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="update-tab" data-bs-toggle="tab" href="#update" role="tab"
                    aria-controls="update" aria-selected="false">Update Data</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Fetch Data Tab -->
            <div class="tab-pane fade show active" id="fetch" role="tabpanel" aria-labelledby="fetch-tab">
                <form action="{{ route('provider.fetch') }}" method="POST" class="mt-3">
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

                @if (isset($balance))
                    <div class="mt-4">
                        <h3>Balance: {{ $balance }}</h3>
                    </div>
                @endif
            </div>

            <!-- Update Data Tab -->
            <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                <form id="updateForm" action="{{ route('provider.update') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="updateUrl">API URL</label>
                        <input type="url" class="form-control" id="updateUrl" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="updateKey">API Key</label>
                        <input type="text" class="form-control" id="updateKey" name="key" required>
                    </div>
                    <div class="form-group">
                        <label for="updateUsername">Username</label>
                        <input type="text" class="form-control" id="updateUsername" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="updatePassword">Password</label>
                        <input type="password" class="form-control" id="updatePassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="updateSync">Sync</label>
                        <select class="form-control" id="updateSync" name="sync" required>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateStatus">Status</label>
                        <select class="form-control" id="updateStatus" name="status" required>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update and Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
