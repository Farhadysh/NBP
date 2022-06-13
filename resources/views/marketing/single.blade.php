@extends('marketing.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection

@section('content')
    <div class="bg-light pb-5 pt-0 pt-md-5">
        <div class="col-md-12 bg-white p-3 shadow-sm medium-radius">
            <div class="row">
                <div class="col-12 col-lg-4 text-center">
                    <div class="text-center ">
                        <img id="change_image" src="{{$product->imagePath()}}" alt="{{$product->name}}"
                             class="block__pic">
                    </div>
                    <div class="col-lg-auto">
                        <ul class="nav" id="small_image">
                            @foreach($product->images as $image)
                                <li>
                                    <img src="{{$image->imagePath()}}" alt="{{$image->product->name}}" width="70"
                                         class="image-click m-1 border medium-radius">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg mt-4 mt-md-0 ">
                    <div class="row">
                        <div class="col-md mb-4">
                            <div class="title-bg d-flex flex-column flex-md-row justify-content-md-between">
                                <div class="">
                                    <h1 class="product_title entry-title font-weight-bold">{{$product->name}}</h1>
                                </div>

                                <section class="rating-widget" style="direction: ltr">
                                    <!-- Rating Stars Box -->
                                    <div class='rating-stars text-center'>
                                        <ul id='stars'>
                                            <li class='star' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="d-flex mb-3 px-3">
                                <div id="priceBox"
                                     class="d-flex w-100 flex-wrap justify-content-between align-items-center">

                                    <span class="price-text"> قیمت برای شما : </span>

                                    {{--                                    <span--}}
                                    {{--                                            class="font-weight-bold text-{{$product->active['color']}} mr-2 "--}}
                                    {{--                                            style="font-size: 18px">{{$product->getOriginal('active') == 1 ? number_format($product->discount) . 'تومان' : 'ناموجود'}}</span>--}}

                                    <div class="d-flex flex-column"
                                         id="discountBox">
                                            <span class="text-danger "
                                                  style="font-weight: 700;font-size: 18px !important;text-decoration: line-through"
                                                  id="price">{{number_format($product->price)}}
                                            </span>
                                        @if(auth()->check() && auth()->user()->hasPlan($product->categories()->first()->id))
                                            <span class="text-success "
                                                  style="font-weight: 700;font-size: 18px !important;text-decoration: line-through"
                                                  id="price">{{number_format($product->discount)}}
                                            </span>

                                            <span class="font-weight-bold text-info" style="font-size: 18px"
                                                  id="oldPrice">{{number_format($product->discount - $product->commission())}}</span>
                                        @else
                                            <span class="font-weight-bold text-success" style="font-size: 18px"
                                                  id="oldPrice">{{number_format($product->discount)}}</span>
                                        @endif


{{--                                        @if(auth()->check() && auth()->user()->hasPlan($product->categories()->first()->id))--}}
{{--                                            <div class="bg-danger discount_percent text-center p-1 ">--}}

{{--                                                                                        <span class="text-white small">--}}
{{--                                                                            {{  'تخفیف ویژه : ' . number_format($product->commission()) . ' تومان'}}--}}
{{--                                                                        </span>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between ">
                                <div class="col-12">
                                    <p class="product_meta">تامین کننده: {{$product->user->nickname ?? ""}}</p>
                                </div>
                                <div class=" col-12 col-md-6 text-justify">
                                    <div class="product_meta">
                                        <span class="d-flex align-items-center">
                                  <i class="fa fa-barcode ml-2" style="font-size: 15px"></i>
                                    کد محصول:
                                       <a href="#">{{$product->code}}</a>
                                </span>
                                    </div>
                                    <div class="product_meta mt-3">

                                <span class="d-flex flex-wrap align-items-center">
                                  <i class="fa fa-tag ml-2"></i>
                                    برچسب:

                                    @foreach($product->tags as $tag)
                                        <a href="#"
                                           rel="tag" class="mt-2">{{$tag->name}}</a>
                                    @endforeach
                                </span>
                                    </div>
                                    <div class="product_meta mt-3">
                                 <span class="d-flex align-items-center">
                                  <i class="fa fa-weight ml-2"></i>
                                    وزن :(گرم)
                                         <a href=""
                                            rel="tag">{{$product->limit_weight}}</a>
                                </span>
                                    </div>
                                    <div class="product_meta mt-3">

                                <span class="d-flex align-items-center">
                                  <i class="fa fa-archive ml-2"></i>
                                    دسته:
                                       <a href="#"
                                          rel="tag">{{$product->categories()->first()->parent->name}}</a>
                                    <a href="#"
                                       rel="tag">{{$product->categories()->first()->name}}</a>
                                </span>
                                    </div>
                                    <div class="product_meta mt-3">
                                <span class="d-flex align-items-center">
                                  <i class="fa fa-archive ml-2"></i>
                                    ارسال:
                                      @if($product->sendDay == 1)
                                        <a href="#"
                                           rel="tag">آماده ارسال</a>
                                    @else
                                        <a href="#"
                                           rel="tag">از دو روز دیگر</a>
                                    @endif
                                </span>
                                    </div>


                                    <div class="product_meta mt-3">
                                <span class="d-flex align-items-center">
                                  <i class="fa fa-archive ml-2"></i>
                                    موجودی:

                                    @if($product->limit_count !=0)
                                        <a href="#"
                                           rel="tag">{{$product->limit_count}}</a>
                                    @else
                                        <a href="#"
                                           rel="tag">اتمام موجودی</a>
                                    @endif
                                </span>
                                    </div>
                                </div>

                                <form action="/user/cart" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="">
                                        @if($product->getOriginal('active') == 1)
                                            <button type="submit" class="my-5 d-flex align-items-center bg-warning btn h-100
                                     text-v-sm p-0 add_to_cart_btn"
                                                    style="border-radius: 30px;">
                                                <div class="text-center h-100 py-2 px-3 d-flex justify-content-center"
                                                     style="background-color:#ba8b00 !important;border-radius: 30px;">
                                                    <i class="fa fa-plus text-white mt-2"
                                                       style="font-size: .9em"></i>
                                                    <i class="fa fa-shopping-cart"
                                                       style="color: #fff;font-size: 25px"></i>
                                                </div>
                                                <div class="mx-2">
                                                    @if(auth()->check() && $product->limit_count > 0)
                                                        <a class="add_cart"><span
                                                                    class="text-white">افزودن کالا به سبد خرید</span>
                                                        </a>

                                                    @else
                                                        <a href="/register"><span
                                                                    class="text-white mx-4 font-weight-bold">ثبت نام و خرید</span></a>
                                                    @endif
                                                </div>
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-5">
                        <ul class="d-flex  flex-column flex-md-row flex-wrap p-0 m-0" style="list-style: none">
                            <li class="py-1 px-2 my-2 font-wight-bold">
                                ویژگی های محصول :
                            </li>
                            @foreach($product->properties as $property)
                                <li class="pt-2 my-2 small mr-3 ml-3">{{$property->title}} : <span
                                            class="bg-secondary text-white py-1 px-2"
                                            style="border-radius: 15px">{{$property->prop}}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    @if($product->categories()->first()->parent->slug == "خدمات-چاپی")
                        <h6>کاربر گرامی جهت ارسال طرح دلخواه خود میتوانید به شماره ۰۹۹۱۹۳۹۳۵۰۴ در واتس اپ ویا
                            id:nbpchap
                            در تلگرام مراجعه نمایید.</h6>
                        {{--                        <a href="t.me/nbpchap" target="_blank" class="btn btn-outline-success mt-3">تلگرام</a>--}}
                        {{--                        <a href="" target="_blank" class="btn btn-outline-warning mt-3">واتس آپ</a>--}}
                    @endif
                </div>
                <div class='col-md-8 mx-auto mt-5'>
                    <h5 class="text-dark mb-3">ثبت نظر</h5>
                    <form action="{{route('home.comments.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">

                        <textarea name="message" id="message" placeholder="متن نظر"
                                  class="form-control font-small">{{old('message')}}</textarea>
                        @if($errors->has('message'))
                            <span class="text-danger font-small">{{$errors->first('message')}}</span>
                        @endif

                        <div class="col-12">
                            <button class="btn btn-sm mt-2 font-small btn-success">ثبت نظر</button>
                        </div>


                    </form>
                </div>
                <div class="col-md-12 mt-4">
                    <h5 class="text-muted mb-3">توضیحات</h5>
                    <div class="bg-light p-4 white-space" style="text-align: justify">
                        {{$product->description}}
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center" style="margin-top: 100px">
            <span class="line"></span>
            <span class=" best_sellers text-center">محصولات مشابه</span>
            <span class="line"></span>
        </div>
        <div class="prev-shop">
            <div class="my-5 mx-auto text-center similar_product owl-carousel">
                @foreach($similar_products as $sproduct)
                    <a href="{{route('shopping.products.show',['productSlug'=>$sproduct->slug])}}"
                       class="border-shop d-flex flex-column align-items-center justify-content-center mx-auto">
                        <div class="position-relative">
                            <img class="hvr-grow" src="{{$sproduct->imagePath()}}" alt="">
                            <div class="hover-border hover-border d-flex align-items-center justify-content-center">
                                <p class="m-0">{{$sproduct->user->nickname ?? ""}}</p>
                            </div>
                        </div>
                        <p style="z-index: 999" class="text-dark">{{$sproduct->name}}</p>
                        <del class="m-0 text-black small">{{$sproduct->price}}</del>
                        <span class="text-{{$sproduct->active['color']}}  font-weight-bold"> {{$sproduct->getOriginal('active') == 1 ?  number_format($sproduct->discount) . 'تومان' : 'ناموجود'}}</span>
                        @if(auth()->check() && auth()->user()->hasPlan($product->categories()->first()->id))
                            {{--                            <span class="text-white small">--}}
                            {{--                                {{  'پورسانت : ' . number_format($product->commission()) . ' تومان'}}--}}
                            {{--                            </span>--}}
                        @endif                    </a>
                @endforeach
            </div>

            <div class="button-center bg-danger">
                <div class="product-section__nav-btn">
                    <button class="next fa fa-chevron-right bg-light" id="similar_product_next"></button>
                    <button class="prev fa fa-chevron-left bg-light" id="similar_product_prev"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade alert_cart" id="exampleModalCenter1" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content col-md-10 mr-0" style="border-radius: 12px">
                <div class="background-header-modal">
                    <div class="m-0 p-2 logo-modal row align-items-center justify-content-center">
                        <img src="{{asset('image/navLogo.png')}}" alt="nbpmarketing" width=160">
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="three col">
                            <div class="loader" id="loader-2">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/zoomsl.js')}}"></script>

    <script type="text/javascript">
        /* 2. Action to perform on click */
        $(document).ready(function () {

            let slideSingle = $('#myOwlSingle');
            slideSingle.owlCarousel({
                rtl: true,
                items: 6,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 2000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    },
                    1280: {
                        items: 5
                    },
                },
            });

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (let i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (let i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });
        });

        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

        $(".block__pic").imagezoomsl({
            zoomrange: [3, 3],
            magnifierpos: "left"
        });

        $('.selector ul li ').click(function () {
            $('.selector ul li').removeClass('selected');
            $(this).addClass('selected');
        });

        $('.selector').mousewheel(function (e, delta) {
            this.scrollLeft -= (delta * 100);
            e.preventDefault();
        });

        let qty = 1;
        $('#qty').val(qty);

        $('#minus').click(function (e) {
            if (qty > 1) {
                qty--;
                $('#qty').val(qty);
            }
        });

        $('#plus').click(function (e) {
            qty++;
            $('#qty').val(qty);
        });

        $(':radio').change(function () {
            // console.log('New star rating: ' + this.value);
        });

        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }


        // $('#show').ready(function () {
        //     $('h2').animate({fontSize: "60px"}, 500);
        // })
        // $('#show').ready(function () {
        //     $('h2').animate(
        //         {deg: "360"}, {
        //             duration: 500,
        //             step: function (now) {
        //                 $(this).css({
        //                     color: 'gold',
        //                     textShadow: 'black 2px 2px 2px'
        //                 });
        //             }
        //         }
        //     );
        // });

        "use strict";
        var myNav = {
            init: function () {
                this.cacheDOM();
                this.browserWidth();
                this.bindEvents();
            },
            cacheDOM: function () {
                this.navBars = $(".navBars");
                this.toggle = $("#toggle");
                this.navMenu = $("#menu");
            },
            browserWidth: function () {
                $(window).resize(this.bindEvents.bind(this));
            },
            bindEvents: function () {
                var width = window.innerWidth;

                if (width < 600) {
                    this.navBars.click(this.animate.bind(this));
                    this.navMenu.hide();
                    this.toggle[0].checked = false;
                } else {
                    this.resetNav();
                }
            },
            animate: function (e) {
                var checkbox = this.toggle[0];

                if (!checkbox.checked) {
                    this.navMenu.slideDown();
                } else {
                    this.navMenu.slideUp();
                }

            },
            resetNav: function () {
                this.navMenu.show();
            }
        };
        myNav.init();
    </script>
@endsection
