@extends('admin.master')

@section('css')
    <style>
        input, select, textarea, strong {
            font-size: .8rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-column flex-wrap flex-md-row bg-light py-4" style="margin-top: 110px">
        <div class="col-md-12">
            <h5 class="text-dark my-3">درخواست پشتیبانی جدید</h5>
            <div class="col-md-12 card shadow-sm py-5 medium-radius">
                <form class="row" method="post"
                      action="/admin/tickets">
                    @csrf
                    <div class="form-group col-md-4">
                        <label for="subject" class="h6">موضوع</label>
                        <input id="subject" name="subject"
                               value="{{old('subject')}}"
                               placeholder="موضوع" class="form-control" type="text">
                        @if ($errors->has('subject'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="priority" class="h6">اولویت</label>
                        <select name="priority" class="form-control" type="text">
                            <option value="1">کم</option>
                            <option value="2">متوسط</option>
                            <option value="3">زیاد</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="body" class="h6">متن تیکت</label>
                        <textarea id="body" name="body" placeholder="متن تیکت" rows="6"
                                  class="form-control">{{old('body')}}</textarea>
                        @if ($errors->has('body'))
                            <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                        @endif
                    </div>

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
                        <button class="mt-2" style="border-radius:10px;padding: 10px 70px ;
            border: none;outline:none;font-size: .9em;color: #fff;background-color: #1b9001">
                            ارسال
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


