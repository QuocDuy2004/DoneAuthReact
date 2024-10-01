@extends('Admin.Layout.App')
@section('title', 'Phản hồi hỗ trợ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-tilte">Phản hồi hỗ trợ #{{$support->id}}</h5>
                    <form action="{{ route('admin.support.edit.post', $support->id) }}" method="POST">
                        @csrf
                         
                        <div class=" mb-3">
                            <textarea type="text" class="form-control border border-info"  rows="3" style="min-width: 200px;" name="reply"
                                value="" placeholder="Nhập nội dung phải hồi"></textarea>
                           
                        </div>
                      
                      
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary col-12">Phản hồi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
