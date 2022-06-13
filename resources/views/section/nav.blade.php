<nav class="col-12 navbar navbar-expand-lg header-nav-item navbar-fix bg-nav">
    <button class="navbar-toggler fa fa-align-right text-secondary fa-2x" type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
    </button>
    <div class="mr-auto d-block d-lg-none">
        @if(Auth::check())
            {{--                        <li class="nav-item active text-center">--}}
            {{--                            <a class="nav-link px-3  btn-user-singin" href="/user/homePage"> <i--}}
            {{--                                        class="fa fa-user mx-2"></i> دفتر کاری </a>--}}
            {{--                        </li>--}}

            <div class="dropdown">
                <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenu2"
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
            <li class="nav-item active text-center" style="list-style-type: none">
                <a class="nav-link px-3  btn-user-singin" href="{{route('login')}}"> <i
                            class="fa fa-user mx-2"></i> ورود </a>
            </li>
        @endif
    </div>
    <div class="col-12 col-lg-5 mr-auto m-0 p-0  px-1 mt-2 d-block d-lg-none">
        <form action="/shop/search">
            <div class="form-group has-search m-0">
                <button class="btn fa fa-search form-control-feedback m-0 p-0"></button>
                <input type="text" class="form-control text-white" name="search" placeholder="جستجو">
            </div>
        </form>
    </div>
    <div class="row align-items-center collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="col-12 col-lg-7 navbar-nav p-3 p-lg-0">
            @if(Auth::check())
                {{--                        <li class="nav-item active text-center">--}}
                {{--                            <a class="nav-link px-3  btn-user-singin" href="/user/homePage"> <i--}}
                {{--                                        class="fa fa-user mx-2"></i> دفتر کاری </a>--}}
                {{--                        </li>--}}

                <div class="dropdown d-none d-lg-block">
                    <button class="btn text-white dropdown-toggle" type="button" id="dropdownMenu2"
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
                <li class="nav-item active text-center d-none d-lg-block">
                    <a class="nav-link px-3  btn-user-singin" href="{{route('login')}}"> <i
                                class="fa fa-user mx-2"></i> ورود </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link " href="/">صفحه اصلی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href=/shop> فروشگاه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/about">درباره ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/brands">برندها</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/roles">قوانین و مقررات</a>
            </li>

            @if(Request::segment(1) == "")
                <li class="nav-item contact-us">
                    <a class="nav-link scroll" href="#contact">تماس با ما</a>
                </li>
            @else
                <li class="nav-item contact-us">
                    <a class="nav-link scroll" href="/#contact">تماس با ما</a>
                </li>
            @endif
        </ul>
        <div class="col-12 col-lg-5 mr-auto m-0 p-0  px-1 bg-search d-none d-lg-block">
            <form action="/shop/search">
                <div class="form-group has-search m-0">
                    <button class="btn fa fa-search form-control-feedback m-0 p-0"></button>
                    <input type="text" class="form-control text-white" name="search" placeholder="جستجو">
                </div>
            </form>
        </div>
        <!--<div class="col-2 d-flex justify-content-end">
            <li class="nav-menu d-flex align-items-center  ">
                <strong class="fa fa-phone fa-lg"></strong>
                <p class="m-0 pr-2">0233356589</p>
            </li>
        </div>-->
    </div>
</nav>