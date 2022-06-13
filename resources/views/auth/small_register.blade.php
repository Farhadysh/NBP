@extends('master')

@section('content')
    @if(!auth()->check())
        <div class="register-body mt-5">
            <div class="border-register px-0 shadow-sm col-md-7 mx-auto">
                <div class="cover-register-border">
                    <div class="image-border-register">
                        <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width="90">
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="p-md-5 p-sm-3">
                        @csrf
                        <div class="text-center pt-5 font-weight-bold text-success"><h2>ثبت نام کنید</h2></div>

                        <div class="col-md-12 padding-top-register">
                            <div class="row">
                                <div class="col-lg-6 col-12 my-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a" value="{{old('name')}}" type="text" placeholder="نام "
                                               name="name">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class=" fas fa-user"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <strong class="error">{{$errors->first('name')}}</strong>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-12 my-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a" value="{{old('last_name')}}" type="text" placeholder="نام خانوادگی"
                                               name="last_name">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="fas fa-users"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <strong class="error">{{$errors->first('last_name')}}</strong>
                                    @endif
                                </div>
                                <div class="col-lg-6 my-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a"  value="{{old('mobile')}}" type="text" placeholder="شماره تلفن همراه "
                                               name="mobile">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class=" fa fa-mobile-alt"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <strong class="error">{{$errors->first('mobile')}}</strong>
                                    @endif
                                </div>
                                <div class="col-lg-6  mt-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a" value="{{old('email')}}" type="email" placeholder="پست الکترونیک "
                                               name="email">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class=" fa fa-at"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <strong class="error">{{$errors->first('email')}}</strong>
                                    @endif
                                </div>
                                <div class="col-lg-6   mt-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="password" placeholder="رمز عبور"
                                               name="password">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class=" fa fa-lock"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <strong class="error">{{$errors->first('password')}}</strong>
                                    @endif
                                </div>

                                <div class="col-lg-6   mt-2">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="password" placeholder="تکرار رمز عبور"
                                               name="password_confirmation">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class=" fa fa-lock"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <strong class="error">{{$errors->first('password_confirmation')}}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center pt-5 pb-3">
                            <button type="submit" class="btn btn-outline-success btn-sm px-3"><span
                                        class="fa fa-user-plus ml-2"></span>ثبت نام
                            </button>
                        </div>
                        <div class="col-12 d-flex justify-content-center pt-2 pb-3">
                            <a href="/register" class="btn text-info btn-sm mx-2 px-3 "><span
                                        class="fa fa-user-secret ml-2"></span>ثبت نام به عنوان بازاریاب</a>
                        </div>
                        <div class="col-12 d-flex justify-content-center pb-3">
                            <a href="/customer_register" class="btn text-info btn-sm mx-2 px-3 "><span
                                        class="fab fa-sellcast ml-2"></span>ثبت نام به عنوان فروشنده</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

