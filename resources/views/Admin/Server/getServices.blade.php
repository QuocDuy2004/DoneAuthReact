@extends('Admin.Layout.App')

@section('title', 'Danh Sách Dịch Vụ')

@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Danh Sách Dịch Vụ</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (isset($services) && count($services) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Service ID</th>
                                    <th>Service Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Rate</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="services[]" value="{{ $service->service }}">
                                        </td>
                                        <td>{{ $service->service }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->type }}</td>
                                        <td>{{ $service->category }}</td>
                                        <td>{{ $service->rate }}</td>
                                        <td>{{ $service->min }}</td>
                                        <td>{{ $service->max }}</td>
                                        <td>{{ $service->desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Không có dịch vụ nào.</p>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
