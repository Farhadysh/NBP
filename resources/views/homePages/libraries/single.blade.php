@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5 ">
        <div class="d-flex flex-wrap cover2 d-flex align-items-center justify-content-center">
            <div class="col-12 m-0 p-0 text-center">
                <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width="40">
            </div>
            <div class="col-12">
                <h4 class="text-center text-w font-weight-bold">کتاب {{$library->name}}</h4>
                <div class="d-flex justify-content-center ">
                    <div class="row sms-text1 py-3 ">
                        <div class="d-flex flex-column  mx-auto p-3">
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2"> نام کتاب : </p>
                                <p>{{$library->name}}</p>
                            </div>
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2"> موضوع اصلی : </p>
                                <p> {{$library->title}} </p>
                            </div>
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2">نویسنده : </p>
                                <p> {{$library->writer}} </p>
                            </div>
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2">ناشر : </p>
                                <p> {{$library->Publisher}} </p>
                            </div>
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2">محل نشر : </p>
                                <p> {{$library->country}} </p>
                            </div>
                            <div class="d-flex text-secondary ">
                                <p class="font-weight-bold ml-2">تاریخ نشر : </p>
                                <p> {{$library->date}} </p>
                            </div>
                            <div class="pdf d-flex flex-wrap justify-content-center my-5">
                                <a href="{{$library->book_url}}"
                                   class="btn d-flex align-items-center "><span
                                            class="fa fa-file-pdf hvr-grow ml-3"></span>نمایش
                                    کتاب </a>
                                <button onclick="myfunction()" class="btn d-flex align-items-center"><span
                                            class="fa fa-file-audio hvr-grow ml-3"></span>پخش فایل صوتی
                                </button>
                            </div>
                        </div>
                        <a class=" d-flex align-items-center justify-content-center mx-auto mr-md-5">
                            <img class="hvr-grow" src="{{$library->image}}" alt="{{$library->name}}">
                        </a>

                    </div>
                </div>
                <audio id="a" class="fixed-bottom w-100 hidden-library " src="{{$library->voice_url}}"
                       type="audio/mpeg"
                       controls preload="auto">
                </audio>
            </div>
        </div>
    </div>
@endsection