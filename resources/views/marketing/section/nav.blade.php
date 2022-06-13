<nav class="navbar navbar-expand-lg navbar-light bg-white py-0 fixed-top shadow-sm-menu "
     style="z-index: 99999!important;">
    <a class="navbar-brand d-flex align-items-center mr-0 font-weight-bold text-warning" href="/">N.B.P<img
                src="{{asset('image/logo.png')}}" width="50" alt=""></a>

    @if(!auth()->check())
        <a class="navbar-brand d-flex align-items-center mr-0 text-dark d-block d-md-none" href="/login">ورود/ثبت نام</a>
    @endif

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav pr-0 pr-md-4 m-0">
            <li class="nav-item active px-2">
                <a class="nav-link active-1" href="/">صفحه اصلی </a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="/shop">فروشگاه</a>
            </li>
            {{--            <li class="nav-item px-2">--}}
            {{--                <a class="nav-link" href="#">محصولات</a>--}}
            {{--            </li>--}}

        </ul>
        <div class="col-12 col-lg-5 mr-auto">
            <div class="row">
                <form action="/shop/search" class="col-12 ">
                    <div class="form-group has-search m-0">
                        <button class="btn fa fa-search text-secondary form-control-feedback  m-0 p-0"></button>
                        <input type="text" name="search" class="form-control nav-link text-black"
                               placeholder="جستجو">
                    </div>
                </form>
            </div>
        </div>
        @if(Auth::check())
            <div class="dropdown">
                <button class="btn text-dark dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user pl-2"></i>
                    {{auth()->user()->fullName}}
                </button>
                <div class="dropdown-menu  dropdown-menu-right text-right" aria-labelledby="dropdownMenu2">
                    @if(Auth::check() && auth()->user()->isAdmin())
                        <a href="/admin" class="dropdown-item" type="button">پنل مدیریت</a>
                    @endif
                    @if(Auth::check() && auth()->user()->isSeller())
                        <a href="/panel" class="dropdown-item" type="button">پنل مدیریت</a>
                    @endif
                    <a href="/user/homePage" class="dropdown-item" type="button">دفتر کاری</a>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">خروج</button>
                    </form>
                </div>
            </div>
        @else

            <a class="text-gray-menu" href="{{route('login')}}" style="font-size: 16px">ورود</a>

        @endif
    </div>
    <div class="d-flex">
        @if(Auth::check())
            <div class="d-flex mx-4 ">
                <div class="position-relative">
                    <span class="position-absolute-bag-num">{{$cart_count}}</span>
                    <button class="btn"><img src="{{asset('image/bag.png')}}" data-toggle="modal"
                                             data-target="#myModal2" width="22" alt=""></button>
                </div>
            </div>
        @endif
        <button class="navbar-toggler p-0" type="button" data-toggle="collapse"
                onclick="$('.nav-menus-wrapper').toggleClass('nav-menus-wrapper-open')"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="btn"><i class="fa fa-align-right"></i> </span>
        </button>
    </div>
</nav>
<header class="header_area margin-top">
    <div class="main_header_area animated">
        <div class="">
            <nav id="navigation1" class="navigation">
                <div class="nav-header">
                    <div class=" hide-search my-2">
                        <form action="/shop/search" class="col-12 ">
                            <div class="form-group has-search m-0">
                                <button class="btn fa fa-search text-secondary form-control-feedback  m-0 p-0"></button>
                                <input type="text" name="search" class="form-control nav-link text-black"
                                       placeholder="جستجو">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="nav-menus-wrapper ">
                    <ul class="nav-menu align-to-right">
                        <li class="hide-search"><a href="/agent"> <i class="fa fa-home text-secondary mx-3"></i>نمایندگی NBP</a></li>
                        <li class="hide-search"><a href="/shop"> <i class="fa fa-shopping-cart text-secondary mx-3"></i>
                                فروشگاه</a></li>
                        <li class="hide-search">
                            @if(Auth::check())
                                <a href="#"> <i
                                            class="fa fa-user text-secondary mx-3"></i>{{auth()->user()->fullName}}
                                </a>

                                <div class="megamenu-panel">
                                    <div class="megamenu-lists">
                                        <ul class="megamenu-list list-col-4">
                                            <li><a href="/user/homePage">دفتر کاری</a></li>
                                            @if(Auth::check() && auth()->user()->isAdmin())
                                                <li><a href="/admin">پنل مدیریت</a></li>
                                            @endif
                                            @if(Auth::check() && auth()->user()->isSeller())
                                                <a href="/panel" class="dropdown-item" type="button">پنل مدیریت</a>
                                            @endif
                                            <li>
                                                <form action="{{route('logout')}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        خروج
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else

                                <a href="/login"> <i
                                            class="fa fa-sign-in-alt text-secondary mx-3"></i>ورود
                                </a>
                            @endif
                        </li>

                        @foreach($category_nav as $category)
                            <li>
                                <a href="#">{{$category->name}}</a>
                                @if(count($category->children))
                                    <div class="megamenu-panel">
                                        <div class="megamenu-lists">
                                            <ul class="megamenu-list d-flex flex-row flex-md-column flex-wrap height-category">
                                                @foreach($category->children as $child)
                                                    <li class="col-12 col-md-3">
                                                        <a class="w-100"
                                                           href="/shop/allProducts/{{$child->slug}}">{{$child->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach

                        <li class="hide-search">
                            <a href="/about">
                                درباره ما</a>
                        </li>

                        <li class="hide-search">
                            <a href="/brands">
                                برندها</a>
                        </li>

                        <li class="hide-search">
                            <a href="/roles">
                                قوانین و مقررات</a>
                        </li>


                        <li class="hide-search">
                            <a href="/#contact">
                                تماس با ما</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
