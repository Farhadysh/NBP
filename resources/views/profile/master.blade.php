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
    <title>حساب کاربری</title>
    <link rel="shortcut icon" href="{{ asset('image/Favicon.png') }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>

@yield('nav')

<div class="container-fluid m-0 p-0 overflow-hidden">
    @include('homePages.section.nav')
    @yield('content')
</div>

<script type="text/javascript" src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
<script type="text/javascript">
    function myfunction() {
        $('#toggle-profile').toggleClass('close-profile')
    }
</script>
@yield('scripts')
@include('sweet::alert')
</body>
</html>