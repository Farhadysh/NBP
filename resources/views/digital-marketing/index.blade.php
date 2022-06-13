@extends('master')

@section('content')
    <div class="d-flex my-4 align-items-center justify-content-center">
        <span class="line"></span>
        <span class="mx-2 best_sellers">دیجیتال مارکتینگ</span>
        <span class="line"></span>
    </div>
    <div class="col-md-8 col-sm-6 col-12 size text-center mx-auto">
        <p class="text-justify text-secondary line-height">
            ما در عصری زندگی می کنیم که اکثر مردم از تلفن همراه استفاده می‌کنند واین امر باعث می شود که یک بازار هدف
            بزرگ و رایگان در دسترس ما باشد.<br>
            این بازار هدف بزرگ ما را بر آن داشت که به روز ترین و کاربردی ترین خدمات روز دنیا را عرضه کنیم تا افراد
            بتوانند به واسطه این خدمات نوین در عرض چند ثانیه نیاز خود را برطرف کنند.<br>
            ما در این بخش در گام نخست 5خدمت نوین را فراهم کرده ایم.<br>
            پنل پیامکی انبوه   کارت وبن تخفیف nbp  کارت ویزیت الکترونیک   کتابخانه مجازی    کتابفروشی مجازی
            <br>مشتاقان به امر فروش خدمات هم می توانند با ثبت نام با عنوان بازاریاب وشرکت در آکادمی فوق تخصصی بازاریابی
            به فروش این خدمات بپردازند.

        </p>
    </div>


    <div class="d-flex my-4 align-items-center justify-content-center">
        <span class="line"></span>
        <span class="mx-2 best_sellers">خدمات </span>
        <span class="line"></span>
    </div>
    <div class="mx-auto col-md-9 col-12 p-0 col-sm-12 mt-2">
        <div class="row justify-content-center">
            <div class="col-4 p-0 text-center">
                <a href="{{route('digitalMarket.sms')}}">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="{{asset('image/smsPackage.png')}}" alt="پکیج اس ام اس" width="90%"
                             height="100%">
                    </div>
                </a>
            </div>
            <div class="col-4 p-0 text-center">
                <a href="{{route('digitalMarket.discountCart')}}">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="{{asset('image/discountCart.png')}}" alt="کارت تخفیف" width="90%"
                             height="100%">
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="mx-auto col-md-9 col-12 p-0 col-sm-12 mt-2">
        <div class="row justify-content-center">
            <div class="col-4 p-0 text-center">
                <a href="{{route('digitalMarket.library')}}">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="{{asset('image/library.png')}}" alt="کتابخانه" width="90%"
                             height="100%">
                    </div>
                </a>
            </div>
            <div class="col-4 p-0 text-center">
                <a href="{{route('digitalMarket.visitCart')}}">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="{{asset('image/visitPackage.png')}}" alt="پکیج ویزیتور" width="90%"
                             height="100%">
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4 p-0 text-center">
                <a href="">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="/upload/category/617editor_6s.jpg" alt="ویدیو ساز"
                             width="90%"
                             height="100%">
                    </div>
                </a>
            </div>
            <div class="col-4 p-0 text-center">
                <a href="/shop/categories/خدمات-چاپی">
                    <div class="col-12 height-academy-1 p-0 m-1">
                        <img class="shadow-sm" src="/upload/category/203B-110.jpg" alt="خدمات چاپی"
                             width="90%"
                             height="100%">
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection