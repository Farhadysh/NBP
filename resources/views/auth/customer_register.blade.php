<link rel="stylesheet" href="{{asset('css/kamadatepicker.min.css')}}">
<style>
    #bd-root-birth_date {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 1%;
    }
</style>


<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Free Web tutorials">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('css/kamadatepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/new-style.css')}}">
</head>
<body>
@if(session()->has('message'))
    <div class="alert alert-danger col-md-10 mx-auto">
        {{ session()->get('message') }}
    </div>
@endif
<div class="image-login">
    <div class="cover-register d-flex align-items-center justify-content-center">
        <div class=" col-10 mx-auto bg-white rounded">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="typeRegister" value="customer">
                <div class="text-center py-5 font-weight-bold text-success"><h4>ثبت نام به عنوان تامین کننده</h4></div>
                <div class="col-md-12 padding-top-register">
                    <div class="row">
                        <div class="col-lg-4 col-12 mt-3">
                            <div class="input-group border-input">
                                <input class="form-control a" value="{{old('name')}}" type="text" placeholder="نام "
                                       name="name">
                            </div>
                            @if ($errors->has('name'))
                                <strong class="error">{{$errors->first('name')}}</strong>
                            @endif
                        </div>
                        <div class="col-lg-4 col-12 mt-3">
                            <div class="input-group border-input">
                                <input class="form-control a" value="{{old('last_name')}}" type="text"
                                       placeholder="نام خانوادگی"
                                       name="last_name">

                            </div>
                            @if ($errors->has('last_name'))
                                <strong class="error">{{$errors->first('last_name')}}</strong>
                            @endif
                        </div>

{{--                        <div class="col-lg-4 col-12   mt-3">--}}
{{--                            <div class="input-group border-input">--}}
{{--                                <input class="form-control a" value="{{old('national_code')}}" type="text"--}}
{{--                                       placeholder="کدملی"--}}
{{--                                       name="national_code">--}}

{{--                            </div>--}}
{{--                            @if ($errors->has('national_code'))--}}
{{--                                <strong class="error">{{$errors->first('national_code')}}</strong>--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        <div class="col-lg-4   mt-3">
                            <div class="input-group border-input">
                                <input class="form-control a" value="{{old('mobile')}}" type="text"
                                       placeholder=" تلفن همراه "
                                       name="mobile">

                            </div>
                            @if ($errors->has('mobile'))
                                <strong class="error">{{$errors->first('mobile')}}</strong>
                            @endif
                        </div>
{{--                        <div class="col-lg-4  mt-3">--}}
{{--                            <div class="input-group border-input">--}}
{{--                                <select name="province" class="form-control province ">--}}
{{--                                    <option value="">انتخاب استان</option>--}}
{{--                                    @foreach($provinces as $province)--}}
{{--                                        <option value="{{$province->id}}">{{$province->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}

{{--                            </div>--}}
{{--                            @if ($errors->has('province'))--}}
{{--                                <strong class="error">{{$errors->first('province')}}</strong>--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 mt-3">--}}
{{--                            <div class="input-group border-input">--}}
{{--                                <select name="city" class="form-control myCity">--}}

{{--                                </select>--}}

{{--                            </div>--}}
{{--                            @if ($errors->has('city'))--}}
{{--                                <strong class="error">{{$errors->first('city')}}</strong>--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4  mt-3">--}}
{{--                            <div class="input-group border-input">--}}
{{--                                <input class="form-control a" id="birth_date" value="{{old('birth_date')}}"--}}
{{--                                       type="text" placeholder="تاریخ تولد"--}}
{{--                                       name="birth_date">--}}

{{--                            </div>--}}
{{--                            @if ($errors->has('birth_date'))--}}
{{--                                <strong class="error">{{$errors->first('birth_date')}}</strong>--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-12  mt-3">--}}
{{--                            <div class="input-group border-input">--}}
{{--                                <input class="form-control a" type="email" value="{{old('email')}}"--}}
{{--                                       placeholder="پست الکترونیک "--}}
{{--                                       name="email">--}}

{{--                            </div>--}}
{{--                            @if ($errors->has('email'))--}}
{{--                                <strong class="error">{{$errors->first('email')}}</strong>--}}
{{--                            @endif--}}
{{--                        </div>--}}

                        <div class="col-lg-4  mt-3">
                            <div class="input-group border-input">
                                <input class="form-control a" type="password" placeholder="رمز عبور"
                                       name="password">

                            </div>
                            @if ($errors->has('password'))
                                <strong class="error">{{$errors->first('password')}}</strong>
                            @endif
                        </div>
                        <div class="col-lg-4  mt-3">
                            <div class="input-group border-input">
                                <input class="form-control a" type="password" placeholder="تکرار رمز عبور"
                                       name="password_confirmation">

                            </div>
                            @if ($errors->has('password_confirmation'))
                                <strong class="error">{{$errors->first('password_confirmation')}}</strong>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center py-5">
                    <button type="submit" class="btn btn-outline-success"
                            style="border-radius: 13px;padding: 8px 85px">ثبت نام
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/type.js')}}"></script>
<script type="text/javascript" src="{{asset('js/kamadatepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
<script>
    kamaDatepicker('birth_date', {
        markToday: true,
        gotoToday: true
    });
</script>
</body>
</html>

