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
    <title>ورود</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('css/new-style.css')}}">
</head>
<body>
<div class="image-login">
    <div class="cover-register d-flex align-items-center justify-content-center">
        <div class=" col-12 col-sm-6 col-md-6 col-lg-4 mx-auto">
            <div class="shadow-login bg-light">
                <h4 class="border-left-login  py-3 pr-3">فراموشی رمز عبور</h4>
                <form class="login col-12" method="post" action="/password/verifyMobile" id="login">
                    @csrf
                    <div class="group col-12 p-0">
                        <input id="mobile" type="text" name="mobile"><span class="highlight"></span><span
                                class="bar"></span>
                        <label for="mobile">شماره موبایل</label>
                        <img src="{{asset('image/social.png')}}" width="20" alt="">
                        @error('mobile')
                        <span class="text-danger text-small">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-12 px-0">
                        <button type="submit" class="button buttonBlue  rounded" onclick="CheckCaptcha();"
                                value="Submit">
                            ثبت
                            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                        </button>
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
<script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
</body>
</html>