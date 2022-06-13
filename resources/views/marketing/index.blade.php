@extends('marketing.master')

@section('content')
    <div class=" margin-top position-relative">
        <div class="owl-carousel " id="owl-1">
            <div class="" style="width: 100%">
                <img src="image/person-shopping-online-3944405.png" class="border-radius height-slider" width="100%"
                     alt="">
                {{--                <div class="cover-position d-flex align-items-center  justify-content-center">--}}
                {{--                    <div class="col-12 ">--}}
                {{--                        <div class="row ">--}}
                {{--                            <div class="col-12 col-lg-6 px-0 px-md-2 d-flex align-items-center justify-content-center flex-column text-gold">--}}
                {{--                                <h1 class="text-gold text-logo">NBP</h1>--}}
                {{--                                <h2 class="text-gold">نوآوری به سبک پی</h2>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-12 col-lg-6 px-0 px-md-2">--}}
                {{--                                <h4 class="text-light p-0 p-md-5 text-center text-line-height">اولین و تنها فروشگاه--}}
                {{--                                    اینترنتی با--}}
                {{--                                    قابلیت بازاریابی برای مشتاقان به امر فروش</h4>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="btn-slider d-none d-md-block">
            <button class="next1 btn fa fa-chevron-right" id="next-slider-Representation__image"></button>
            <button class="prev1 btn fa fa-chevron-left" id="prev-slider-Representation__image"></button>
        </div>
    </div>
    <div class="col-12 px-0 my-3">
        <div class=" pl-3 pl-md-0 background-slider">
            <div class="d-flex align-items-center overflow-auto">
                <div class="col-5 col-md-3 p-0 p-md-5 text-center image-size-slider">
                    <img src="image/img-slider.png" alt="">
                </div>
                <div class="col-7 col-md-9 pl-2 pl-md-5 d-none d-md-block">
                    <button class="next-owl btn fa fa-chevron-right" id="next-btn-owl"></button>
                    <div class="owl-carousel py-4 position-relative" id="owl-4">
                        @foreach($amazingProducts as $amazing)
                            <div class="item d-flex flex-column align-items-center justify-content-center bg-white rounded">
                                <a href="/shop/products/{{$amazing->slug}}" class="p-4">
                                    <div class="position-relative">
                                        <img src="{{$amazing->imagePath()}}" alt="{{$amazing->name}}" width="100px"
                                             height="150px">
                                        <div class="hover-border d-flex align-items-center justify-content-center">
                                            <p class="m-0">{{$amazing->user->nickname ?? ""}}</p>
                                        </div>
                                    </div>
                                </a>
                                <p class="m-0 py-2 text-center single-line small-text">{{Str::limit($amazing->name,20)}}</p>
                                <del class="m-0 text-danger small"> {{number_format($amazing->price)}} تومان</del>
                                <p class="text-success pt-2"> {{$amazing->discount}} تومان</p>
                            </div>
                        @endforeach

                    </div>

                    <button class="prev-owl btn fa fa-chevron-left" id="prev-btn-owl"></button>

                </div>
                {{--                <div class="col-7 d-flex d-md-none pl-3">--}}
                <div class="d-flex d-md-none">
                    @foreach($amazingProducts as $amazing)
                        <div class=" d-flex flex-column align-items-center justify-content-center bg-white rounded mx-2 my-3">
                            <a href="/shop/products/{{$amazing->slug}}" class="p-4">
                                <div class="position-relative">
                                    <div style="width: 150px">
                                        <img src="{{$amazing->imagePath()}}" alt="{{$amazing->name}}" width="100%">
                                    </div>
                                    <div class="hover-border d-flex align-items-center justify-content-center">
                                        <p class="m-0">{{$amazing->user->nickname ?? ""}}</p>
                                    </div>
                                </div>
                            </a>
                            <p class="m-0 py-2 text-center small-text single-line">{{Str::limit($amazing->name,20)}}</p>
                            <del class="m-0 text-danger small"> {{number_format($amazing->price)}} تومان</del>
                            <p class="text-success pt-2"> {{$amazing->discount}} تومان</p>
                        </div>
                    @endforeach
                </div>
                {{--                </div>--}}
            </div>
        </div>
    </div>
    {{--    <div class="col-12">--}}
    {{--        <div class="row justifay-content-center pb-3">--}}
    {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--                <a href="/shop/categories/سبد-آرایشی">--}}
    {{--                    <img class="hover" src="{{asset('image/Group%2058.png')}}" width="100%"--}}
    {{--                         alt="سبدآرایشی">--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--                <a href="shop/categories/سبد-مواد-غذایی">--}}
    {{--                    <img class="hover" src="{{asset('image/Group%2067.png')}}"--}}
    {{--                         width="100%" alt="سبد مواد غذایی">--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            --}}{{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--            --}}{{--                <a href="/shop/categories/سبد-تزئینات">--}}
    {{--            --}}{{--                    <img class="hover" src="{{asset('image/tazinat.png')}}" width="100%" alt="سبد تزئینات"></a>--}}
    {{--            --}}{{--            </div>--}}
    {{--            --}}{{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--            --}}{{--                <a href="/shop/categories/سبد-عمده">--}}
    {{--            --}}{{--                    <img class="hover" src="{{asset('image/Group%2060.png')}}" width="100%" alt="سبد عمده">--}}
    {{--            --}}{{--                </a>--}}
    {{--            --}}{{--            </div>--}}
    {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--                <a href="/shop/categories/سبد-لوازم-خانگی">--}}
    {{--                    <img class="hover" src="{{asset('image/lavazem%20khanegi.png')}}" width="100%"--}}
    {{--                         alt="سبد لوازم خانگی">--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            --}}{{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
    {{--            --}}{{--                <a href="/shop/categories/سبد-منسوجات">--}}
    {{--            --}}{{--                    <img class="hover" src="{{asset('image/Group%2061.png')}}" width="100%" alt="سبد منسوجات">--}}
    {{--            --}}{{--                </a>--}}
    {{--            --}}{{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="col-12 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{asset('image/shopping-bag%20(1).png')}}" class="icon-small" width="55" alt="">
                <div class="d-flex flex-column mr-2">
                    <strong class="pb-2 small-text">پربازدید ترین‌ها</strong>
                    {{--                    <strong class="text-gray-menu  small-text">123 محصول</strong>--}}
                </div>
            </div>
            <div class="border-aline"></div>
            <div class="slide">
                <button class="next btn  fa fa-chevron-right" id="next"></button>
                <button class="prev btn fa fa-chevron-left" id="prev"></button>
            </div>
        </div>
    </div>
    <div class="col-12 py-3">
        <div class="owl-carousel" id="owl-2">
            @foreach($mostViewProducts as $mostView)
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <a href="/shop/products/{{$mostView->slug}}" class="hover">
                        <div class="position-relative">
                            <div style="width: 150px">
                                <img src="{{asset($mostView->imagePath())}}" alt="{{$mostView->name}}"
                                     title="{{$mostView->name}}" width="100%">
                            </div>
                            <div class="hover-border d-flex align-items-center justify-content-center">
                                <p class="m-0">{{$mostView->user->nickname ?? ""}}</p>
                            </div>

                        </div>
                    </a>
                    <p class="m-0 py-3 single-line small-text">{{Str::limit($mostView->name,20)}}</p>
                    <del class="m-0 text-danger small"> {{number_format($mostView->price)}} تومان</del>
                    <p class="text-success pt-2"> {{number_format($mostView->discount)}} تومان</p>
                    <div class="d-flex align-items-center justify-content-center w-100 py-0">
                        <a href="/shop/allProducts/{{$mostView->categories->first()->slug}}">
                            <p class="m-0 text-gray-menu"><i
                                        class="fa fa-list pl-2"></i>{{$mostView->categories->first()->name}}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 px-0 my-3">
        <div class=" pl-3 pl-md-0 background-slider1">
            <div class="d-flex align-items-center overflow-auto">
                <div class="col-5 col-md-3 p-0 p-md-5 text-center image-size-slider">
                    <img src="image/img-slider1.png" alt="">
                </div>
                <div class="col-7 col-md-9 pl-2 pl-md-5 d-none d-md-block">
                    <button class="next-owl btn fa fa-chevron-right" id="next-btn-owl1"></button>
                    <div class="owl-carousel py-4 position-relative" id="owl-5">
                        @foreach($bestSellers as $bestP)
                            <div class="item d-flex flex-column align-items-center justify-content-center bg-white rounded">
                                <a href="/shop/products/{{$bestP->slug}}" class="p-4">
                                    <div class="position-relative">
                                        <img src="{{$bestP->imagePath()}}" alt="{{$bestP->name}}" width="100px"
                                             height="150px">
                                        <div class="hover-border d-flex align-items-center justify-content-center">
                                            <p class="m-0">{{$bestP->user->nickname ?? ""}}</p>
                                        </div>
                                    </div>
                                </a>
                                <p class="m-0 py-2 text-center single-line small-text">{{Str::limit($bestP->name,20)}}</p>
                                <del class="m-0 text-danger small"> {{number_format($bestP->price)}} تومان</del>
                                <p class="text-success pt-2"> {{$bestP->discount}} تومان</p>
                            </div>
                        @endforeach
                    </div>

                    <button class="prev-owl btn fa fa-chevron-left" id="prev-btn-owl2"></button>

                </div>
                {{--                <div class="col-7 d-flex d-md-none pl-3">--}}
                <div class="d-flex d-md-none">
                    @foreach($bestSellers as $bestP)
                        <div class=" d-flex flex-column align-items-center justify-content-center bg-white rounded mx-2 my-3">
                            <a href="/shop/products/{{$bestP->slug}}" class="p-4">
                                <div class="position-relative">
                                    <div style="width: 150px">
                                        <img src="{{$bestP->imagePath()}}" alt="{{$bestP->name}}" width="100%"></div>
                                    <div class="hover-border d-flex align-items-center justify-content-center">
                                        <p class="m-0">{{$bestP->user->nickname ?? ""}}</p>
                                    </div>
                                </div>
                            </a>
                            <p class="m-0 py-2 text-center small-text single-line">{{Str::limit($bestP->name,20)}}</p>
                            <del class="m-0 text-danger small"> {{number_format($bestP->price)}} تومان</del>
                            <p class="text-success pt-2"> {{$bestP->discount}} تومان</p>
                        </div>
                    @endforeach
                </div>
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row justifay-content-center py-3 ">
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-آرایشی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2058.png')}}" width="100%"--}}
            {{--                         alt="سبدآرایشی">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/خدمات-چاپی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2059.png')}}" width="100%" alt="خدمات چاپی">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-لوازم-خودرو">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2066.png')}}" width="100%" alt="سبد لوازم خودرو">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="shop/categories/سبد-مواد-غذایی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2067.png')}}"--}}
            {{--                         width="100%" alt="سبد مواد غذایی">--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
    </div>
    <div class="col-12 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="image/shopping-bag%20(1).png" class="icon-small" width="55" alt="">
                <div class="d-flex flex-column mr-2">
                    <strong class="pb-2 small-text"> تامین کنندگان برتر</strong>
                    <strong class="text-gray-menu small-text">10 نفر برتر این ماه</strong>
                </div>
            </div>
            <div class="border-aline"></div>
            {{--<a href="#" class="btn btn-warning-content rounded">مشاهده همه تامین کنندگان</a>--}}
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex align-items-center">
            <div class="col-1 text-center hide-btn">
                <button class="next btn  fa fa-chevron-right " id="Supplier1"></button>
            </div>
            <div class="col-10 mx-auto">
                <div class="owl-carousel owl-theme " id="owl-3">
                    @foreach($bestSellersUser as $bb)
                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <img src="{{$bb->image}}" style="width: 220px" alt="">
                            <strong class="py-4 text-secondary">{{$bb->fullName}}</strong>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1 text-center hide-btn">
                <button class="prev btn fa fa-chevron-left" id="Supplier2"></button>
            </div>
        </div>
    </div>
    <div class="col-12 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="image/shopping-bag%20(1).png" class="icon-small" width="55" alt="">
                <div class="d-flex flex-column mr-2">
                    <strong class="pb-2 small-text"> جدیدترین ها</strong>
                    {{--                    <strong class="text-gray-menu small-text">123 محصول</strong>--}}
                </div>
            </div>
            <div class="border-aline-1"></div>
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex overflow-auto-scroll flex-row flex-md-wrap">
            @foreach($new_products as $new)
                <div class=" col-sm-6 col-md-3 mx-auto py-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <a href="/shop/products/{{$new->slug}}" class="hover">
                            <div class="position-relative">
                                <img src="{{asset($new->imagePath())}}" width="150" alt="{{$new->name}}"
                                     title="{{$new->name}}">
                                <div class="hover-border d-flex align-items-center justify-content-center">
                                    <p class="m-0">{{$new->user->nickname ?? ""}}</p>
                                </div>
                            </div>
                        </a>
                        <p class="m-0 py-3 small-text single-line d-flex d-md-none">{{Str::limit($new->name,20)}}</p>
                        <p class="m-0 py-3 small-text d-none d-md-flex">{{Str::limit($new->name,35)}}</p>

                        <del class="m-0 text-danger small"> {{number_format($new->price)}} تومان</del>
                        <p class="text-success pt-2"> {{number_format($new->discount)}} تومان</p>
                        <div class="d-flex align-items-center justify-content-center w-100 pb-3">
                            <a href="/shop/allProducts/{{$new->categories->first()->slug}}">
                                <p class="m-0 text-gray-menu"><i
                                            class="fa fa-list pl-2"></i>{{$new->categories->first()->name}}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <div class="row justifay-content-center py-3 ">

            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-آرایشی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2058.png')}}" width="100%"--}}
            {{--                         alt="سبدآرایشی">--}}
            {{--                </a>--}}
            {{--            </div>--}}

            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-بهداشتی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2062.png')}}" width="100%" alt="سبد بهداشتی"></a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-خدماتی">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2063.png')}}" width="100%" alt="سبد خدماتی">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-لاکچری">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2064.png')}}" width="100%" alt="سبد لاکچری">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            {{--            <div class="col-6 col-sm-4 col-md-3 my-2 px-1 mx-auto">--}}
            {{--                <a href="/shop/categories/سبد-الکترونیک">--}}
            {{--                    <img class="hover" src="{{asset('image/Group%2065.png')}}" width="100%" alt="سبد الکترونیک">--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
    </div>
    <div class="col-12 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="image/shopping-bag%20(1).png" class="icon-small" alt="">
                <div class="d-flex flex-column mr-2">
                    <strong class="pb-2 small-text"> محصولات ویژه</strong>
                    <strong class="text-gray-menu small-text">123 محصول</strong>
                </div>
            </div>
            <div class="border-aline-1"></div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            @foreach($specialProduct as $spp)
                <div class="col-10 col-sm-6 col-md-4 col-lg-3 mx-auto py-3">
                    <div class="d-flex flex-column  justify-content-center">
                        <div class="d-flex">
                            <a href="/shop/products/{{$spp->slug}}" class="hover">
                                <div class="position-relative">
                                    <div style="width: 100px">
                                        <img src="{{asset($spp->imagePath())}}" width="100%" alt="{{$spp->name}}"></div>
                                    <div class="hover-border d-flex align-items-center justify-content-center">
                                        <p class="m-0">{{$spp->user->nickname ?? ""}}</p>
                                    </div>
                                </div>
                            </a>
                            <div class="d-flex flex-column pr-2">
                                <p class="m-0 small-text">{{$spp->name}}</p>
                                <del class="m-0 text-danger small"> {{number_format($spp->price)}} تومان</del>
                                <p class="text-success pt-2"> {{number_format($spp->discount)}} تومان</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between w-100 py-3">
                            <a href="/shop/allProducts/{{$spp->categories->first()->slug}}">
                                <p class="m-0 text-gray-menu"><i
                                            class="fa fa-list pl-2"></i>{{$spp->categories->first()->name}}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <div class="text-center border-top py-3">
            <div>
                <button class="btn text-secondary" id="goTop"><i class="fa fa-arrow-up"></i> برگشت به بالا</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
			$('#goTop').each(function () {
				$(this).click(function () {
					$('html,body').animate({scrollTop: 0}, 'slow');
					return false;
				});
			});

			$('#next-btn-owl1').click(function () {
				slide_2.trigger('next.owl.carousel');
			});
			$('#prev-btn-owl2').click(function () {
				slide_2.trigger('prev.owl.carousel');
			});
			var slide_2 = $('#owl-5');
			slide_2.owlCarousel({
				items: 1,
				rtl: true,
				center: false,
				dots: false,
				width: 20,
				loop: true,
				margin: 10,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					1000: {
						items: 3
					},
					1280: {
						items: 4
					},
				},
			});


			$('#next-btn-owl').click(function () {
				slide_1.trigger('next.owl.carousel');
			});
			$('#prev-btn-owl').click(function () {
				slide_1.trigger('prev.owl.carousel');
			});
			var slide_1 = $('#owl-4');
			slide_1.owlCarousel({
				items: 1,
				rtl: true,
				center: false,
				dots: false,
				// width: 20,
				loop: true,
				margin: 10,
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: 2,
					},
					1000: {
						items: 3
					},
					1280: {
						items: 4
					},
				},
			});

			var support = $('#owl-3');
			support.owlCarousel({
				items: 1,
				rtl: true,
				center: true,
				dots: false,
				width: 20,
				loop: true,
				margin: 10,
				responsive: {
					0: {
						items: 1
					},
					400: {
						items: 1
					},
					1000: {
						items: 1
					},
					1280: {
						items: 1
					},
				},
			});
			$('#Supplier1').click(function () {
				support.trigger('next.owl.carousel');
			});
			$('#Supplier2').click(function () {
				support.trigger('prev.owl.carousel');
			});

			var head = $('#owl-1');
			head.owlCarousel({
				rtl: true,
				dots: true,
				loop: true,
				autoplayHoverPause: true,
				autoplayTimeout: 3000,
				autoplay: true,
				animateOut: 'slideOutUp',
				animateIn: 'flipInX',
				items: 1,
				smartSpeed: 450
			});


			$('#next-slider-Representation__image').click(function () {
				head.trigger('next.owl.carousel');
			});
			$('#prev-slider-Representation__image').click(function () {
				head.trigger('prev.owl.carousel');
			});


			let slider = $('#owl-2');
			slider.owlCarousel({
				rtl: true,
				items: 4,
				dots: false,
				center: true,
				loop: true,
				/*autoplayHoverPause: true,
                autoplayTimeout: 2000,
                autoplay: true,*/
				margin: 30,
				responsive: {
					0: {
						items: 1
					},
					375: {
						items: 2
					},
					600: {
						items: 2
					},
					1000: {
						items: 3
					},
					1280: {
						items: 5
					},
				},
			});
			$('#next').click(function () {
				slider.trigger('next.owl.carousel');
			});
			$('#prev').click(function () {
				slider.trigger('prev.owl.carousel');
			});
    </script>
@endsection
