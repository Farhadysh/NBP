<nav class="main-header navbar sticky-top bg-white navbar-expand-md navbar-light p-0 border-bottom">
    <div class="d-flex align-items-center bg-dark nav_res">
        <span class="fa fa-align-right mx-3 text-light fa-2x" data-toggle="collapse" data-target="#sidebar"></span>
        <a href="#" class="navbar-brand py-3 px-4 m-0 h3 text-light" style="width: 164px">پنل مدیریت </a>
        <img class="mr-5 logo_res" src="" width="50">
    </div>
    <a href="/" class="btn btn-outline-info btn-sm mr-5">صفحه اصلی</a>
    <div class="collapse navbar-collapse main-header">
        <img class="mr-5" src="" width="50">
        <div class="ml-3 mr-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="{{route('admin.checkouts.index')}}" class="fa fa-sticky-note-o nav-link">
                        <span class="badge badge-danger navbar-badge">{{$checkout}}</span>
                    </a>
                    <a href="#" data-toggle="dropdown" class="fa fa-print nav-link">
                        <span class="badge badge-danger navbar-badge"></span>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                            <a class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <div class="media-body text-center">
                                        <h3 class="dropdown-item-title m-0 text-muted">
                                                 <span
                                                         class="count_change bg-danger text-white px-2 rounded-circle">{{--{{$change}}--}}</span>

                                        </h3>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href=""
                               class="dropdown-item dropdown-footer text-center text-info">مشاهده فاکتور ها</a>
                        </div>
                    </a>

                </li>
                <li class="bav-item">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="nav-link btn fa fa-sign-out"
                                data-toggle="tooltip"
                                data-placement="bottom" title="خروج"
                        ></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>