@extends('homePages.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/style-r.css')}}">
@endsection

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-5 pr-0 pr-md-5">
        <div class="d-flex align-items-center justify-content-center">
            <span class="line"></span>
            <span class="mx-2 best_sellers">بخش آموزش</span>
            <span class="line"></span>
        </div>
        <section id="cd-timeline" class="cd-container">
            <div class="cd-timeline-block ">
                <div class="cd-timeline-img cd-picture">
                    <img src="{{asset('image/check-mark.png')}}" alt="Picture">
                </div>
                <div class="cd-timeline-content">
                    <h2>بخش اول</h2>
                    <img width="100%" src="{{asset('image/visitPackage.png')}}" alt="پکیج های ویزیتور">
                    <p>
                        متنی آزمایشی و بی‌معنی در صنعت چاپ،
                        صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای
                        پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر
                        گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی،
                        نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که
                        استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را
                        به پایان برند.</p>
                    <audio class=" w-100  " src="assets/mp3/Shahin%20Banan.mp3" type="audio/mpeg"
                           controls preload="auto">
                    </audio>
                </div>
            </div>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture">
                    <img src="{{asset('image/check-mark.png')}}" alt="Picture">
                </div>
                <div class="cd-timeline-content">
                    <h2>بخش 2</h2>
                    <img width="100%" src="{{asset('image/smsPackage.png')}}">
                    <p>
                        متنی آزمایشی و بی‌معنی در صنعت چاپ،
                        صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای
                        پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر
                        گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی،
                        نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که
                        استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را
                        به پایان برند.</p>
                    <audio class=" w-100  " src="assets/mp3/Shahin%20Banan.mp3" type="audio/mpeg"
                           controls preload="auto">
                    </audio>
                </div>
            </div>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-movie">
                    <img src="{{asset('image/check-mark.png')}}" alt="Picture">
                </div>
                <div class="cd-timeline-content">
                    <h2>بخش 3</h2>
                    <img width="100%" src="{{asset('image/academy.png')}}">

                    <p>
                        متنی آزمایشی و بی‌معنی در صنعت چاپ،
                        صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای
                        پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر
                        گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی،
                        نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که
                        استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را
                        به پایان برند.</p>
                    <audio class=" w-100 " src="assets/mp3/Shahin%20Banan.mp3" type="audio/mpeg"
                           controls preload="auto">
                    </audio>
                </div>
            </div>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-movie">
                    <img src="{{asset('image/check-mark.png')}}" alt="Picture">
                </div>
                <div class="cd-timeline-content">
                    <h2>بخش 4</h2>
                    <p>
                        متنی آزمایشی و بی‌معنی در صنعت چاپ،
                        صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای
                        پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر
                        گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی،
                        نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که
                        استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را
                        به پایان برند.</p>
                    <audio class=" w-100  " src="assets/mp3/Shahin%20Banan.mp3" type="audio/mpeg"
                           controls preload="auto">
                    </audio>
                </div>

            </div>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-location">
                    <img src="{{asset('image/check-mark.png')}}" alt="Picture">
                </div>
                <div class="cd-timeline-content">
                    <h2>رزومه 6</h2>
                    <p>
                        متنی آزمایشی و بی‌معنی در صنعت چاپ،
                        صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای
                        پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر
                        گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی،
                        نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که
                        استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را
                        به پایان برند.</p>
                    <audio id="a" class=" w-100  " src="assets/mp3/Shahin%20Banan.mp3"
                           type="audio/mpeg"
                           controls preload="auto">
                    </audio>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
@endsection