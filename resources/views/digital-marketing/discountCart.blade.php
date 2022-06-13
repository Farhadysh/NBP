@extends('homePages.master')

@section('content')
    <div class="d-flex my-4 align-items-center justify-content-center">
        <span class="line"></span>
        <span class="mx-2 best_sellers">کارت تخفیف</span>
        <span class="line"></span>
    </div>
    <div class="col-12 abut-image2">
        <div class="row cover1 d-flex  align-items-center">
            <div class="col-12 m-0 p-0 text-center">
                <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width="40">
            </div>
            <div class=" mx-auto col-12  size">
                <h4 class="text-center text-dark font-weight-bold">کارت تخفیف</h4>
                <p class="col-11 mx-auto text-justify text-secondary line-height1">
                    در سال های اخیر رقابت بر سر جذب و حفظ مشتریان در تمامی کسب و کارها به شدت دیده می شود.هم صاحبان
                    مشاغل بدنبال جذب مشتری بیشتر هستند و هم مشتریان با وسواس بیشتر به دنبال بهترین خدمات می باشند.<br>
                    ما در شرکت nbp به دنبال این هستیم که به واسطه ی طرحی نوین هم در هزینه های افراد صرفه جویی کنیم و هم
                    باعث رونق مشاغل مختلف شویم.<br>
                    شرکتnbp قصد دارد بزرگترین باشگاه مشتریان ایران را تشکیل دهد.در این طرح ما بستری را فراهم می کنیم که
                    مشاغل مختلف تخفیف ، آفر و یا اشانتیونی را در نظر گرفته و افراد به واسطه ی کارت و بن تخفیف nbp از این
                    تخفیفات بهره مند شوند.<br>
                    مراکز تخفیفاتی شرکت nbp در 7شاخه مختلف مشخص شده است.<br>
                    مراکز پزشکی   مراکز خدماتی    مراکز خرید و فروشگاهی    مراکز رفاهی   مراکز تفریحی    مراکز سلامت و
                    طب سنتی   مراکز حقوقی
                    شما به راحتی می توانید <br>با تهیه این کارت های تخفیف به مدت یک سال در هزینه های روزمره خود صرفه
                    جویی کنید و با مراکز معتبر در سرتاسر ایران آشنا شده و لذت دل نشین تخفیف را تجربه کنید.

                </p>
                <div class="col-12 text-center mt-5">
                    <h4 class="font-weight-bolder text-muted">برای دسترسی به این محتوا باید به عنوان بازاریاب یا فروشنده
                        ثبت نام کنید و پکیج خریداری کنید</h4>
                    <a href="/register" class="btn btn-outline-info mt-4 btn-lg">ثبت نام کنید</a>
                </div>
            </div>
        </div>
    </div>
@endsection