<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Free Web tutorials">
    <title>پنل کاربری</title>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/panel.css')}}">
    @yield('css')
</head>
<body>
<!--navbar-->
@include('panel.section.nav')
<!--end of navbar-->
<!--modal-->
<div class="modal fade" id="sign-out">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-3 text-secondary">آیا میخواهید خارج شوید؟</h5>
                <button data-dismiss="modal" type="button" class="close mr-auto p-0 m-0 my-3">&times;</button>
            </div>
            <form action="{{route('logout')}}" method="post" class="modal-footer">
                @csrf
                <button type="button" class="btn btn btn-success mx-2" data-dismiss="modal">خیر</button>
                <button type="submit" class="btn btn btn-danger mx-2">بله</button>
            </form>
        </div>
    </div>
</div>
<!--end of modal-->
<!--cards-->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 mr-auto">
                @yield('content')
            </div>
        </div>
    </div>
</section>
<!--end of cards-->
<script type="text/javascript" src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('/js/custom.js')}}"></script>
@yield('scripts')
@include('sweet::alert')
</body>
</html>