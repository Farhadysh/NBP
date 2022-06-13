@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5 ">
        <div class="d-flex flex-wrap cover2 d-flex align-items-center">
            <div class=" mx-auto size mb-5">
                <div class="library-image p-4">
                    <h4 class="text-center text-light text-w font-weight-bold">کتابخانه مجازی</h4>
                    <p class="text-justify text-light line-height1">
                        کتابخانه مجازی کتابخانه ای است که در آن کتاب ها بجای کاغذ به صورت الکترونیک ذخیره شده اند و
                        محتوای
                        الکترونیکی این کتابخانه به گونه ای می باشد که هر فردی در هر نقطه و در هر زمانی با استفاده از
                        اینترنت
                        بتواند دسترسی داشته باشد.
                        به واسطه ی کتابخانه مجازی دیگر افراد نیازی به رفتن به یک مکان خاصی ندارند و فرد می تواند در هر
                        لحظه
                        و در هر مکانی وارد یک کتابخانه بزرگ شود.
                        <br>
                        در ایران تقریبا 60درصد مردم کتاب های غیر درسی نمی خوانند یعنی از هشتاد میلیون نفر فقط سی میلیون
                        نفر
                        هستند که کتاب های غیر درسی می خوانند و طبق آمار سرانه ی مطالعه در ایران دوازده ونیم دقیقه در
                        شبانه
                        روز می باشد.<br>
                        مطالعه فقط در بین شمار اندکی از ایرانیان جریان دارد و حتی بسیاری از دانش آموزان و دانشجویان نیز
                        جز
                        کتاب درسی،مطالعه دیگری ندارد.<br>
                        <strong>مزایای کتابخانه مجازی</strong><br>
                        1.شما نیازی به رفتن به مکان خاصی ندارید.<br>
                        2.درهر زمان از شبانه روز می توانید مطالعه کنید<br>
                        3.شما به راحتی می توانید از یک فهرست به یک کتاب خاص،سپس به یک فصل خاص و ... بروید.<br>
                        4.کتابخانه مجازی شما به هیچ عنوان از بین نمی رود.<br>
                        5.شما برای داشتن یک کتابخانه صد عددی هزینه ی زیادی باید صرف کنید ولی کتابخانه مجازی هزینه ی خیلی
                        کمتری را دارد.<br>
                        کتابخانه مجازی همیشه و در همه جا در جیب شماست.<br>
                        ما در شرکت nbp سعی داریم با در اختیار گزاشتن یک کتابخانه مجازی به افراد،فرهنگ کتاب خوانی و
                        کتابداری
                        را در ایران گسترش دهیم و سرانه ی مطالعاتی کشور را به صورت چشمگیری تغییر دهیم.
                    </p>
                </div>
                <div class="col-12">
                    <div class="row  sms-text py-3">
                        @foreach($libraries as $library)
                            <div class=" col-12 col-sm-6 col-md-4 mt-3">
                                <div class="m-2 border-shop d-flex flex-column h-100 align-items-center justify-content-center mx-auto ">
                                    <img class="hvr-grow" src="{{$library->image}}" alt="{{$library->name}}"
                                         height="300">
                                    <p style="z-index: 999" class="text-dark mt-3">کتاب {{$library->name}}</p>
                                    <a href="{{route('user.libraries.show',['id'=>$library->id])}}"
                                       class="btn btn-outline-dark btn-sm mt-1"><i class="fa fa-book-reader"></i>
                                        مشاهده
                                        کتاب
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    {{$libraries->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection