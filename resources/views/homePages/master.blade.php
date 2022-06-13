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
    <title>{{$title ?? 'دفتر کاری'}}</title>
    <link rel="shortcut icon" href="{{ asset('image/Favicon.png') }}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/animate.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('/css/new-style.css')}}">

    @yield('css')
</head>
<body>
@include('section.nav')

<div class="container-fluid m-0 p-0">
    <div class="col-12 my-4 px-4">
        <div class="row flex-lg-row overflow-hidden" style="margin-top:100px">
            @include('homePages.section.sidebar')
            @yield('content')

            <div class="col-12 bg-light fixed-bottom py-2 fixed-bottom-sidebar ">
                <div class="owl-carousel footer-nav">
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/homePage" ? 'text-danger' : ''}}"
                           href="/user/homePage">
                            <i class="fa text-secondary fa-home my-2 {{Request::path() == "user/homePage" ? 'text-danger' : ''}} fa-2x"></i>
                            صفحه اصلی
                        </a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/plans" ? 'text-danger' : ''}}"
                           href="/user/plans"> <i
                                    class="fa fa-database my-2 {{Request::path() == "user/plans" ? 'text-danger' : 'text-secondary'}} fa-2x"></i>خرید
                            شغل</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/checkouts" ? 'text-danger' : ''}}"
                           href="/user/checkouts"> <i
                                    class="fa fa-money-bill-alt {{Request::path() == "user/checkouts" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>لیست
                            درآمد ها</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/orders" ? 'text-danger' : 'text-secondary'}}"
                           href="/user/orders"> <i
                                    class="fa fa-user {{Request::path() == "user/orders" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>سفارشات</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/homepage/commission" ? 'text-danger' : ''}}"
                           href="/user/homepage/commission"> <i
                                    class="fa fa-list-alt {{Request::path() == "user/homepage/commission" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>لیست
                            پورسانت ها</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/positions" ? 'text-danger' : ''}}"
                           href="/user/positions"> <i
                                    class="fa fa-sitemap {{Request::path() == "user/positions" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>جایگاه
                            من</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/study" ? 'text-danger' : ''}}"
                           href="/user/study"> <i
                                    class="fa fa-book {{Request::path() == "user/study" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>آموزش</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/myPackages" ? 'text-danger' : 'text-secondary'}}"
                           href="/user/myPackages"> <i
                                    class="fa fa-shopping-bag {{Request::path() == "user/myPackages" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>شغل
                            های من</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/introducing" ? 'text-danger' : ''}}"
                           href="/user/introducing"> <i
                                    class="fa fa-shopping-bag {{Request::path() == "user/introducing" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>معرف
                            ها</a>
                    </div>
                    <div class="">
                        <a class="d-flex flex-column align-items-center {{Request::path() == "user/profileEdit" ? 'text-danger' : 'text-secondary'}}"
                           href="/user/profileEdit"> <i
                                    class="fa fa-user {{Request::path() == "user/profileEdit" ? 'text-danger' : 'text-secondary'}} my-2 fa-2x"></i>پروفایل
                            من</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.mobile-1.4.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/skic-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('js/type.js')}}"></script>
<script type="text/javascript" src="{{asset('js/new.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            center: true,
            rtl: true,
            items: 3,
            loop: true,
            dots: false,
            margin: 5,
            autoplay: false,
            responsive: {
                0: {
                    items: 3
                },
                1000: {
                    items: 2
                },
                1280: {
                    items: 3
                },
            },
        });
    });
</script>
@yield('scripts')
@include('sweet::alert')
</body>
</html>