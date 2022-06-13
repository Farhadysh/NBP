<!DOCTYPE html>
<html lang="en">
@include('marketing.section.justNav')
<body>
<div class="d-flex my-4 align-items-center justify-content-center" style="margin-top: 120px !important;">
    <span class="line"></span>
    <span class="mx-2 best_sellers text-center">مرحله دوم خرید</span>
    <span class="line"></span>
</div>
<div class="bg-light pb-5" style="margin-top: 5px!important;">
    <div class="container-fluid">
        <div class="col-md-12 bg-white p-3 shadow-sm medium-radius">
            <div class="row">
                <div class="container">
                    <!-- Bootstrap table and table-striped classes -->

                    <table class="table table-striped">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">نام کالا</th>
                            <th scope="col">تعداد</th>
                            <th scope="col">قیمت (تومان)</th>
                            <th scope="col">مجموع کل (تومان)</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($carts as $cart)
                            <tr class="text-center">
                                <td scope="row">{{$cart->product->name}}</td>
                                <td>{{$cart->qty}}</td>

                                @if(auth()->check() && auth()->user()->hasPlan($cart->product->categories()->first()->id))
                                    <td>{{number_format($cart->product->discount - $cart->product->commission())}}</td>
                                    <td>{{number_format($cart->product->discount - $cart->product->commission() * $cart->qty)}} </td>
                                @else
                                    <td>{{number_format($cart->product->discount)}}</td>
                                    <td>{{number_format($cart->product->discount * $cart->qty)}} </td>
                                @endif

                            </tr>
                        @endforeach
{{--                        @if($commission)--}}
{{--                            <tr class="bg-white">--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td class="text-left ">تخفیف ویژه</td>--}}
{{--                                <td class="text-danger text-center bg-light small"> {{number_format($commission)}}--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
                        <tr class="bg-white">
                            <td></td>
                            <td></td>
                            <td class="text-left font-weight-bold">هزینه ایاب و ذهاب :</td>
                            <td class="text-dark text-center bg-light "> {{number_format(15000)}}

                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td></td>
                            <td></td>
                            <td class="text-left font-weight-bold">قیمت کل :</td>
                            <td class="text-success text-center bg-light font-weight-bold"> {{number_format($total_cart + 15000 - $commission)}}
                                تومان
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{route('user.orders.shopPayment')}}" method="post">
                        @csrf @include('errors')
                        <div class="col-12 form-group my-5">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="postal_code">کد پستی:</label>
                                    <input name="postal_code" class="form-control" value="{{old('postal_code')}}"
                                           type="text" id="post_code"
                                           placeholder="کد پستی خود را وارد کنید...">
                                    @if ($errors->has('postal_code'))
                                        <strong class="error">{{$errors->first('postal_code')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="mobile">شماره موبایل:</label>
                                    <input name="mobile" class="form-control" value="{{old('mobile')}}" type="text"
                                           id="mobile"
                                           placeholder="موبایل">
                                    @if ($errors->has('mobile'))
                                        <strong class="error">{{$errors->first('mobile')}}</strong>
                                    @endif
                                </div>
                                {{--                                <div class="col-md-6 col-12 mt-2">--}}
                                {{--                                    <label for="address_index">استان/شهرستان:</label>--}}
                                {{--                                    <select name="address_index" class="form-control select_city">--}}
                                {{--                                        <option value="1">تحویل درب انبار (ارسال رایگان)</option>--}}
                                {{--                                        <option value="2">شهرهای دیگر</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                <div class="col-md-3 col-12 mt-2 ">
                                    <label for="province">استان:</label>
                                    <select name="province" id="province" class="form-control province">
                                        <option value="">انتخاب استان</option>
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('province'))
                                        <strong class="error">{{$errors->first('province')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-3 col-12 mt-2 ">
                                    <label for="city_id">شهر:</label>
                                    <select name="city_id" id="city_id" class="form-control myCity">

                                    </select>
                                    @if ($errors->has('city_id'))
                                        <strong class="error">{{$errors->first('city_id')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-3 col-12 mt-2 ">
                                    <label for="send_type" hidden>روش ارسال:</label>
                                    <select name="send_type" id="send_type" class="form-control" hidden>
                                        <option value="2">پیشتاز</option>
                                    </select>
                                    @if ($errors->has('send_type'))
                                        <strong class="error">{{$errors->first('city_id')}}</strong>
                                    @endif
                                </div>
                                <div class="col-12 my-3">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="description" rows="3" class="form-control"
                                              placeholder="توضیحات خود را وارد کنید">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                        <strong class="error">{{$errors->first('description')}}</strong>
                                    @endif
                                </div>
                                <div class="col-12 my-3">
                                    <label for="address">توضیحات</label>
                                    <textarea name="address" id="address" rows="5" class="form-control"
                                              placeholder="آدرس خود را وارد کنید">{{old('address')}}</textarea>
                                    @if ($errors->has('address'))
                                        <strong class="error">{{$errors->first('address')}}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-info">ادامه ثبت سفارش</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('/js/shop.js')}}" type="text/javascript"></script>
</body>
</html>