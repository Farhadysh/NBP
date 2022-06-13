<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Free Web tutorials">
    <title>مشخصات محصول</title>
    <link rel="shortcut icon" href="{{ asset('image/Favicon.png') }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
</head>
<body>

<div class="container-fluid p-0 m-0">
    <nav class="nav fixed-top bg-nav navbar-expand-md bg-white p-2">

        <button class="navbar-toggler collapsed border ml-auto mr-3 p-0" style="height: 35px;width: 35px" type="button"
                data-toggle="collapse"
                data-target="#navbar"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="fa fa-bars" style="color: #313131;font-size: 1.2em"></span>
        </button>
        <a href="/" class="navbar-brand mx-3 text-white p-0 m-0">
            <img class="logo_sm" src="{{asset('image/navLogo.png')}}" alt="nbpmarketing" width="100">
        </a>

        <div class="collapse navbar-collapse" id="navbar">
            <div class="col-md-6 mx-auto">
                <form action="{{route('shopping.search')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control font-small border-warning" id="search" name="search"
                               placeholder="جستجو">
                        <div class="input-group-append">
                            <button type="submit" class="text-white input-group-text border-warning fa fa-search"
                                    style="background-color: rgba(249,209,0,0.75)"></button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav ml-md-auto p-0 d-flex flex-column align-items-center flex-md-row nav-hover">
                <li class="nav-item">
                    <a class="nav-link nav_a text-dark small mx-1 font-weight-bold" href="/">صفحه اصلی</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav_a text-dark small mx-1 font-weight-bold" href="/shop">فروشگاه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav_a text-dark small mx-1 font-weight-bold"
                       href="{{route('shopping.categories')}}">محصولات</a>
                </li>
                @if(auth()->user())
                    <li>
                        <div class="dropdown">
                            <a class="logout_btn cursor-pointer d-flex justify-content-between cursor-pointer small"
                               data-toggle="dropdown">
                                <i class="fa fa-users-cog fa-1x ml-1 small"></i>
                                خوش آمدید
                                <i class="rounded-circle bg-success mr-1 mt-1"
                                   style="padding: 4px 4px;width: 4px;height: 4px"></i>
                            </a>
                            <div class="dropdown-menu text-center">
                                <a class="dropdown-item px-0 py-2 text-success small"
                                   href="{{route('user.profileEdit')}}"><i class="fa fa-user ml-1 text-success"></i>پروفایل
                                    من</a>
                                @if(auth()->user()->level == 'visitor' || auth()->user()->level == 'customer' ||  auth()->user()->level == 'admin' )
                                    <a class="dropdown-item px-0 py-2 text-info small"
                                       href="/user/homePage"><i class="fa fa-cogs ml-1 text-info"></i>دفتر
                                        کاری</a>
                                @endif
                                @if(auth()->user()->level == 'admin')
                                    <a class="dropdown-item px-0 py-2 small" href="{{route('admin.index')}}"><i
                                                class="fa fa-cog ml-1"></i>پنل مدیریت</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button class="logout btn text-danger mx-auto px-0 py-1" type="submit" style=""><i
                                                class="fa fa-sign-out-alt ml-1"></i>خروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    <div class="order-lg-0 my-lg-0">
                        <div class="row justify-content-lg-end justify-content-center mr-2 px-3">
                            <a data-toggle="modal" data-target="#myModal2"
                               class=" row align-items-center justify-content-center rounded py-2 px-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <span class="btn border border-left-0 text-muted rounded px-2"
                                          style="font-size: 15px">سبد خرید<span
                                                class="rounded bg-warning text-white mr-2 px-2 font-weight-bold cart_count">{{$cart_count}}</span></span>
                                    <span class="btn border fa fa-cart-arrow-down  rounded-circle px-2 text-muted d-flex align-items-center"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                @else
                    <li>
                        <a data-toggle="modal" data-target="#exampleModalCenter" href="#"
                           class="nav-link nav_a small a text-dark font-weight-bold">ورود/ثبت
                            نام</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content col-md-9 mx-auto px-0" style="border-radius: 15px">
                <div class="background-header-modal shadow-sm">
                    <div class="cover-header-modal shadow-sm">
                        <div class="m-0 p-0 logo-modal">
                            <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width=70">
                        </div>
                    </div>
                </div>
                <div class="modal-body px-5">
                    <div class="show-error">

                    </div>

                    <form class="login_modal">
                        @csrf
                        <h5 class="text-center font-weight-bold mb-3 text-muted">ورود</h5>
                        <div class="input-group border-input shadow-sm">
                            <input class="form-control a" type="text" placeholder="شماره موبایل"
                                   name="mobile">
                            <strong class="error" id="mobile"></strong>
                            <div class="input-group-prepend">
                                <span class="btn fa fa-user"></span>
                            </div>
                        </div>
                        <div class="input-group border-input mt-3 shadow-sm">
                            <input class="form-control a" type="password" placeholder="رمز عبور" name="password">
                            <strong class="error" id="password"></strong>
                            <div class="input-group-prepend">
                                <span class="btn fa fa-lock"></span>
                            </div>
                        </div>
                        <div class="modal-footer mt-4 row">
                            <button style="padding: 8px 90px;border-radius: 15px" type="submit"
                                    class="btn btn-outline-success mt-1">ورود
                            </button>
                        </div>
                        <a href="/user-register" class="btn text-info  mx-1 mb-4">ثبت نام</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>