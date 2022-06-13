@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-2 mt-md-5 pr-0 pr-md-5 pb-5">
        <div class="d-flex flex-wrap  sms-text py-3">
            @if(auth()->user()->hasPlan('sms'))
                <form method="post" action="{{route('user.register_sms')}}"
                      class="p-md-1 p-sm-3 w-100">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{$plan_id}}">
                    <div class="text-center pt-5 font-weight-bold text-success"><h2>ثبت نام سامانه آکام (پنل پیامکی
                            انبوه)
                        </h2>
                    </div>

                    <div class="col-md-12 mx-auto padding-top-register">
                        <div class="row flex-column align-items-center ">
                            <div class="col-12 col-md-6 mx-auto shadow-sm p-3">
                                <div class=" col-12 mt-3">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="text"
                                               placeholder="نام و نام‌خانوادگی"
                                               name="name">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="text-danger">*</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <strong class="error">{{$errors->first('name')}}</strong>
                                    @endif
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="text"
                                               placeholder="شماره موبایل"
                                               name="mobile">
                                        <div class="input-group-prepend d-flex align-items-center">
                                            <span class="text-danger">*</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <strong class="error">{{$errors->first('mobile')}}</strong>
                                    @endif
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
                                    @if ($errors->has('password'))
                                        <strong class="error">{{$errors->first('password')}}</strong>
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
