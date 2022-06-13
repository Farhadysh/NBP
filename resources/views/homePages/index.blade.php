@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5">
        <div class="d-flex justify-content-between align-items-center  p-3 border-bottom">
            <p class="text-sing-in"> {{auth()->user()->fullName}} خوش آمدید.</p>
        </div>

        <div class="col-12  py-3">
            <div class="row flex-wrap-reverse">
                <div class="col-12 col-md-6 py-4">
                    <h4 class="font-weight-bold ">میزان کل در آمد : </h4>
                    <div class="row py-5 py-md-0">
                        <div class="col-12 col-xl-6 col-lg-12 p-2">
                            <div class="card card-common">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="shop">
                                            <img src="{{asset('image/creditor.png')}}" alt="">
                                        </div>
                                        <div class="text-left text-secondary">
                                            <h6 class="text-card">کیف پول </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-card">
                                    <div class="d-flex justify-content-between">
                                        <h6> تومان</h6>
                                        <h4>{{number_format($store)}}</h4>
                                    </div>
                                    <div class="col-12 text-center p-0 mt-2">
                                        <form action="/user/checkouts" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-success px-3">تسویه</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex py-4  justify-content-center justify-content-md-end ">
                    <h1 class="font-weight-bold text-red hide-circle wow animated ">مشاور</h1>
                    <div class="number">
                        <div class="value text-center">{{$total}}</div>
                        <canvas id="canvas" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let times = 0;
        var valEl = $('.value');
        let num = valEl.text();
        console.log(num);
        if (num == 0) {
            $('.hide-circle').addClass('wobble');
            load = 0
        } else if (num <= 100000) {
            $('.hide-circle').addClass('tada');
            times = 3000;
            load = 0.2
        } else if (num <= 500000) {
            $('.hide-circle').addClass('zoomIn');
            times = 4000;
            load = 0.4

        } else if (num <= 1000000) {
            $('.hide-circle').addClass('heartBeat');
            times = 5000;
            load = 0.6

        } else if (num <= 10000000) {
            $('.hide-circle').addClass('wobble');

            times = 6000;
            load = 0.7

        } else if (num <= 100000000) {
            $('.hide-circle').addClass('jello');

            times = 7000;
            load = 0.8

        } else {
            $('.hide-circle').addClass('rotateIn');

            times = 8000;
            load = 1

        }
        var options = {
            value: load,
            size: 220,
            startAngle: -Math.PI,
            startColor: '#ED1B23',
            endColor: '#07f',
            animation: {
                duration: times,
                easing: 'circleProgressEase'
            }
        };

        $.easing.circleProgressEase = function (x, t, b, c, d) {
            if ((t /= d / 2) < 1)
                return c / 2 * t * t * t + b;
            return c / 2 * ((t -= 2) * t * t + 2) + b;
        };

        var s = options.size,  // square size
            v = options.value, // current value: from 0.0 to 1.0
            r = s / 2,         // radius
            t = s / 10;        // thickness

        // Prepare canvas
        var canvas = $('#canvas')[0];

        canvas.width = s;
        canvas.height = s;
        var ctx = canvas.getContext('2d');
        var lg = ctx.createLinearGradient(0, 0, s, 0);
        lg.addColorStop(0, options.startColor);
        lg.addColorStop(1, options.endColor);
        ctx.fillStyle = "rgba(0, 0, 0, .1)";

        // Draw circle
        if (options.animation)
            _drawAnimated(v);
        else
            _draw(v);

        // $('.number').click(function () {
        //     if (options.animation)
        //         _drawAnimated(v);
        //     else
        //         _draw(v);
        // });

        function _draw(p) {
            // Clear frame
            ctx.clearRect(0, 0, s, s);

            // Draw background circle
            ctx.beginPath();
            ctx.arc(r, r, r, -Math.PI, Math.PI);
            ctx.arc(r, r, r - t, Math.PI, -Math.PI, true);
            ctx.closePath();
            ctx.fill(); // gray fill

            // Draw progress arc
            ctx.beginPath();
            ctx.arc(r, r, r, -Math.PI, -Math.PI + Math.PI * 2 * p);
            ctx.arc(r, r, r - t, -Math.PI + Math.PI * 2 * p, -Math.PI, true);
            ctx.closePath();
            ctx.save();
            ctx.clip();
            ctx.fillStyle = lg;
            ctx.fillRect(0, 0, s, s); // gradient fill
            ctx.restore();
        }

        function _drawAnimated(v) {
            $(canvas).stop(true, true).css({value: 0}).animate({value: v}, $.extend({}, options.animation, {
                step: function (p) {
                    _draw(p);
                    $(canvas).trigger('circle-animation-progress', [p / v, p]);
                },

                complete: function () {
                    $('.hide-circle').show();
                    $(canvas).trigger('circle-animation-end');
                }
            }));
        }

        $('.hide-circle').hide();
        // now let's animate numbers
        var valEl = $('.value');
        valEl.data('origVal', valEl.text());
        $(canvas).on('circle-animation-progress', function (e, progress) {
            valEl.text(parseInt(valEl.data('origVal') * progress))
        });
    </script>
@endsection
