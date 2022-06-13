@extends('panel.master')

@section('content')
    <div class="row pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <div class="col-xl-3 col-sm-6 p-2">
            <div class="card card-common">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="shop">
                            <img src="{{asset('image/creditor.png')}}" alt="">
                        </div>
                        <div class="text-left text-secondary">
                            <h6 class="text-card">کیف پول</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between text-card">
                    <h6>تومان</h6>
                    <h4>{{number_format($wallet)}}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-2">
            <div class="card card-common">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="shop">
                            <img src="{{asset('image/commerce-and-shopping.png')}}" alt="">
                        </div>
                        <div class="text-left text-secondary">
                            <h6 class="text-card">کل سفارشات</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between text-card">
                    <h6> تعداد</h6>
                    <h4>{{number_format($ordersCount)}}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-2">
            <div class="card card-common">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="shop">
                            <img src="{{asset('image/send.png')}}" alt="">
                        </div>
                        <div class="text-left text-secondary">
                            <h6 class="text-card">سفارشات جدید</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between text-card">
                    <h6>تعداد</h6>
                    <h4>{{$newOrderCount}}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-2">
            <div class="card card-common">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="shop">
                            <img src="{{asset('image/box%20(1).png')}}" alt="">
                        </div>
                        <div class="text-left text-secondary">
                            <h6 class="text-card">درآمد</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between text-card">
                    <h6> تومان</h6>
                    <h4> {{number_format($income)}} </h4>
                </div>
            </div>
        </div>

        @if(count($products))

            <div class="col-12 mt-4">
                <h6>هشدار عدم موجودی</h6>
            </div>

            <table class="table table-striped bg-white shadow-sm">
                <thead>
                <tr>
                    <th>کد محصول</th>
                    <th>نام محصول</th>
                    <th>نام موجودی</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->limit_count}}</td>
                        <td>
                            <a href="{{route('panel.products.edit',['id'=>$product->id])}}"
                               class="btn btn-outline-info btn-sm fa fa-edit"></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>

    {{--    <!--Postage-->--}}
    {{--    <div class="col-xl-12 col-md-12">--}}
    {{--        <form action="" class="form-row">--}}
    {{--            <div class="col-xl-6 col-sm-12 ">--}}
    {{--                <div class="border-postage">--}}
    {{--                    <div class="d-flex align-items-center justify-content-between head-postage ">--}}
    {{--                        <p class="font-weight-bold"> محاسبه آنلاین هزینه پست </p>--}}
    {{--                        <img src="{{asset('images/fee%20(1).png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                    <div class=" d-flex align-items-center mx-4 mt-4">--}}
    {{--                        <lable class="col-3 m-0 p-0 font-postage">وزن بسته(گرم)</lable>--}}
    {{--                        <input class="form-control col-9" type="text" placeholder="مثال : 100">--}}
    {{--                    </div>--}}
    {{--                    <div class=" d-flex align-items-center mx-4 my-2">--}}
    {{--                        <lable class="col-3 m-0 p-0 font-postage">قیمت بسته(ریال)</lable>--}}
    {{--                        <input class="form-control col-9" type="text" placeholder="مثال : 500.000">--}}
    {{--                    </div>--}}
    {{--                    <div class="my-2 mx-4">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-6">--}}
    {{--                                <select class="form-control">--}}
    {{--                                    <option>استان مقصد</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-6">--}}
    {{--                                <select class="form-control">--}}
    {{--                                    <option>شهر مقصد</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class=" my-2 mx-4">--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-6">--}}
    {{--                                <select class="form-control">--}}
    {{--                                    <option>انتخاب نوع پرداخت</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-6">--}}
    {{--                                <select class="form-control">--}}
    {{--                                    <option>اتخاب روش ارسال</option>--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </div>--}}
    {{--                    <div class="d-flex justify-content-end button-postage">--}}
    {{--                        <button class="d-flex align-items-center my-4 btn mx-4"><i--}}
    {{--                                    class="fa fa-dollar-sign mx-2"></i> محاسبه هزینه--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-xl-6 mx-auto col-sm-12  my-4 my-lg-0">--}}
    {{--                <div class="border-postage">--}}
    {{--                    <div class="d-flex align-items-center justify-content-between head-postage ">--}}
    {{--                        <p class="font-weight-bold"> رهگیری لحظه ای مرسوله در سامانه پست </p>--}}
    {{--                        <img src="{{asset('images/tracking%20(1).png')}}" alt="">--}}
    {{--                    </div>--}}
    {{--                    <div class=" d-flex align-items-center mx-4 mt-3">--}}
    {{--                        <input class="form-control col-12" type="text"--}}
    {{--                               placeholder="بار کد بیست رقمی مرسوله را وارد نمایید">--}}
    {{--                    </div>--}}
    {{--                    <div class="d-flex justify-content-end button-postage">--}}
    {{--                        <button class="d-flex align-items-center my-4 btn mx-4"><i--}}
    {{--                                    class="fa fa-search-location mx-2"></i> رهگیری مرسوله--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </div>--}}
    {{--    <!--Postage-->--}}
@endsection