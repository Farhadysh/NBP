<nav class="col-12 col-md-2 bg-dark side_res text-light p-0
 collapse show overflow-auto position-absolute" style="top:60px;z-index: 999;bottom: 0" id="sidebar">
    <ul class="nav flex-column px-0 ul_sidebar">
        <li class="nav-item d-flex align-items-center d_down_click pr-3">
            <span class="fa fa-dashboard"></span>
            <a href="/admin" class="nav-link my-1 cursor-pointer">داشبورد</a>
        </li>
        @can('مدیریت محصولات')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-product-hunt"></span>
                <a class="nav-link my-1 cursor-pointer">مدیریت محصولات</a>
                <span class="fa fa-caret-square-o-down mr-auto ml-2"></span>
            </li>
        @endcan
        <div class="d_down_1 hide">
            <li class="nav-item d-flex align-items-center pr-3">
                <span class="fa fa-eye"></span>
                <a href="{{route('admin.products.index')}}" class="nav-link my-1 small text-warning">مشاهده
                    محصولات</a>
            </li>
            <li class="nav-item d-flex align-items-center pr-3">
                <span class="fa fa-plus"></span>
                <a href="{{route('admin.products.create')}}" class="nav-link my-1 small text-warning">افزودن
                    محصول</a>
            </li>
        </div>


        <li class="nav-item d-flex align-items-center d_down_click pr-3">
            <span class="fa fa-product-hunt"></span>
            <a class="nav-link my-1 cursor-pointer">مدیریت برندها</a>
            <span class="fa fa-caret-square-o-down mr-auto ml-2"></span>
        </li>

        <div class="d_down_1 hide">
            <li class="nav-item d-flex align-items-center pr-3">
                <span class="fa fa-eye"></span>
                <a href="{{route('admin.brands.index')}}" class="nav-link my-1 small text-warning">مشاهده
                    برندها</a>
            </li>
            <li class="nav-item d-flex align-items-center pr-3">
                <span class="fa fa-plus"></span>
                <a href="{{route('admin.brands.create')}}" class="nav-link my-1 small text-warning">افزودن
                    برند</a>
            </li>
        </div>

        @can('سفارشات')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-list-alt"></span>
                <a href="{{route('admin.orders.index')}}" class="nav-link my-1 cursor-pointer">سفارشات</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$newOrder}}</span>
            </li>
        @endcan
        @can('سفارشات')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-list-alt"></span>
                <a href="{{route('admin.categories.index')}}" class="nav-link my-1 cursor-pointer">دسته بندی ها</a>
            </li>
        @endcan
        @can('مدیریت برچسب ها')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-user"></span>
                <a href="{{route('admin.tags.index')}}" class="nav-link my-1 cursor-pointer">مدیریت برچسب ها</a>
            </li>
        @endcan

        @can('مدیریت کاربران')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-user"></span>
                <a href="{{route('admin.users.index')}}" class="nav-link my-1 cursor-pointer">مدیریت کاربران</a>
            </li>
        @endcan

        @can('مدیریت نقش ها')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-user"></span>
                <a href="{{route('admin.roles.index')}}" class="nav-link my-1 cursor-pointer">مدیریت نقش ها</a>
            </li>
        @endcan

        @can('اضافه کردن پکیج به کاربر')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-user"></span>
                <a href="{{route('admin.packageCart.withOutPackages')}}" class="nav-link my-1 cursor-pointer">اضافه کردن
                    پکیج به کاربر</a>
            </li>
        @endcan

        @can('مدیریت پلن ها')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-gift"></span>
                <a href="{{route('admin.plans.index')}}" class="nav-link my-1 cursor-pointer">مدیریت شغل ها</a>
            </li>

            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-gift"></span>
                <a href="/admin/plans/buys" class="nav-link my-1 cursor-pointer">لیست خرید شغل</a>
            </li>
        @endcan
        @can('مدیریت پکیج ها')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-gift"></span>
                <a href="{{route('admin.packages.index')}}" class="nav-link my-1 cursor-pointer">مدیریت پکیج ها</a>
            </li>
        @endcan

        @can('مدیریت تخفیف ها')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-dollar-sign"></span>
                <a href="{{route('admin.discounts.index')}}" class="nav-link my-1 cursor-pointer">مدیریت تخفیف ها</a>
            </li>
        @endcan

        @can('مدیریت تسویه')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-dollar-sign"></span>
                <a href="{{route('admin.checkouts.index')}}" class="nav-link my-1 cursor-pointer">مدیریت تسویه</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$checkout}}</span>
            </li>
        @endcan

        @can('مدیریت تسویه تامین کننده')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-dollar-sign"></span>
                <a href="{{route('admin.checkouts.seller')}}" class="nav-link my-1 cursor-pointer">مدیریت تسویه تامین
                    کننده</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$checkoutSeller}}</span>
            </li>
        @endcan

        {{--        <li class="nav-item d-flex align-items-center d_down_click pr-3">--}}
        {{--            <span class="fa fa-dollar-sign"></span>--}}
        {{--            <a href="{{route('admin.incomes.index')}}" class="nav-link my-1 cursor-pointer">مدیریت مالی</a>--}}
        {{--            <span class="mr-auto ml-2 bg-info px-2 rounded">{{$checkout}}</span>--}}
        {{--        </li>--}}

        {{--        <li class="nav-item d-flex align-items-center d_down_click pr-3">--}}
        {{--            <span class="fa fa-comment"></span>--}}
        {{--            <a href="{{route('admin.tickets.index')}}" class="nav-link my-1 cursor-pointer">پیام ها</a>--}}
        {{--            <span class="mr-auto ml-2 bg-info px-2 rounded">{{$contact}}</span>--}}
        {{--        </li>--}}
        @can('پشتیبانی')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-id-card"></span>
                <a href="{{route('admin.tickets.index')}}" class="nav-link my-1 cursor-pointer">پشتیبانی</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$ticketsCount}}</span>
            </li>
        @endcan

        @can('نظرات')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-id-card"></span>
                <a href="{{route('admin.comments.index')}}" class="nav-link my-1 cursor-pointer">نظرات</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$commentsCount}}</span>
            </li>
        @endcan

        <li class="nav-item d-flex align-items-center d_down_click pr-3">
            <span class="fa fa-id-card"></span>
            <a href="{{route('admin.contacts.index')}}" class="nav-link my-1 cursor-pointer">تماس با ما</a>
            <span class="mr-auto ml-2 bg-info px-2 rounded">{{$contactsCount}}</span>
        </li>

        @can('کارت تخفیف')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-id-card"></span>
                <a href="{{route('admin.discountCarts.index')}}" class="nav-link my-1 cursor-pointer">کارت تخفیف</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$discountCount}}</span>
            </li>
        @endcan

        @can('کارت ویزیت')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-credit-card"></span>
                <a href="{{route('admin.visitCarts.index')}}" class="nav-link my-1 cursor-pointer">کارت ویزیت</a>
                <span class="mr-auto ml-2 bg-info px-2 rounded">{{$visitCartCount}}</span>
            </li>
        @endcan

        @can('کتابخانه')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-book"></span>
                <a href="{{route('admin.libraries.index')}}" class="nav-link my-1 cursor-pointer">کتابخانه</a>
            </li>
        @endcan

        @can('درخت')
            <li class="nav-item d-flex align-items-center d_down_click pr-3">
                <span class="fa fa-book"></span>
                <a href="/admin/tree" class="nav-link my-1 cursor-pointer">درخت</a>
            </li>
        @endcan
    </ul>
</nav>