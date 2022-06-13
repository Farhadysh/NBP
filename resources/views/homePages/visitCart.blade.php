@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-2 mt-md-5 pr-0 pr-md-5 pb-5">
        <div class="d-flex flex-wrap  sms-text py-3">
            @if(auth()->user()->hasPlan('cart'))
                <form method="post" action="{{route('user.visitCarts.store')}}"
                      class="p-md-1 p-sm-3 w-100">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{$plan_id}}">
                    <div class="text-center pt-5 font-weight-bold text-success"><h2>ثبت نام سامانه نادین (crm)</h2>
                    </div>
                    <div class="col-md-12 mx-auto padding-top-register">
                        <div class="row flex-column align-items-center ">
                            <div class="col-12 col-md-6 mx-auto shadow-sm p-3">
                                <div class=" col-12 mt-3">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="text"
                                               placeholder="نام و نام‌خانوادگی"
                                               name="name" value="{{old('name')}}">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="text-danger">*</span>
                                        </div>
                                    </div>
                                    @error('name')
                                    <strong class="text-danger">{{$errors->first('name')}}</strong>
                                    @enderror
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="text"
                                               placeholder="شماره موبایل"
                                               name="mobile" value="{{old('mobile')}}">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="text-danger">*</span>
                                        </div>

                                    </div>
                                    @error('mobile')
                                    <strong class="text-danger">{{$errors->first('mobile')}}</strong>
                                    @enderror
                                </div>
                                <div class=" col-12 mt-3">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="text"
                                               placeholder="رمز عبور"
                                               name="password">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="text-danger">*</span>
                                        </div>
                                    </div>
                                    @if($errors->has('password'))
                                        <strong class="text-danger">{{$errors->first('password')}}</strong>
                                    @endif
                                </div>


                                <div class="col-12 d-flex justify-content-center  mt-3">
                                    <button type="submit" class="btn btn-outline-success"
                                            style="border-radius: 13px;padding: 8px 85px">ثبت نام
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection


{{--@section('content')--}}
{{--    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-5 pr-0 pr-md-5">--}}
{{--        <div class="d-flex flex-wrap">--}}
{{--            @for ($i = 0; $i < $visitCount; $i++)--}}
{{--                <form action="{{route('user.visitCarts.store')}}" method="post"--}}
{{--                      class="d-flex flex-wrap justify-content-center ">--}}
{{--                    @csrf--}}
{{--                    <div class=" border-discount1 m-2 shadow-sm">--}}
{{--                        <div class="col-12">--}}
{{--                            <h3 class="text-center text-secondary pt-2 text-warning">--}}
{{--                                <span class="fa fa-id-card ml-1"></span> کارت ویزیت </h3>--}}
{{--                            <div class="row">--}}
{{--                                <div class=" col-12 d-flex flex-column">--}}
{{--                                    <input type="hidden" name="visit"--}}
{{--                                           value="{{isset($user->visitCarts[$i]) ? '0' : ''}}">--}}

{{--                                    <label class="m-0">نام و نام‌خانوادگی</label>--}}
{{--                                    <input type="text" name="name" class="input-discount2">--}}
{{--                                    @if ($errors->has('name'))--}}
{{--                                        <strong class="error">{{$errors->first('name')}}</strong>--}}
{{--                                    @endif--}}
{{--                                    <label class="m-0">شماره موبایل</label>--}}
{{--                                    <input type="text" name="mobile" class="input-discount2">--}}
{{--                                    @if ($errors->has('mobile'))--}}
{{--                                        <strong class="error">{{$errors->first('mobile')}}</strong>--}}
{{--                                    @endif--}}
{{--                                    <label class="m-0">رمز عبور</label>--}}
{{--                                    <input type="text" name="password" class="input-discount2">--}}
{{--                                    @if ($errors->has('password'))--}}
{{--                                        <strong class="error">{{$errors->first('password')}}</strong>--}}
{{--                                    @endif--}}
{{--                                    <button type="submit"--}}
{{--                                            class="w-70 btn-disc  btn btn-outline-info mx-auto mt-4 mb-2"><span--}}
{{--                                                class="fa fa-user-edit ml-2"></span>ثبت نام--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            @endfor--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}