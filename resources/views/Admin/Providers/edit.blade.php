@extends('Admin.Layout.App')

@section('title', 'Chỉnh Sửa Nhà Cung Cấp')

@section('content')
    <div class="container">
        <h2>Chỉnh Sửa Nhà Cung Cấp</h2>

        <!-- Thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form chỉnh sửa -->
        <form id="edit-provider-form" action="{{ route('providers.update', $provider->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="url">API URL</label>
                <input type="url" class="form-control" id="url" name="url"
                    value="{{ old('url', $provider->url) }}" required>
            </div>

            <div class="form-group">
                <label for="key">API Key</label>
                <input type="text" class="form-control" id="key" name="key"
                    value="{{ old('key', $provider->key) }}" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="{{ old('username', $provider->username) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="{{ old('password', $provider->password) }}" required>
            </div>

            <div class="form-group">
                <label for="sync">Sync</label>
                <select class="form-control" id="sync" name="sync" required>
                    <option value="1" {{ old('sync', $provider->sync) ? 'selected' : '' }}>On</option>
                    <option value="0" {{ !old('sync', $provider->sync) ? 'selected' : '' }}>Off</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ old('status', $provider->status) ? 'selected' : '' }}>On</option>
                    <option value="0" {{ !old('status', $provider->status) ? 'selected' : '' }}>Off</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Provider</button>
            <a href="{{ route('providers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('edit-provider-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(form);
                fetch(form.action, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Provider updated successfully.');
                            window.location.href =
                            "{{ route('providers.index') }}"; // Redirect to list page
                        } else {
                            alert('Failed to update provider.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
