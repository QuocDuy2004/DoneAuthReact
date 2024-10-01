@extends('Layout.App')

@section('title', 'Nhắn Tin Cùng Hỗ Trợ')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card card-flush">
            <div class="card-header ribbon ribbon-start ribbon-clip border-bottom-none min-h-50px">
                <div class="ribbon-label text-uppercase fw-bold bg-default">
                    Nhắn Tin Cùng Hỗ Trợ - {{ $support->parent_id}}
                    <span class="ribbon-inner bg-default"></span>
                </div>
            </div>
            <div class="card-body">
                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                    data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                    data-kt-scroll-offset="5px" style="">
                    @foreach ($support->where('parent_id', $support->parent_id)->orderBy('created_at')->get() as $sp)
                    @if ($sp->text !='')
                    <div class="d-flex justify-content-end mb-10">
                        <div class="d-flex flex-column align-items-end">
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-45px symbol-circle position-relative">
                                    <img src="https://ui-avatars.com/api/?background=random&amp;name={{$sp->username}}" alt="" class="rounded-circle">
                                </div>
                                <div class="ms-3">
                                    <div class="fs-6 fw-bold text-gray-900 me-1">{{$sp->username}}</div>
                                    <span class="text-muted fs-7 mb-1">{{$sp->created_at}}</span>
                                </div>
                            </div>
                            <div class="p-5 rounded bg-light fw-bold mw-lg-400px text-end">
                                {{$sp->text}}
                            </div>
                        </div>
                    </div>
                    @else

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-45px symbol-circle position-relative">
                                    @if (DataSite('domain') == 'fbvn.vn')
                                        <img alt="FBVN" src="https://i.imgur.com/EhhAlWH.jpeg">
                                    @endif
                                    @if (DataSite('domain') != 'fbvn.vn')
                                        <img src="https://ui-avatars.com/api/?background=random&amp;name={{$sp->username}}" alt="" class="rounded-circle">
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <div class="fs-6 fw-bold text-gray-900 me-1">{{ DataSite('nameadmin') }} <i class="fa fa-check-circle" style="color: rgb(24, 119, 242);"></i></div>
                                    <span class="text-muted fs-7 mb-1">{{$sp->created_at}}</span>
                                </div>
                            </div>
                            <div class="p-5 rounded bg-light fw-bold mw-lg-400px text-start">
                                 {{$sp->reply}}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                     
                </div>
            </div>
            <div class="card-footer pt-4">
                <form action="{{route('supportedit', ['id'=> $support->parent_id])}}" method="POST">
                  @csrf
                    <textarea class="form-control mb-3" rows="2" name="text" data-kt-autosize="true"
                        placeholder="Tin nhắn..." data-kt-initialized="1"
                        style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 58.6px;"></textarea>
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center me-2">
                            <button class="btn btn-sm btn-icon badge-light-info me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="fa-regular fa-paper-plane fs-6 text-dark"></i>
                            </button>
                            <button class="btn btn-sm btn-icon badge-light-info me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="fa-solid fa-upload fs-6 text-dark"></i>
                            </button>
                        </div>
                        <button class="btn btn-primary" type="submit">Gửi Tin Nhắn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection