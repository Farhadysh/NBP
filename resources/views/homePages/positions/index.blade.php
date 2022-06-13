@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  pr-0 pr-md-5 pb-5">

        <div class="col-12 mx-auto py-4 ">
            <div class="wrapper">
                <div class="row text-center justify-content-center">
                    <div class="col-12">
                        <div class="counter"
                             data-cp-percentage="{{($position->leftCount ?? 0) + ($position->rightCount ?? 0) }} "
                             data-cp-color="#00bfeb">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="counter1" data-cp-percentage="{{$position->rightCount ?? 0}}"
                             data-cp-color="#EA4C89"></div>
                    </div>
                    <div class="col-6 ">
                        <div class="counter1" data-cp-percentage="{{$position->leftCount ?? 0}}"
                             data-cp-color="#FF675B"></div>
                    </div>
                </div>
            </div>
            <button class="btn-update d-none"></button>
        </div>

        <div class="col-12 mx-auto ">
            <div class="d-flex flex-wrap">
                <div class="col-12 owl-carousel positions py-4" data-id="{{$positions->count()}}">
                    @foreach($positions as $position)
                        <a href="?pos={{$position->id}}" class="text-white text-center border rounded-circle p-3 d-flex
                    justify-content-center align-items-center bg-warning" style="width: 100px;height: 100px">
                            <span>{{$position->name}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center  font-weight-bold text-success mt-5">
            <h4>کیف پول </h4>
        </div>
        <div class="col-md-12 padding-top-register">
            <div class="row mx-auto">
                <div class="container">
                    <table class="table table-striped shadow-sm bg-white table-bordered">
                        <thead>
                        <tr class="text-center ">
                            <th scope="col">مبلغ</th>
                            <th scope="col">تسویه حساب</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">{{number_format(auth()->user()->wallet)}}</td>
                            <td class="text-center">
                                @if(auth()->user()->wallet != 0)
                                    <form action="/user/checkouts" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-success">تسویه حساب</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(count(auth()->user()->positions) < 1)
            @if(auth()->user()->getScore()>=10)
                <div class="col-12 mt-3">
                    <form class="row" action="/user/positions/store" method="post">
                        @csrf
                        <div class="form-group col-8 col-md-4">
                            <label for="Consultant_code">کدمشاور</label>
                            <input type="text" name="Consultant_code" placeholder="کدمشاور" class="form-control"
                                   id="Consultant_code">
                            @error('Consultant_code')
                            <span class="invalid-feedback d-block">{{$message}}</span>
                            @enderror
                        </div>

                        <div style="margin-top: 35px">
                            <button class="btn btn-success btn-sm ">ثبت</button>
                        </div>
                    </form>
                </div>
            @endif
        @else
            <div class="col-12">
                <div class="row d-flex align-items-center">
                    <div class="w-100 text-center py-3 font-weight-bold text-success">
                        <h4 class="text-center">لیست جایگاهای من (امتیاز : {{auth()->user()->getScore()}})</h4>
                    </div>
                    <div class="col-md-12 padding-top-register">
                        <div class="row mx-auto">
                            <div class="container">
                                <table class="table table-responsive-md table-striped shadow-sm bg-white table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">نام</th>
                                        <th scope="col">مشاور</th>
                                        <th scope="col">کد</th>
                                        <th scope="col">کیف پول</th>
                                        <th scope="col">انتقال</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($positions as $position)
                                        <tr class="text-center">
                                            <td class="text-warning" scope="row">{{$position->name}}</td>
                                            <td class="text-warning">{{$position->parent->name ?? ""}}</td>
                                            <td>{{$position->visitor_code}}</td>
                                            <td>{{number_format($position->wallet)}}</td>
                                            <td>
                                                @if($position->wallet != 0 && $position->active)
                                                    <form action="/user/checkouts" method="post">
                                                        <input name="position_id" value="{{$position->id}}"
                                                               type="hidden"/>
                                                        @csrf
                                                        <button class="btn btn-sm btn-success">انتقال به کیف پول
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            @if(auth()->user()->canActive() && !$position->active)
                                                <td>
                                                    <a href="/user/positions/{{$position->id}}/active"
                                                       class="btn btn-sm btn-primary small">فعال کردن</a>
                                                </td>
                                            @else
                                                @if(!$position->active)
                                                    <td>-</td>
                                                @else
                                                    <td>
                                                        <span class="bg-success rounded px-3 small text-white">فعال</span>
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var circleProgress = (function (selector) {
                var wrapper = document.querySelectorAll(selector);
                Array.prototype.forEach.call(wrapper, function (wrapper, i) {
                    var wrapperWidth,
                        wrapperHeight,
                        percent,
                        innerHTML,
                        context,
                        lineWidth,
                        centerX,
                        centerY,
                        radius,
                        newPercent,
                        speed,
                        from,
                        to,
                        duration,
                        start,
                        strokeStyle,
                        text;

                    var getValues = function () {
                        wrapperWidth = parseInt(window.getComputedStyle(wrapper).width);
                        wrapperHeight = wrapperWidth;
                        percent = wrapper.getAttribute('data-cp-percentage');
                        innerHTML = '<span class="percentage"><strong>' + percent + '</strong></span><canvas class="circleProgressCanvas" width="' + (wrapperWidth * 2) + '" height="' + wrapperHeight * 2 + '"></canvas>';
                        wrapper.innerHTML = innerHTML;
                        text = wrapper.querySelector(".percentage");
                        canvas = wrapper.querySelector(".circleProgressCanvas");
                        wrapper.style.height = canvas.style.width = canvas.style.height = wrapperWidth + "px";
                        context = canvas.getContext('2d');
                        centerX = canvas.width / 2;
                        centerY = canvas.height / 2;
                        newPercent = 0;
                        speed = 1;
                        from = 0;
                        to = percent;
                        duration = 3000;
                        lineWidth = 25;
                        radius = canvas.width / 2 - lineWidth;
                        strokeStyle = wrapper.getAttribute('data-cp-color');
                        start = new Date().getTime();
                    };

                    function animate() {
                        requestAnimationFrame(animate);
                        var time = new Date().getTime() - start;
                        if (time <= duration) {
                            var x = easeInOutQuart(time, from, to - from, duration);
                            newPercent = x;
                            text.innerHTML = Math.round(newPercent);
                            drawArc();
                        }
                    }

                    function drawArc() {
                        var circleStart = 1.5 * Math.PI;
                        var circleEnd = circleStart + (newPercent / 2000) * Math.PI;
                        context.clearRect(0, 0, canvas.width, canvas.height);
                        context.beginPath();
                        context.arc(centerX, centerY, radius, circleStart, 4 * Math.PI, false);
                        context.lineWidth = lineWidth;
                        context.strokeStyle = "#ddd";
                        context.stroke();
                        context.beginPath();
                        context.arc(centerX, centerY, radius, circleStart, circleEnd, false);
                        context.lineWidth = lineWidth;
                        context.strokeStyle = strokeStyle;
                        context.stroke();

                    }

                    var update = function () {
                        getValues();
                        animate();
                    }
                    update();

                    var btnUpdate = document.querySelectorAll(".btn-update")[0];
                    btnUpdate.addEventListener("click", function () {
                        wrapper.setAttribute("data-cp-percentage", Math.round(getRandom(5, 95)));
                        update();
                    });
                    wrapper.addEventListener("click", function () {
                        update();
                    });

                    var resizeTimer;
                    window.addEventListener("resize", function () {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(function () {
                            clearTimeout(resizeTimer);
                            start = new Date().getTime();
                            update();
                        }, 250);
                    });
                });

                //
                // http://easings.net/#easeInOutQuart
                //  t: current time
                //  b: beginning value
                //  c: change in value
                //  d: duration
                //
                function easeInOutQuart(t, b, c, d) {
                    if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
                    return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
                }
            });

            circleProgress('.counter');
            circleProgress('.counter1');

            // Gibt eine Zufallszahl zwischen min (inklusive) und max (exklusive) zurück
            function getRandom(min, max) {
                return Math.random() * (max - min) + min;
            }
        });

        let posCount = $('.owl-carousel.positions').attr('data-id');

        $(".owl-carousel.positions").owlCarousel({
            center: true,
            rtl: true,
            dots: false,
            margin: 5,
            loop: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: posCount > 4 ? 3 : posCount
                },
                1000: {
                    items: posCount > 3 ? 2 : posCount
                },
                1280: {
                    items: posCount > 5 ? 5 : posCount
                },
            },
        });
    </script>
@endsection