<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar"
            aria-haspopup="true" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
            <div class="row">
                <!--sidebar-->
            @include('panel.section.sidebar')
            <!--end of sidebar-->
                <!--top nav-->
                <div class="col-xl-10 col-lg-9 col-md-8  mr-auto bg-white fixed-top py-2 top-navbar">
                    <div class="row align-items-center">
                        <div class="col-md-6 my-auto">
                            <div class="hover-nav">
                                <img src="{{asset('image/square-face.jpg')}}" width="50" class="rounded-circle mr-3">
                                <a class="text-muted mr-2 ">پروفایل من<i
                                            class="fa fa-angle-down text-muted mr-1 mb-0 pb-0"></i></a>
                                <div class="drop-nav" id="collapseExample">
                                    <div class="drop-profile d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset(auth()->user()->image ?? 'image/square-face.jpg')}}"
                                             class="rounded-circle" alt="#"
                                             width="60">
                                        <p class="text-justify text-center text-light">{{auth()->user()->fullName}}</p>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="/panel/profile"><span class="fa fa-user p-1 mx-2"></span> ورود به پروفایل </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 my-md-0 py-2 ">
                            <ul class="a navbar-nav align-items-center justify-content-md-end flex-row">
{{--                                <li class="nav-item icon-parent">--}}
{{--                                    <a href="#" class="mx-1"><img src="{{asset('image/bell.png')}}" width="40" alt=""><i--}}
{{--                                                class="nav-link icon-bullets">2</i></a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item icon-parent mx-3">--}}
{{--                                    <a href="#" class="mx-1">--}}
{{--                                        <img src="{{asset('image/38-383285_email-clipart-opened-envelope-icon-email-png.png')}}"--}}
{{--                                             width="23" alt=""><i--}}
{{--                                                class="nav-link icon-bullet">5</i></a>--}}
{{--                                </li>--}}
                                <li class="nav-item mr-auto mr-md-0">
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button class="btn">
                                            <i class="fas fa-sign-out-alt text-danger  fa-lg" title="خروج"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end of top nav-->
            </div>
        </div>
    </div>
</nav>