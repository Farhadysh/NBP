`@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5">
        <div class="d-flex justify-content-between align-items-center  p-3 border-bottom">
            <p class="text-sing-in">تخفیفات</p>
        </div>

        <div class="col-12 py-3">
            <div class="row ">
                @foreach($discounts as $discount)
                    <div class="col-6 col-sm-6 col-md-4 mx-auto my-3">
                        <div class="d-flex flex-column align-items-center justify-content-center shadow">
                            <img src="{{asset($discount->imagePath())}}" width="100%" alt="{{$discount->name}}">
                            <h4 class="text-dark mt-3">{{$discount->name}}</h4>
                            <p class="text-black">{{number_format($discount->price)}} تومان</p>
                            <a href="/user/discounts/payment/{{$discount->id}}"
                               class="btn btn-danger px-5 my-3">خرید</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{--    <div class="d-flex my-5 align-items-center justify-content-center">--}}
    {{--        <span class="line"></span>--}}
    {{--        <span class="mx-2 best_sellers">کارت تخفیف</span>--}}
    {{--        <span class="line"></span>--}}
    {{--    </div>--}}
    {{--    <div class="col-12 abut-image2">--}}
    {{--        <div class="row cover1 d-flex  align-items-center">--}}
    {{--            <div class="col-12 m-0 p-0 text-center">--}}
    {{--                <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width="40">--}}
    {{--            </div>--}}
    {{--            <div class=" mx-auto col-12  size  ">--}}
    {{--                <h4 class="text-center text-dark font-weight-bold">کارت تخفیف</h4>--}}
    {{--                <p class="col-11 mx-auto text-justify text-secondary line-height1">--}}
    {{--                    در سال های اخیر رقابت بر سر جذب و حفظ مشتریان در تمامی کسب و کارها به شدت دیده می شود.هم صاحبان--}}
    {{--                    مشاغل بدنبال جذب مشتری بیشتر هستند و هم مشتریان با وسواس بیشتر به دنبال بهترین خدمات می باشند.<br>--}}
    {{--                    ما در شرکت nbp به دنبال این هستیم که به واسطه ی طرحی نوین هم در هزینه های افراد صرفه جویی کنیم و هم--}}
    {{--                    باعث رونق مشاغل مختلف شویم.<br>--}}
    {{--                    شرکتnbp قصد دارد بزرگترین باشگاه مشتریان ایران را تشکیل دهد.در این طرح ما بستری را فراهم می کنیم که--}}
    {{--                    مشاغل مختلف تخفیف ، آفر و یا اشانتیونی را در نظر گرفته و افراد به واسطه ی کارت و بن تخفیف nbp از این--}}
    {{--                    تخفیفات بهره مند شوند.<br>--}}
    {{--                    مراکز تخفیفاتی شرکت nbp در 7شاخه مختلف مشخص شده است.<br>--}}
    {{--                    مراکز پزشکی مراکز خدماتی مراکز خرید و فروشگاهی مراکز رفاهی مراکز تفریحی مراکز سلامت و طب سنتی مراکز--}}
    {{--                    حقوقی--}}
    {{--                    شما به راحتی می توانید با تهیه این کارت های تخفیف به مدت یک سال در هزینه های روزمره خود صرفه جویی--}}
    {{--                    کنید و با مراکز معتبر در سرتاسر ایران آشنا شده و لذت دل نشین تخفیف را تجربه کنید.--}}
    {{--                </p>--}}
    {{--                <div class="col-12">--}}
    {{--                    <div class="row justify-content-center  py-3">--}}
    {{--                        @if($cartCount >= 1)--}}
    {{--                            <form action="{{route('user.discountCarts.store')}}"--}}
    {{--                                  class="form-inline" method="post"--}}
    {{--                                  enctype="multipart/form-data">--}}
    {{--                                @csrf--}}
    {{--                                <div class="border-discount m-2">--}}
    {{--                                    <div class="col-12 cover3 text-center">--}}
    {{--                                        <div class="text-right">--}}
    {{--                                            <h3 class=" text-warning pt-4">NBP کارت تخفیف</h3>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="row">--}}
    {{--                                            <span class="text-dark bg-white rounded position-absolute p-2 package-counter font-weight-bold border border-warning">--}}
    {{--                                                {{$cartCount}}</span>--}}
    {{--                                            <div class="col-md-12 col-12 mt-md-5">--}}
    {{--                                                <input type="text" name="name" value="{{old('name')}}"--}}
    {{--                                                       class="form-control mb-2 border border-dark bg-{{$errors->has('name') ? 'danger' : ''}}"--}}
    {{--                                                       placeholder="نام">--}}
    {{--                                                <input type="text" name="last_name" value="{{old('last_name')}}"--}}
    {{--                                                       class="form-control mb-2 border border-dark bg-{{$errors->has('last_name') ? 'danger' : ''}}"--}}
    {{--                                                       placeholder="نام و نام خانوادگی ">--}}
    {{--                                                <input type="text" name="mobile" value="{{old('mobile')}}"--}}
    {{--                                                       class="form-control border border-dark bg-{{$errors->has('mobile') ? 'danger' : ''}}"--}}
    {{--                                                       placeholder="شماره تلفن">--}}
    {{--                                                <input type="text" name="bank_name" value="{{old('bank_name')}}"--}}
    {{--                                                       class="form-control border border-dark bg-{{$errors->has('bank_name') ? 'danger' : ''}}"--}}
    {{--                                                       placeholder="نام بانک">--}}
    {{--                                                <div class="col-md-12 mt-3">--}}
    {{--                                                    <input type="text" name="bank_id" value="{{old('bank_id')}}"--}}
    {{--                                                           class="form-control border w-100 border-dark bg-{{$errors->has('bank_id') ? 'danger' : ''}}"--}}
    {{--                                                           placeholder="شماره 16 رقمی کارت بانکی">--}}
    {{--                                                </div>--}}
    {{--                                                <div class="text-right pr-3">--}}
    {{--                                                    <button type="submit"--}}
    {{--                                                            class="w-70 btn-disc  btn btn-outline-light  mt-2 mb-3"><span--}}
    {{--                                                                class="fa fa-user-edit ml-2"></span>درخواست کارت--}}
    {{--                                                    </button>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </form>--}}
    {{--                        @else--}}
    {{--                            <div class="p-5 bg-white text-center shadow-lg my-4">--}}
    {{--                                <h5 class="font-weight-bold text-danger">شما همه کارت هایتان را استفاده کرده اید</h5>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection