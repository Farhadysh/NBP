<div class="col-12 col-lg-3 side-bar">
    <div class="d-flex flex-column-reverse border rounded position-relative p-3 mt-0 mt-md-5 mb-3">
        <div>
            <p class="m-0 py-1 text-size text-secondary">نام و نام خانوادگی: {{auth()->user()->fullName}}</p>
            <div class="pt-4">
                <form action="{{route('logout')}}" method="post" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger w-100">خروج</button>
                </form>
            </div>
        </div>
        <div class="position-absolute-home-page">
            <div class="border-face p-1">
                <img src="{{asset(auth()->user()->image ? auth()->user()->image : '/image/user.png')}}" width="100" alt="">
            </div>
        </div>
        <div class="hide-img-profile text-center mt-3">
            <img class="border-face p-1" src="{{asset('image/rew3.jpg')}}" width="240" alt="">
        </div>
    </div>
    <div class="rounded border side-bar">
        <ul class="p-2">
            <li class="nav-link pr-0"><a href="/user/homePage" class="text-dark"> صفحه اصلی</a></li>
            <li class="nav-link pr-0"><a href="/user/plans" class="text-dark">خرید شغل</a></li>
            <li class="nav-link pr-0"><a href="/user/orders" class="text-dark">سفارشات</a></li>
            <li class="nav-link pr-0"><a href="/user/checkouts" class="text-dark"> لیست درآمد ها</a></li>
            <li class="nav-link pr-0"><a href="/user/homepage/commission" class="text-dark">لیست پورسانت</a></li>
            <li class="nav-link pr-0"><a href="/user/positions" class="text-dark"> جایگاه های من</a></li>
            <li class="nav-link pr-0"><a href="/user/study" class="text-dark"> آموزش</a></li>
            <li class="nav-link pr-0"><a href="/user/myPackages" class="text-dark"> شغل های من</a></li>
            <li class="nav-link pr-0"><a href="/user/introducing" class="text-dark">معرف ها</a></li>
            <li class="nav-link pr-0"><a href="/user/profileEdit" class="text-dark">پروفایل من</a></li>
        </ul>
    </div>
</div>