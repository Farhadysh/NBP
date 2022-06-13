<!DOCTYPE html>
<html lang="en">
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
<div class="image-login">
    <div class="cover-register d-flex align-items-center justify-content-center">
        <div class=" col-10 mx-auto">
            <div class="shadow-login bg-light">
                <h4 class="border-left-login  py-3 pr-3">ثبت نام</h4>
                <form class="login col-12 form-row" action="{{route('register')}}" method="post">
                    @csrf
                    <input type="hidden" name="typeRegister" value="visitor">
                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="name">نام</label>
                        <input class="form-control" name="name" id="name"
                               type="text" placeholder="نام" value="{{old('name')}}">
                        @error('name')
                        <span class="text-danger small-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="last_name">نام خانوادگی </label>
                        <input class="form-control" name="last_name"
                               id="last_name" type="text" placeholder="نام خانوادگی"
                               value="{{old('last_name')}}">
                        @error('last_name')
                        <span class="text-danger small-1">{{$message}}</span>
                        @enderror
                    </div>
{{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
{{--                        <label for="national_code">کد ملی </label>--}}
{{--                        <input class="form-control" name="national_code" id="national_code" type="text"--}}
{{--                               placeholder="کد ملی" value="{{old('national_code')}}">--}}
{{--                        @error('national_code')--}}
{{--                        <span class="text-danger small-1">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="mobile">تلفن همراه</label>
                        <input class="form-control" name="mobile" id="mobile"
                               type="text" placeholder="تلفن همراه" value="{{old('mobile')}}">
                        @error('mobile')
                        <span class="text-danger small-1">{{$message}}</span>
                        @enderror
                    </div>
{{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
{{--                        <label for="birth_date">تاریخ تولد</label>--}}
{{--                        <input class="form-control" name="birth_date"--}}
{{--                               id="birth_date" type="text" placeholder="تاریخ تولد" value="{{old('birth_date')}}">--}}
{{--                        @error('birth_date')--}}
{{--                        <span class="text-danger small-1">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
{{--                        <label for="email">پست الکترونیک </label>--}}
{{--                        <input class="form-control" name="email" id="email"--}}
{{--                               type="text" placeholder="پست الکترونیک" value="{{old('email')}}">--}}
{{--                        @error('email')--}}
{{--                        <span class="text-danger small-1">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="parent_id">کد معرف </label>
                        <input class="form-control" name="parent_id" id="parent_id" type="text"
                               placeholder="کد معرف " value="{{old('parent_id')}}">
                        @error('parent_id')
                        <span class="text-danger small-1">کد معرف انتخاب شده معتبر نیست.</span>
                        @enderror
                    </div>

                    {{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
                    {{--                        <label for="Consultant_code">کد مشاور </label>--}}
                    {{--                        <input class="form-control" name="Consultant_code" id="Consultant_code" type="text"--}}
                    {{--                               placeholder="کد مشاور" value="{{old('Consultant_code')}}">--}}
                    {{--                        @error('Consultant_code')--}}
                    {{--                        <span class="text-danger small-1">{{$message}}</span>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}

{{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
{{--                        <label for="province">انتخاب استان </label>--}}
{{--                        <select id="province" name="province" class="form-control province">--}}
{{--                            <option value="">انتخاب استان</option>--}}
{{--                            @foreach($provinces as $province)--}}
{{--                                <option value="{{$province->id}}">{{$province->name}}</option>--}}
{{--                            @endforeach--}}
{{--                            @error('province')--}}
{{--                            <span class="text-danger small-1">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">--}}
{{--                        <label for="city">انتخاب شهر </label>--}}
{{--                        <select id="city" name="city" class="form-control myCity  province">--}}
{{--                        </select>--}}
{{--                        @error('city')--}}
{{--                        <span class="text-danger small-1">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="password">رمز عبور </label>
                        <input class="form-control" name="password" id="password" type="text" placeholder="رمز عبور">
                        @error('password')
                        <span class="text-danger small-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-2 mx-auto">
                        <label for="password_confirmation">تکرار رمز عبور </label>
                        <input class="form-control" name="password_confirmation" id="password_confirmation" type="text"
                               placeholder="تکرار رمز عبور">
                    </div>
                    <div class="col-12 px-0 my-4 text-center">
                        <div class="col-6 col-sm-4 col-md-2 mx-auto">
                            <button class="btn btn-outline-success rounded px-1 px-md-5" value="Submit">
                                ثبت نام
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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