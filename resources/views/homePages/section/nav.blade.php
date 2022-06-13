<div class="" id="home">
    <nav class="col-12 navbar navbar-expand-lg header-nav-item navbar-fix bg-dark py-3">
        <button class="navbar-toggler fa fa-align-right text-secondary fa-2x" type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
        </button>
        <div class="row align-items-center collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="col-12 col-lg-7 navbar-nav p-3 p-lg-0">
                @if(Auth::check())
                    <li class="nav-item active text-center">
                        <a class="nav-link px-3  btn-user-singin" href="/user/homePage"> <i
                                    class="fa fa-user mx-2"></i> دفتر کاری </a>
                    </li>
                @else
                    <li class="nav-item active text-center">
                        <a class="nav-link px-3  btn-user-singin" href="{{route('login')}}"> <i
                                    class="fa fa-user mx-2"></i> ورود </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/">صفحه اصلی</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shop"> فروشگاه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/about">درباره ما</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/brands">برندها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/roles">قوانین و مقررات</a>
                </li>

                <li class="nav-item contact-us">
                    <a class="nav-link" href="/#contact">تماس با ما</a>
                </li>

                <li class="nav-item d-block d-md-none">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm text-white">خروج</button>
                    </form>
                </li>
            </ul>
            <div class="col-12 col-lg-5 mr-auto m-0 p-0 pb-3 pb-md-0 px-1 px-3 bg-search-box">
                <form action="/shop/search">
                    <div class="form-group has-search m-0">
                        <button class="btn fa fa-search form-control-feedback m-0 p-0"></button>
                        <input type="text" name="search" class="form-control" placeholder="جستجو">
                    </div>
                </form>
            </div>
        </div>
    </nav>
</div>