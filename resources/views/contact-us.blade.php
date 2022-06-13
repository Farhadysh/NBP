@extends('master')

@section('content')
    <div class="d-flex my-4 align-items-center justify-content-center">
        <span class="line"></span>
        <span class="mx-2 best_sellers">تماس با ما</span>
        <span class="line"></span>
    </div>
    <div class="abut-us-border">
        <div class="back-abut">
            <div class="col-md-11 mx-auto align-items-center">
                <div class="row ">
                    <div class="col-md-9 text-abut-us d-flex flex-column">
                        <h4 class="text-center text-dark mb-3 mt-5">تماس با ما</h4>
                        <div class="d-flex  text-size-footer1">
                            <p class="fa fa-home  icon"></p>
                            <p class="text">آدرس : استان سمنان-شهرستان شاهرود-خیابان شهید مدنی-رو به روی مسجد امام جعفر
                                صادق-پلاک 93 - واحد 2</p>
                        </div>
                        <div class="d-flex align-items-center text-size-footer1">
                            <p class="fa fa-phone-square  icon"></p>
                            <p class="text"> تلفن تماس : 02332232675</p>
                        </div>
                        <div class="d-flex align-items-center text-size-footer1">
                            <p class="fa fa-at  icon"></p>
                            <p class="text"> ایمیل : nbpacademy@gmail.com</p>
                        </div>
                        <div class="d-flex align-items-center text-size-footer1">
                            <p class="fa fa-fax  icon"></p>
                            <p class="text"> فکس : 02332232675</p>
                        </div>
                    </div>
                    <div class="col-md-3 image-abut  text-md-left text-center mt-5">
                        <img src="{{asset('image/t8.png')}}" alt="تخفیف">
                    </div>
                </div>
                <div class="col-9 py-5 mx-auto ">
                    <h5 class="text-center">نظرات و انتقادات خود را با ما در میان بگذارید</h5>
                    <form action="{{route('storeContact')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-12  mt-2">
                                <div class="input-group border-input">
                                    <input class="form-control a" type="text" placeholder="نام "
                                           name="name">
                                    <div class="input-group-prepend d-flex align-items-center">
                                        <span class=" fa fa-user"></span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <strong class="error">{{$errors->first('name')}}</strong>
                                @endif
                            </div>
                            <div class="col-md-4 col-12  mt-2 ">
                                <div class="input-group border-input">
                                    <input class="form-control a" type="text" placeholder="نام خانوادگی "
                                           name="last_name">
                                    <div class="input-group-prepend d-flex align-items-center">
                                        <span class=" fa fa-users"></span>
                                    </div>
                                </div>
                                @if ($errors->has('last_name'))
                                    <strong class="error">{{$errors->first('last_name')}}</strong>
                                @endif
                            </div>
                            <div class="col-md-4 col-12  mt-2 ">
                                <div class="input-group border-input">
                                    <input class="form-control a" type="text" placeholder="شماره تماس "
                                           name="mobile">
                                    <div class="input-group-prepend d-flex align-items-center">
                                        <span class=" fa fa-phone"></span>
                                    </div>
                                </div>
                                @if ($errors->has('mobile'))
                                    <strong class="error">{{$errors->first('mobile')}}</strong>
                                @endif
                            </div>
                            <div class="col-12 mt-4 ">
                                <div class="input-group border-input">
                                    <input class="form-control a" type="text" placeholder="موضوع پیام"
                                           name="title">
                                    <div class="input-group-prepend d-flex align-items-center">
                                        <span class="fa fa-comment"></span>
                                    </div>
                                </div>
                                @if ($errors->has('title'))
                                    <strong class="error">{{$errors->first('title')}}</strong>
                                @endif
                            </div>
                            <div class="col-md-12 col-12">
                            <textarea style="border: 1px solid #ffa900" class="form-control mt-2 mx-auto"
                                      placeholder="متن پیام" name="description"></textarea>
                                @if ($errors->has('description'))
                                    <strong class="error">{{$errors->first('description')}}</strong>
                                @endif

                            </div>
                            <div class="col-md-12 col-12 mt-2 text-center">
                                <button type="submit" class="btn btn-outline-success btn-sm">ثبت پیام</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection