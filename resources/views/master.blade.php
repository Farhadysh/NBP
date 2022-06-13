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
    <meta name="enamad" content="147112"/>
    <title>{{$title ?? "نوآوری بسبک پی"}}</title>
    <link rel="shortcut icon" href="{{ asset('image/Favicon.png') }}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('/css/new-style.css')}}">
    @yield('css')
</head>
<body>

<div class="container-fluid m-0 p-0">
    @include('section.nav')
    <div style="margin-top: 65px"></div>
    @yield('content')
    @include('section.footer')
</div>

<script type="text/javascript" src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/type.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/skic-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/new.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/nav.js')}}"></script>

@yield('scripts')
@include('sweet::alert')
</body>
</html>