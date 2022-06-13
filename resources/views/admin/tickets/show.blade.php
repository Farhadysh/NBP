@extends('admin.master')

@section('content')
    <div class="d-flex flex-column flex-wrap flex-md-row bg-light py-4" style="margin-top: 110px">
        <div class="col-md-12">
            <div class="d-flex p-2 justify-content-between
         align-items-center m-2">
                <h5 class="text-dark">درخواست های پشتیبانی / مشاهده درخواست</h5>
                <a href="/admin/tickets" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
            </div>

            <div class="col-md-12 bg-white border medium-radius p-3">
                <div class="">
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    @if($ticket->user->isAdmin())
                        <p class="p-0 h6 text-dark">{{$ticket->user->fullName}}
                            (کارمندان)</p>
                    @else
                        <p class="p-0 h6 text-dark">{{$ticket->user->fullName}} (کاربر)</p>
                    @endif
                    <div class="d-flex align-items-center">
                        <p class="p-0 bg-{{$ticket->status['color']}} shadow-sm
                        ml-2 text-white px-2 py-1 rounded text-v-sm">
                            {{$ticket->status['title']}}</p>

                        <p class="p-0 bg-{{$ticket->priority['color']}} shadow-sm
                        text-white px-2 py-1 rounded text-v-sm">
                            {{$ticket->priority['title']}}</p>
                    </div>
                    <p class="p-0 text-danger text-v-sm">{{$ticket->created_at}}</p>
                </div>
                <div class="dropdown-divider"></div>
                <h6 class="text-dark mr-3">{{$ticket->subject}}</h6>

                <p class="text-muted font-small mr-3">
                    {!! $ticket->body !!}
                </p>
                @if($ticket->file_url)
                    <form action="/admin/file/download" method="post">
                        @csrf
                        <input type="text" name="url" hidden value="{{$ticket->file_url}}">
                        <button class="btn btn-sm btn-primary shadow">دانلود فایل</button>
                    </form>
                @endif
            </div>

            @foreach($ticket->replies as $reply)
                <div class="col-md-12 bg-white border medium-radius p-3 my-5">
                    <div class="d-flex align-items-center justify-content-between">
                        @if($reply->user->isAdmin())
                            <p class="p-0 h6 text-dark">{{$reply->user->fullName}}
                                (کارمندان)</p>
                        @else
                            <p class="p-0 h6 text-dark">{{$reply->user->fullName}} (کاربر)</p>
                        @endif
                        <p class="p-0 text-danger text-v-sm">{{$reply->created_at}}</p>
                    </div>

                    <p class="text-muted font-small mr-3">
                        {!! $reply->message !!}
                    </p>
                    <div class="dropdown-divider"></div>

                    @if($reply->file_url)
                        <form action="/admin/file/download" method="post">
                            @csrf
                            <input type="text" name="url" hidden value="{{$reply->file_url}}">
                            <button class="btn btn-sm btn-primary shadow">دانلود فایل</button>
                        </form>
                    @endif

                </div>
            @endforeach


            <div class="mt-5 col-md-10 mx-auto">
                <form action="{{route('admin.replies.store')}}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                    <textarea name="message" id="message" rows="5" class="form-control medium-radius text-v-sm"
                              placeholder="پاسخ"></textarea>
{{--                    <div class="col-12 mt-4 text-center">--}}
{{--                        <div class="upload-btn-wrapper">--}}
{{--                            <button class="btn_upload">آپلود فایل</button>--}}
{{--                            <input type="file" title="آپلود فایل" name="file"/>--}}
{{--                            @error('file')--}}
{{--                            <span class="error" role="alert">--}}
{{--                                                            <strong>{{$message}}</strong>--}}
{{--                                                        </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-12 text-center">
                        <button class="mt-2 btn btn-sm font-small btn-success send_file_btn">
                            ارسال
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
