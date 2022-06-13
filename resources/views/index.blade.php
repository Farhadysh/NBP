@extends('master')

@section('content')
    <div class="image-header " id="home">
        <div class="cover">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="col-12 row text-head text-center pt-5">
                    <div class="col-12  col-md-12 col-lg-6  text-center image-header-size">
                        <img src="{{asset('image/logo.png')}}" class="rotate" width="350"/>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 d-flex flex-column align-items-center justify-content-center text-center position-relative">
                        <h1 class="text-light text-header-size"><span class="text-danger"> N </span> B <span
                                    class="text-danger"> P </span>
                        </h1>
                        <div class="typed_wrap">
                            <span class="typed"></span>
                        </div>
                        <div class="mt-5 pt-0 pt-lg-5">
                            <p class="text-light text-justify abut-text-size">
                                شرکتnbp اولین و نخستین مرکزشغل در زمینه ی بازاریابی و فروش می باشد که در دو حوزه ی فروش
                                محصولات و خدمات ، خدمات رسانی می کند.
                            </p>
                            <p class="text-light text-justify abut-text-size">
                                Nbp با هدف اشتغال زایی وتغییر سبک زندگی مردم با تحلیل شرکت های مختلف بازاریابی و برطرف
                                کردن
                                اصول نادرست و به کارگیری روش های مدرن ، سالم ترین وپرسود ترین شرکت در این زمینه در ایران
                                می
                                باشد.
                            </p>
                        </div>
                        @if(!Auth::check())
                            <div class="btn-head d-flex ">
                                <a class="btn btn-outline-danger mx-2" href="/register">ثبت نام</a>
                                <a class="btn btn-danger mx-2 " href="/customer_register">ثبت نام تامین کننده</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="wrapper">
            <div class="row justify-content-center justify-content-sm-between align-items-center mx-auto text-center">
                <div class=" progres step  d-flex flex-column align-items-center justify-content-center p-1 m-1 m-sm-0">
                    ریفرال مارکتینگ
                </div>
                <div class=" progres step  d-flex flex-column align-items-center justify-content-center  p-1 m-1 m-sm-0">
                    دیجیتال مارکتینگ
                </div>
                <div class=" progres step  d-flex flex-column align-items-center justify-content-center  p-1 m-1 m-sm-0">
                    فروش مستقیم
                </div>
                <div class=" progres step  d-flex flex-column align-items-center justify-content-center  p-1 m-1 m-sm-0">
                    فروش تلفنی
                </div>
                <div class=" progres step  d-flex flex-column align-items-center justify-content-center  p-1 m-1 m-sm-0">
                    پورسانت آنی
                </div>
                <div class=" progres step d-flex flex-column align-items-center justify-content-center  p-1 m-1 m-sm-0">
                    آکادمی
                </div>
            </div>

            <div class="progress-bar"></div>
            <div class="progress-complited"></div>
            <div class="tabs">
                <div href="#progres-1" class="tab panel-1">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3> رفرال مارکتینگ</h3>
                        <p class="text-dark pt-3">
                            رفرال مارکتینگ نوعی تبلیغات کلامی می باشد. که مشتریان ، یک بیزینس را به افراد دیگری معرفی می
                            کنند. که طبق تحقیقات انجام شده توسط محققان افرادی که از طریق دوستان و آشنایان با یک بیزینس
                            جدید آشنا می شوند 4برابر بیشتر نسبت به افرادی که از طریق تبلیغات سنتی با همان بیزینس آشنا
                            گردیده اند از آن استقبال می کنند .
                        </p>
                    </div>
                </div>
                <div href="#progres-2" class="tab panel-2">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3>دیجیتال مارکتینگ</h3>
                        <p class="text-dark pt-3">
                            بازاریابی دیجیتال شامل مجموعه همۀ ابزارها و فعالیت هایی است که برای بازاریابی محصولات و
                            خدمات در بستر دیجیتال (وب ، اپ ، اینترنت ، موبایل یا سایر ابزارهای دیجیتال) مورد استفاده
                            قرار می گیرند.
                        </p>
                    </div>
                </div>
                <div href="#progres-3" class="tab panel-3">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3>فروش مستقیم </h3>
                        <p class="text-dark pt-3">
                            عبارت است از اقدام به بازاریابی وفروش مستقیم محصول و خدمت به مشتری در منزل ، محل کار یا سایر
                            مکان ها در تعریف دقیق تر در این سیستم برای توزیع محصولات نیازی به حضور واسطه های متعددی شامل
                            مراکز توزیع منطقه ای یا عمده فروش ، خرده فروش ، و مغازه دار نیست ، در عوض محصول مستقیما از
                            محل تولید ، به وسیله شرکت برای نمایندگان فروش و مشتریان ارسال می گردد.
                        </p>
                    </div>
                </div>
                <div href="#progres-4" class="tab panel-4">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3>فروش تلفنی </h3>
                        <p class="text-dark pt-3">
                            یکی از شیوه های فروش مستقیم است که در آن با مشتریان بالقوه یا کسانی که ممکن است مشتری بالقوه
                            باشند تماس گرفته می شود و از طریق تماس تلفنی تلاش می شود که آنها را به خرید و استفاده از
                            محصولات و خدمات شرکت ترغیب کنند.
                        </p>
                    </div>
                </div>
                <div href="#progres-5" class="tab panel-5">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3>پورسانت آنی </h3>
                        <p class="text-dark pt-3">
                            شما می توانید در NBPاز فروش محصولات و خدمات بین 15 الی 100 درصد از قیمت محصولات و یا خدمات
                            را به صورت آنی پورسانت دریافت کنید.
                        </p>
                    </div>
                </div>
                <div href="#progres-6" class="tab panel-6">
                    <div class="opis py-1 py-md-3 py-lg-5">
                        <h3>آکادمی</h3>
                        <p class="text-dark pt-3">
                            NBP به منظور رشد روز افزون بازاریابان خود اقدام به تاسیس یک آکادمی کرده است که در آن با
                            استفاده از اساتید مجرب و حرفه ای در زمینۀ بازاریابی و فروش قصد دارد شمارا از مبتدی تا حرفه
                            ای با دنیای مدرن فروش آشنا کند.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 px-5">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-6 abut-us">
                <h3 class="pb-1">درباره نوآوری بسبک پی <span class="text-red">(NBP)</span></h3>
                <p class="m-0 py-2 text-size text-secondary">
                    <span class="fa fa-check text-red ml-3"></span>
                    Nbp یک مرکز شغل در زمینه بازاریابی و فروش می باشد که در دو حوزۀ فروش محصولات و خدمات فعالیت می کند .
                </p>
                <p class="m-0 text-size py-2 text-secondary">
                    <span class="fa fa-check text-red ml-3"></span>
                    Nbp با هدف اشتغال زایی موثر اقدام به حذف واسطه های محصولات نموده است و محصول را مستقیم از تولید
                    کننده به کاربران خود می رساند.
                </p>

                <p class="m-0 text-size py-2 text-secondary">
                    <span class="fa fa-check text-red ml-3"></span>
                    شما می توانید با استفاده از خدمات نوین nbp یک کارشناس حرفه ای در زمینه تبلیغات شوید.
                </p>
                <p class="m-0 text-size py-2 text-secondary">
                    <span class="fa fa-check text-red ml-3"></span>
                    Nbp با هدف اشتغال زایی و رفع بیکاری تا به اینجا در بیش از 20 حوزۀ کاری فعالیت دارد.
                </p>
                <p class="m-0 text-size py-2 text-secondary">
                    <span class="fa fa-check text-red ml-3"></span>
                    Nbp یکی از مدرن ترین و بروزترین فروشگاه های حال حاضر ایران می باشد.
                </p>

                <div class=" my-4 text-center">
                    <a href="/about" class="btn btn-danger bg-red">درباره ما</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 text-center mb-4">
                <img class="position-relative" src="{{asset('image/mac-laptop-png.png')}}" width="100%" alt="">
                <video id="my-video" class="video-js" controls preload="auto" poster="{{asset('image/logo.png')}}"
                       data-setup='' loop>
                    <source src="{{asset('upload/video/nbp.mp4')}}"
                            type='video/mp4'>
                </video>
            </div>
        </div>
    </div>
    <div class="image-fix">
        <div class="cover1 d-flex align-items-center justify-content-center">
            <div class="col-12 p-3">
                <div class="abut-us">
                    <h3 class="text-light text-center ">Nbp اولین مرکز شغل در ایران </h3>
                    <p class="pt-3 text-light text-size text-justify text-center">
                        Nbp
                        شما را با دنیایی از مشاغل مختلف آشنا می‌کند که شما به راحتی با استفاده از تلفن همراه خود
                        می‌توانید کسب درآمد کنید
                    </p>
                    <div class="text-center my-4">
                        <a href="/register" class="btn btn-danger bg-red">ثبت نام </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row px-4 align-items-center">
            <div class="col-12 mx-auto text-center py-3 abut-us">
                <h3 class="pt-3">فروشگاه های nbp</h3>
                <p class="text-size text-justify text-center">
                    nbp یکی از بروز ترین و بزرگترین مراکز خرید در ایران می باشد که شما با وجود 3 فروشگاه قدرت انتخاب
                    خرید محصولات را دارید .
                </p>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column align-items-center align-items-md-start justify-content-between ">
{{--                <a href="/shop/categories/فروشگاه-آشام"--}}
{{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
{{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
{{--                        <img src="{{asset('/image/ghazayi-icon1.png')}}" width="50" alt="سبد آشام">--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">--}}
{{--                        <h5>فروشگاه آشام </h5>--}}
{{--                        <p class="text-center shop-text">--}}
{{--                            عرضه انواع محصولات روزمره با تنوع بالا و پایین ترین قیمت--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </a>--}}
                <a href="/shop/categories/فروشگاه-ساتیا"
                   class="d-flex flex-column flex-md-row  align-items-center item-shop my-3">
                    <div class="shadow-sm icon-shop  border-radius p-3">
                        <img src="{{asset('/image/arayeshi-icon2.png')}}" width="50" alt="سبد ساتیا">
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">
                        <h5>فروشگاه ساتیا</h5>
                        <p class="text-center shop-text">
                            عرضه انواع محصولات مراقبتی پوست و مو با بالاترین کیفیت
                        </p>
                    </div>
                </a>
                {{--                <a href="/shop/categories/دستمال-کاغذی"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/behdashti-icon3.png')}}" width="50" alt="سبد بهداشتی">--}}
                {{--                    </div>--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">--}}
                {{--                        <h5>فروشگاه بهداشتی</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه انواع محصولات سلولزی و آنتی باکتریال--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <a href="/shop/categories/چوب-و-رزین"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/tazyinat-icon4.png')}}" width="50" alt="سبد تزئینات">--}}
                {{--                    </div>--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">--}}
                {{--                        <h5>فروشگاه تزیینات</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه شیک ترین و بروز ترین محصولات تزییناتی--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <a href="/shop/categories/سبد-منسوجات"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/mansijat-icon5.png')}}" width="50" alt="سبد منسوجات">--}}
                {{--                    </div>--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">--}}
                {{--                        <h5>فروشگاه منسوجات</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            بروزترین لباس های مردانه و زنانه با بهترین کیفیت--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <a href="/shop/categories/سبد-عمده"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/omde-icon6.png')}}" width="50" alt="سبد عمده">--}}
                {{--                    </div>--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center mr-3">--}}
                {{--                        <h5>فروشگاه عمده</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            فروش محصولات به صورت کلی--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                </a>--}}
            </div>
            <div class="col-12 col-md-4 text-center">
                <img class="object text-center" src="{{asset('image/shop.png')}}" width="100%" alt="">
            </div>
            <div class="col-12 col-md-4 d-flex flex-column align-items-center align-items-md-end justify-content-around ">
{{--                <a href="/shop/categories/فروشگاه-سانا"--}}
{{--                   class="d-flex flex-column flex-md-row align-items-center item-shop">--}}
{{--                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">--}}
{{--                        <h5>فروشگاه سانا </h5>--}}
{{--                        <p class="text-center shop-text">--}}
{{--                            عرضه مستقیم بهترین و با کیفیت ترین لوازم خانگی روز ایران وجهان--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
{{--                        <img src="{{asset('/image/khanegi-icon-7.png')}}" width="50" alt="سبد سانا">--}}
{{--                    </div>--}}
{{--                </a>--}}
                {{--                <a href="/shop/categories/سبد-لوازم-خودرو"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">--}}
                {{--                        <h5>فروشگاه لوازم خودرو</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه مستقیم تمام محصولات خودرو با نازلترین قیمت--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/khodro-icon-8.png')}}" width="50" alt="سبد لوازم خودرو">--}}
                {{--                    </div>--}}
                {{--                </a>--}}

                <a href="/shop/categories/فروشگاه-سوما"
                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">

                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">
                        <h5>فروشگاه سوما</h5>
                        <p class="text-center shop-text">
                            عرضه انواع محصولات سلولزی و آنتی باکتریال
                        </p>
                    </div>
                    <div class="shadow-sm icon-shop  border-radius p-3">
                        <img src="{{asset('/image/behdashti-icon3.png')}}" width="50" alt="سبد سوما">
                    </div>
                </a>
                <a href="/shop/categories/فروشگاه-کاراکو"
                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">
                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">
                        <h5>فروشگاه کاراکو</h5>
                        <p class="text-center shop-text">
                            عرضه مستقیم لوازم جانبی موبایل ،کامپیوتر و لوازم الکتریکی
                        </p>
                    </div>
                    <div class="shadow-sm icon-shop  border-radius p-3">
                        <img src="{{asset('/image/electronic-icon-9.png')}}" width="50" alt="سبد کاراکو">
                    </div>
                </a>
                {{--                <a href="/shop/categories/پاکت-هدیه-و-ساک-خرید"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">--}}
                {{--                        <h5>فروشگاه فرهنگی</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه انواع لوازم و تحریر، کتاب وبازی و سرگرمی--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/farhangi-icon-10.png')}}" width="50" alt="سبد فرهنگی">--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <a href="/shop/categories/سبد-لاکچری"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">--}}
                {{--                        <h5>فروشگاه لاکچری</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه انواع برندهای معتبر با کیفیت درجه یک--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/lakcheri-icon-11.png')}}" width="50" alt="سبد لاکچری">--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <a href="/shop/categories/سبد-خدماتی"--}}
                {{--                   class="d-flex flex-column flex-md-row align-items-center item-shop my-3">--}}
                {{--                    <div class="d-flex flex-column justify-content-center align-items-center ml-3">--}}
                {{--                        <h5>فروشگاه خدماتی</h5>--}}
                {{--                        <p class="text-center shop-text">--}}
                {{--                            عرضه انواع ابزار آلات صنعتی--}}
                {{--                        </p>--}}
                {{--                    </div>--}}
                {{--                    <div class="shadow-sm icon-shop  border-radius p-3">--}}
                {{--                        <img src="{{asset('/image/khadamati-icon-12.png')}}" width="50" alt="سبد خدماتی">--}}
                {{--                    </div>--}}
                {{--                </a>--}}
            </div>
        </div>
    </div>
    <div class="image-fix1">
        <div class="cover1 p-3 d-flex align-items-center justify-content-center">
            <div class="abut-us">
                <h3 class="text-light text-center ">هایپر NBP فروشگاه بی واسطه؟</h3>
                <p class="pt-3 text-light text-size text-justify text-center">
                    Nbp با حذف واسطه ها و دریافت محصولات از تولید کنندگان و یا نمایندگان رسمی شرکت ها موفق به افزودن
                    محصولاتی با کیفیت و با قیمت های بی نظیر در فروشگاه های خود گردیده است .
                </p>
                <div class="text-center my-4">
                    <a href="/shop" class="btn btn-danger bg-red">فروشگاه</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 ">
        <div class="row my-4">
            <div class="col-12 abut-us col-sm-6 col-md-4 mx-auto bg-blue d-flex flex-column  align-items-center p-0  p-sm-2 p-md-5">
                <a href="#" class="position-relative ">
                    <img src="{{asset('image/sms.jpg')}}" width="100%" alt="">
                </a>
                <h5 class="mt-5">سامانه آکام (پنل پیامکی انبوه)</h5>
                <p class="text-size text-justify p-2 ">
                    کاربرد اساسی سامانه پیامکی شرکت بسیار ساده است: ارسال،دریافت و مدیریت ارسال های انبوه به راحت ترین
                    شکل ممکن اما وقتی در این کاربرد دقیق تر می شویم با بیش از 30 ویژگی متنوع برای اسال پیامک روبرو
                    خواهیم شد، امکاناتی که هر کدام می توانند نقش مهمی در رشد کسب و کار شما داشته باشند.
                </p>
                <div class="text-center mt-auto">
                    <a href="http://nbpsms.ir/" target="_blank" class="btn btn-danger bg-red">
                        ورود به سامانه پیامکی
                    </a>
                </div>
            </div>
            <div class="my-5 my-md-0 col-12 px-0 abut-us col-sm-6 col-md-4 mx-auto bg-dark-blue d-flex flex-column  align-items-center p-0 p-sm-2 p-md-5">
                <a href="#" class="position-relative ">
                    <img src="{{asset('image/cartVisit.jpg')}}" width="100%" alt="">
                </a>
                <h5 class="mt-5">سامانه نادین (CRM)</h5>
                <p class="text-size  text-justify p-2 ">
                    کارت ویزیت الکترونیک یک کد اختصاصی تحت مدیریت شما می باشد که شما به واسطه داشتن این کد می توانید
                    ارتباط مؤثری با مشتریان خود داشته باشید و این ارتباط را برای همیشه حفظ کنید.
                </p>
                <div class="text-center mt-auto">
                    <a href="http://nbpkart.ir/" target="_blank" class="btn btn-danger bg-red">ورود به سامانه کارت
                        ویزیت</a>
                </div>
            </div>
            <div class="col-12 px-0 abut-us col-sm-6 col-md-4 mx-auto bg-green d-flex flex-column  align-items-center p-0 p-sm-2 p-md-5">
                <a href="#" class="position-relative ">
                    <img src="{{asset('image/chap.jpg')}}" width="100%" alt="">
                </a>
                <h4 class="mt-5">پلتفرم نارون</h4>
                <p class="text-size  text-justify p-2">
                    یکی از سرویس های nbp چاپخانه آنلاین است که در آن خدماتی نظیر کارت ویزیت ، تراکت ، سررسید ، تقویم ،
                    لیبل ، سربرگ و ... با راحتترین شکل ممکن و هزینه های باور نکردنی ، در اختیار شما قرار می گیرد.
                </p>
                <div class="text-center mt-auto">
                    <a href="/shop/categories/پلتفرم-نارون" class="btn btn-danger bg-red">ورود به
                        چاپخانه</a>
                </div>
            </div>
        </div>
    </div>
    <div class="image-fix3">
        <div class="cover1 d-flex align-items-center justify-content-center p-3">
            <div class="col-12 abut-us">
                <h3 class="text-light text-center">خدمات (NBP)</h3>
                <p class="pt-3 text-light text-size text-center">
                    Nbp با داشتن سرویس های متنوع و کارآمد در بستر وب سعی در کاهش هزینه های جاری هر خانوار و هدفمند کردن
                    تبلیغات کسب و کارها را دارد.
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 px-3 px-md-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 abut-us">
                <h3 class="pt-4">اپلیکیشن <span class="text-red">(NBP)</span></h3>
                <p class="m-0 py-2 text-size text-secondary" style="">
                    <span class="fa fa-check text-red ml-3"></span>تصور فردی که دوست ندارد آنلاین خرید کند دشوار است. در
                    دنیای سریع ما، شانس صرفه جویی در وقت بسیار مهم
                    است. به طوری که بیشتر مردم ترجیح می دهند از اپلیکیشن فروشگاهی برای خرید استفاده کنند تا در مسیرهای
                    طولانی رانندگی کنند و یا از طریق مترو یا اتوبوس خود را به بازار ها برسانند و به این ترتیب از هزینه
                    اضافی جلوگیری کنند.
                    طبق آمار، دو نفر از سه مشتری از موبایل خود زمانی که به خرید می روند، استفاده می کنند. آنها از لیست
                    های مختلف خرید، اپلیکیشن های با کوپن های تخفیف و اپلیکیشن های بررسی و مقایسه محصولات استفاده می
                    کنند. تنوع این اپلیکیشن ها شگفت انگیز است و میلیاردها کاربر در سراسر جهان از مزایای چنین خدماتی بهره
                    میبرند.
                    بازار اپلیکیشن های خرید آنلاین به سرعت در حال رشد است و نسبت به سال قبل دو برابر شده است. از یک طرف،
                    این نشان از تقاضای بالا است

                </p>

                <div class=" my-4 text-center">
                    <a href="#" class="btn btn-danger bg-red">به زودی</a>
                </div>
            </div>
            <div class="col-12 col-md-6 text-center text-md-left">
                <img class="object" src="{{asset('image/app.png')}}" width="70%" alt="">
            </div>
        </div>
    </div>
    <div class="image-fix2">
        <div class="cover1 p-3 d-flex align-items-center justify-content-center">
            <div class="col-12 abut-us">
                <h3 class="text-light text-center">خدمات (NBP)</h3>
                <p class="pt-3 text-light text-size text-center">
                    شما می توانید با استفاده از خدمات نوین nbp یک کارشناس تبلیغات شوید
                </p>
            </div>
        </div>
    </div>
{{--    <div class="col-12 ">--}}
{{--        <div class="row my-4">--}}
{{--            <div class="col-12 abut-us col-sm-6 col-md-4 mx-auto bg-dark-blue d-flex flex-column  align-items-center p-0 p-sm-2 p-md-5">--}}
{{--                <a href="#" class="position-relative ">--}}
{{--                    <img src="{{asset('image/book.png')}}" width="100%" alt="">--}}
{{--                </a>--}}
{{--                <h5 class="mt-5">کتابخانه مجازی</h5>--}}
{{--                <p class="text-size p-2">--}}
{{--                    کتابخانه مجازی کتابخانه ای است که در آن کتاب ها بجای کاغذ به صورت الکترونیک ذخیره شده اند و محتوای--}}
{{--                    الکترونیکی این کتابخانه به گونه ای می باشد که هر فردی در هر نقطه و در هر زمانی با استفاده از اینترنت--}}
{{--                    بتواند دسترسی داشته باشد. به واسطه ی کتابخانه مجازی دیگر افراد نیازی به رفتن به یک مکان خاصی ندارند--}}
{{--                    و فرد می تواند در هر لحظه و در هر مکانی وارد یک کتابخانه بزرگ شود.--}}
{{--                </p>--}}
{{--                <div class="text-center mt-auto">--}}
{{--                    <a href="/digitalMarketing/digital-market/library" class="btn btn-danger bg-red">ورود به کتابخانه--}}
{{--                        مجازی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="my-5 my-md-0 col-12 abut-us col-sm-6 col-md-4 mx-auto bg-dark-blue d-flex flex-column  align-items-center  p-0 p-sm-2 p-md-5">--}}
{{--                <a href="#" class="position-relative ">--}}
{{--                    <img src="{{asset('image/discount.jpg')}}" width="100%" alt="">--}}
{{--                </a>--}}
{{--                <h5 class="mt-5">تخفیفات</h5>--}}
{{--                <p class="text-size  p-2">--}}
{{--                    در سال های اخیر رقابت بر سر جذب و حفظ مشتریان در تمامی کسب و کارها به شدت دیده می شود.هم صاحبان--}}
{{--                    مشاغل بدنبال جذب مشتری بیشتر هستند و هم مشتریان با وسواس بیشتر به دنبال بهترین خدمات می باشند.--}}
{{--                    ما در شرکت nbp به دنبال این هستیم که به واسطه ی طرحی نوین هم در هزینه های افراد صرفه جویی کنیم و هم--}}
{{--                    باعث رونق مشاغل مختلف شویم.--}}

{{--                </p>--}}
{{--                <div class="text-center mt-auto">--}}
{{--                    <a href="#" class="btn btn-danger bg-red">به زودی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-12 abut-us col-sm-6 col-md-4 mx-auto bg-dark-blue d-flex flex-column  align-items-center  p-0 p-sm-2 p-md-5">--}}
{{--                <a href="#" class="position-relative ">--}}
{{--                    <img src="{{asset('image/video.png')}}" width="100%" alt="">--}}
{{--                </a>--}}
{{--                <h5 class="mt-5">ویدئو ساز</h5>--}}
{{--                <p class="text-size p-2">--}}
{{--                    ویدئو ها و انیمیشن های مورد نظرتان را با کیفیت پخش بالا در عرض چند دقیقه ایجاد کنید.--}}
{{--                    استفاده از این سرویس به سخت افزارهای گرانقیمت وسیستم های خاص نیاز ندارد و همه چیز به صورت مستقیم--}}
{{--                    توسط مرورگر شما انجام میشود.--}}
{{--                    ما امکان تولید انواع ویدئو اعم از تبلیغاتی، معرفی محصول، معرفی کسب کار، معرفی وب سایت و... فراهم--}}
{{--                    کردیم تا بتوانید به راحتی مطابق با نیاز، ویدئو های خود را ایجاد کنید.--}}
{{--                </p>--}}
{{--                <div class="text-center mt-auto">--}}
{{--                    <a href="" class="btn btn-danger bg-red">به زودی</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="image-fix5">--}}
{{--        <div class="cover1 d-flex align-items-center justify-content-center">--}}
{{--            <div class="col-12 ">--}}
{{--                <h3 class="text-light text-center">ما را در فضای مجازی دنبال کنید</h3>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 col-sm-6  col-md-3 d-flex justify-content-center mt-3">--}}
{{--                        <a href="https://www.instagram.com/nbpshop.co/" class="btn btn-Cyberspace text-light mx-2">--}}
{{--                            <img class="ml-3" width="50"--}}
{{--                                 src="{{asset('image/brands-and-logotypes.png')}}"--}}
{{--                                 alt=""> پیج محصولات</a>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center mt-3">--}}
{{--                        <a href="https://www.instagram.com/nbpservices.co/" class="btn btn-Cyberspace text-light mx-2">--}}
{{--                            <img class="ml-3" width="50"--}}
{{--                                 src="{{asset('image/brands-and-logotypes.png')}}"--}}
{{--                                 alt=""> پیج خدمات</a>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center mt-3">--}}
{{--                        <a href="https://www.instagram.com/nbpworkcenter.co/"--}}
{{--                           class="btn btn-Cyberspace text-light mx-2">--}}
{{--                            <img class="ml-3" width="50"--}}
{{--                                 src="{{asset('image/brands-and-logotypes.png')}}"--}}
{{--                                 alt=""> پیج رسمی شرکت</a>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center mt-3">--}}
{{--                        <a href="https://www.instagram.com/nbpacademy.co/" class="btn btn-Cyberspace text-light mx-2">--}}
{{--                            <img class="ml-3" width="50"--}}
{{--                                 src="{{asset('image/brands-and-logotypes.png')}}"--}}
{{--                                 alt=""> پیج آکادمی</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div style="direction: ltr">
        <section class="reviews">
            <div class="section_title">
                <h2>فروشندگان برتر {{\Morilog\Jalali\Jalalian::now()->format('%B')}} ماه </h2>
            </div>
            <div class="grid-container">
                <div class="grid-x grid-padding-x align-center">
                    <div class="cell medium-9 small-12">
                        <div class="reviews-slider slider-nav">
                            @foreach($bestSellers as $bests)
                                <div class="sin-testiImage">
                                    <img width="200" height="200" src="{{asset($bests->image)}}" alt="">
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="cell medium-10 small-12">
                        <div class="quotes"></div>
                        <div class="reviews-text-slider slider-for">
                            @foreach($bestSellers as $bestss)
                                <div class="sin-testiText">
                                    <h2>{{$bestss->fullName}}</h2>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="d-flex align-items-center justify-content-between abut-us pt-4 px-3 ">
        <h3>برندهای طرف قرارداد</h3>
        <a class=" border-bottom hover-a" href="/brands">مشاهده همه</a>
    </div>
    <div class="owl-carousel owl-theme py-5" id="brand">
        @foreach($brands as $brand)
            <div class="d-flex align-items-center justify-content-center border-brand">
                <img src="{{asset($brand->image)}}" style="width: 100%" alt="{{$brand->name}}">
            </div>
        @endforeach

    </div>
    <div class="col-12 px-4 py-5 login" id="contact">
        <div class="text-center mb-5">
            <h4><i class="fa fa-phone text-red ml-2 "></i> ارتباط با NBP</h4>
        </div>
        <div class="row align-items-center">
{{--            <div class="col-12 col-sm-8 col-md-5 mx-auto p-0 p-md-5">--}}
{{--                <div class="d-flex flex-column shadow p-4">--}}
{{--                    <p><i class="fa fa-map-marker-alt ml-2 text-secondary"></i>دفتر مرکزی : سمنان، شاهرود، خیابان 17--}}
{{--                        شهریور، نرسیده به بانک توسعه تعاون، پلاک 23 واحد 1</p>--}}
{{--                    <p><i class="fa fa-phone ml-2 text-secondary"></i>02332238428</p>--}}
{{--                    <p class="text-red "><i class="fa fa-envelope-open ml-2 text-secondary"></i>nbpmarketing@gmail.com--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <img width="100%" src="{{asset('image/contact-us.jpg')}}" alt="">--}}
{{--            </div>--}}
            <div class="col-12 col-sm-8 col-md-6 mx-auto mt-5 mt-md-0">
                <form action="/storeContact" method="post">
                    @csrf
                    <div class="group col-12 p-0">
                        <input id="name" type="text" name="name"><span class="highlight"></span><span
                                class="bar"></span>
                        <label for="name">نام</label>
                        <img src="{{asset('image/social.png')}}" width="20" alt="">
                    </div>
                    <div class="group col-12 p-0">
                        <input id="name" type="text" name="last_name"><span class="highlight"></span><span
                                class="bar"></span>
                        <label for="name">‌نام‌خانوادگی</label>
                        <img src="{{asset('image/social.png')}}" width="20" alt="">
                    </div>
                    <div class="group col-12 p-0 ">
                        <input id="phone" type="text" name="mobile"><span class=""></span><span class="bar"></span>
                        <label for="phone">شماره تماس</label>
                        <img src="{{asset('image/telephone.png')}}" width="20" alt="">
                    </div>
                    <div class="group col-12 p-0 ">
                        <input id="title" type="text" name="title"><span class=""></span><span class="bar"></span>
                        <label for="title">عنوان پیام</label>
                        <img src="{{asset('image/edit.png')}}" width="20" alt="">
                    </div>
                    <div class="group col-12 p-0 ">
                        <textarea placeholder="متن پیام" class="form-control" name="description" id="comment" cols="30"
                                  rows="4"></textarea>
                    </div>
                    <div class=" mx-auto">
                        <button type="submit" class="col-12 btn btn-form rounded" value="Submit">ارسال پیام</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection