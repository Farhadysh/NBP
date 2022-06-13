<div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
    <a href="" class="navbar-brand d-block mx-auto text-center py-3 mb-4 text-slide bottom-border">پنل مدیریت</a>
    <ul class="navbar-nav flex-column mt-4 pr-0 accordion" id="accordionExample">

        <li class="nav-item"><a href="/panel" class="nav-link text-slide p-2 mb-2 sidebar-link"><img
                        src="{{asset('image/internet%20(2).png')}}" class="ml-2" alt="">صفحه اصلی</a>
        </li>
        <div>
            <li class="nav-item">
                <a href="" class="nav-link text-slide p-2 mb-2 sidebar-link" data-toggle="collapse"
                   data-target="#products" aria-expanded="true" aria-controls="collapseOne"><img
                            src="{{asset('image/product%20(6).png')}}" class="ml-2" alt="">
                    مدیریت کالا <i class="fa fa-angle-down mx-2 float-left"></i> </a>
            </li>
            <div id="products" class="collapse {{Request::segment(2) == 'products' ? 'show' : ''}}"
                 aria-labelledby="headingOne"
                 data-parent="#accordionExample">
                <li><a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links"
                       href="{{route('panel.products.create')}}">افزودن کالا</a>
                </li>
                <li><a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links" href="{{route('panel.products.index')}}">لیست
                        کالا ها</a>
                </li>
                <li><a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links" href="{{route('panel.products.unconfirmed')}}">لیست
                        کالا ها تایید نشده</a>
                </li>
            </div>
        </div>

        <div>
            <li class="nav-item">
                <a href="" class="nav-link text-slide p-2 mb-2 sidebar-link" data-toggle="collapse"
                   data-target="#orders" aria-expanded="true" aria-controls="collapseTwo"><img
                            src="{{asset('image/box.png')}}" class="ml-2" alt="">سفارش ها <i
                            class="fa fa-angle-down mx-2 float-left"></i> </a>
            </li>
            <div id="orders" class="collapse {{Request::segment(2) == 'orders' ? 'show' : ''}}"
                 aria-labelledby="headingTwo"
                 data-parent="#accordionExample">
                <li>
                    <a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links" href="{{route('panel.orders.index')}}">
                        لیست سفارشات
                    </a>
                </li>
            </div>

            <div>
                <li class="nav-item">
                    <a href="" class="nav-link text-slide p-2 mb-2 sidebar-link" data-toggle="collapse"
                       data-target="#checkouts" aria-expanded="true" aria-controls="collapseTwo"><img
                                src="{{asset('image/box.png')}}" class="ml-2" alt="">تسویه حساب<i
                                class="fa fa-angle-down mx-2 float-left"></i> </a>
                </li>
                <div id="checkouts" class="collapse {{Request::segment(2) == 'orders' ? 'show' : ''}}"
                     aria-labelledby="headingTwo"
                     data-parent="#accordionExample">
                    <li>
                        <a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links"
                           href="{{route('panel.checkouts.index')}}">
                            لیست درخواست ها
                        </a>
                        <a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links"
                           href="{{route('panel.checkouts.create')}}">
                            درخواست جدید
                        </a>
                    </li>
                </div>
            </div>

            <div>
                <li class="nav-item">
                    <a href="" class="nav-link text-slide p-2 mb-2 sidebar-link" data-toggle="collapse"
                       data-target="#tickets" aria-expanded="true" aria-controls="collapseTwo"><img
                                src="{{asset('image/box.png')}}" class="ml-2" alt="">پشتیبانی
                        <span class="badge badge-danger">{{$replyCount}}</span>
                        <i
                                class="fa fa-angle-down mx-2 float-left"></i> </a>
                </li>
                <div id="tickets" class="collapse {{Request::segment(2) == 'tickets' ? 'show' : ''}}"
                     aria-labelledby="headingTwo"
                     data-parent="#accordionExample">
                    <li>
                        <a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links"
                           href="{{route('panel.tickets.index')}}">
                            لیست درخواست ها
                        </a>
                        <a class="nav-link text-slide p-1 mb-1 mr-2 sidebar-links"
                           href="{{route('panel.tickets.create')}}">
                            درخواست جدید
                        </a>
                    </li>
                </div>

                <div>
                    <li class="nav-item">
                        <a href="{{route('panel.comments.index')}}" class="nav-link text-slide p-2 mb-2 sidebar-link"
                        ><img src="{{asset('image/box.png')}}" class="ml-2" alt="">
                            نظرات <span class="badge badge-danger">{{$commentCount}}</span>
                            <i class="fa fa-angle-down mx-2 float-left"></i> </a>
                    </li>
                </div>
            </div>
        </div>
    </ul>
</div>
