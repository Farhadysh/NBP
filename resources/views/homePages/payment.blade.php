<!DOCTYPE html>
<html lang="en">
@include('marketing.section.justNav')
<body>
<div class="d-flex my-4 align-items-center justify-content-center" style="margin-top: 120px !important;">
    <span class="line"></span>
    <span class="mx-2 best_sellers" style="width: auto!important;"> سبد خرید شغل</span>
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
                            <th scope="col">نام شغل</th>
                            <th scope="col">قیمت (تومان)</th>
                            <th scope="col">تنظیمات</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($plans as $plan)
                            <tr class="text-center">
                                <td scope="row">{{$plan->name}}</td>
                                <td>
                                    @if($plan->discount)
                                        <div class="text-center">
                                            <del class="text-center text-danger text-small">
                                                {{number_format($plan->price)}} تومان
                                            </del>
                                        </div>
                                        <p class="text-center text-success font-weight-bold">
                                            {{number_format($plan->discount)}} تومان
                                        </p>
                                    @else
                                        <p class="text-center text-success font-weight-bold">
                                            {{number_format($plan->price)}} تومان
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    <a href="/plans/removeCart/{{$plan->id}}" class="btn btn-sm text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="text-center"><h5>
                                    جمع کل : {{number_format($total)}}
                                </h5></td>
                        </tr>
                        </tbody>
                    </table>
                    <form action="/plans/store" method="post">
                        @csrf
                        @if(collect($plans)->where('category_id', 100)->first())
                            @include('errors')
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
                                    <div class="col-12 my-3">
                                        <label for="address">آدرس:</label>
                                        <textarea name="address" id="address" rows="5" class="form-control"
                                                  placeholder="آدرس خود را وارد کنید">{{old('address')}}</textarea>
                                        @if ($errors->has('address'))
                                            <strong class="error">{{$errors->first('address')}}</strong>
                                        @endif
                                    </div>

                                    <div class="col-12 my-3">
                                        <label for="description">توضیحات:</label>
                                        <textarea name="description" id="description" rows="5" class="form-control"
                                                  placeholder="توضیحات خود را وارد کنید">{{old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                            <strong class="error">{{$errors->first('address')}}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="text-center">
                            <a href="/plans" class="btn btn-sm btn-outline-primary">ادامه خرید</a>
                            <button type="submit" class="btn btn-success btn-sm">ادامه ثبت سفارش</button>
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