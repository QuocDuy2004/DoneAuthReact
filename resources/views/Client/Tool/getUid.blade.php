@extends('Layout.App')
@section('title', 'Get UID Facebook')

@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('get_facebook_uid') }}</h3>
                        <span class="ribbon-inner bg-default"></span>
                    </div>
                    <div class="card-body">
                        <div class="new__order--form">
                            <form action="{{ route('tool.uid.post', 'get-uid') }}" method="POST">
                                <div class="mb-3">
                                    <label for="object_id" class="form-label">Nhập CODE 2FA</label>
                                    <input type="text" class="form-control" placeholder="Nhập link Facebook" name="link"
                                    id="link" value="{{ session('link') }}">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit" id="getUID">Get UID</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
