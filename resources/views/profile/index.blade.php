@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5">
        <div class="profile-body">

            <div class=" col-12 mx-auto borer-profile-sidebar ">
                <form action="{{route('user.profileImage')}}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="image-box2 rounded-circle mt-3 mx-auto border {{$errors->has('image') ? 'border-danger' : ''}}"
                         style="width: 63%">
                        <input type="file" name="image" id="profile" typeof="png,jpg,jpeg">
                        <img class="rounded-circle" id="profileImage" alt="عکس کاربر"
                             src="{{asset($user->image ? $user->image : '/image/user.png')}}" width="140" height="140">
                    </div>
                    @error('image')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <button type="submit" class="btn btn-sm btn-outline-info px-5 mt-2">تغییر</button>
                </form>
            </div>
            {{--            <div class=" badge-home-page py-3 ">--}}
            {{--                <div class=" position-home">--}}
            {{--                    <div class=" poly-up-homePage-profile"></div>--}}
            {{--                    <div class="d-flex align-items-center col-12  ">--}}
            {{--                        <div class="sidebar-toggle-box">--}}
            {{--                            <div data-original-title="Toggle Navigation" data-placement="right"--}}
            {{--                                 class="icon-reorder fa fa-align-center tooltips"--}}
            {{--                                 onclick="myfunction()">--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <label class="font-weight-bold text-secondary text-secondary">اطلاعات شخصی </label>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="profile-body-border m-md-0  mb-5">
                <div class="">
                    <form action="{{route('user.profileUpdate',['id'=>auth()->user()->id])}}" method="post">
                        @csrf
                        <div class="col-md-10 mx-auto mt-3 shadow-sm py-3">
                            <div class="row justify-content-center border-profile-body">
                                <div class="col-12 d-flex my-4 align-items-center justify-content-center">
                                    <span class="line"></span>
                                    <span class="mx-2 best_sellers text-secondary text-center"> ویرایش اطلاعات کاربری</span>
                                    <span class="line"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12  mt-2">
                                    <lable>نام :</lable>
                                    <div class="input-group border-input">
                                        <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                               type="text" placeholder="نام "
                                               name="name"
                                               value="{{$user->name}}">

                                    </div>
                                    @if ($errors->has('name'))
                                        <strong class="text-danger">{{$errors->first('name')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 col-sm-6 mt-2">
                                    <lable>نام خانوادگی :</lable>

                                    <div class="input-group border-input">
                                        <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                               type="text" placeholder="نام خانوادگی"
                                               name="last_name"
                                               value="{{$user->last_name}}">

                                    </div>
                                    @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{$errors->first('last_name')}}</strong>
                                    @endif
                                </div>
                                @if($user->level != 'user')
                                    <div class="col-md-6 col-12 col-sm-6 mt-2">
                                        <lable>کدملی :</lable>

                                        <div class="input-group border-input">
                                            <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                                   type="text" placeholder="کدملی"
                                                   name="national_cod"
                                                   value="{{$user->national_code}}">

                                        </div>
                                        @if ($errors->has('national_cod'))
                                            <strong class="text-danger">{{$errors->first('national_cod')}}</strong>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-md-6 col-sm-6 mt-2">
                                    <lable>شماره تلفن همراه :</lable>

                                    <div class="input-group border-input">
                                        <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                               type="text" placeholder="شماره تلفن همراه "
                                               name="mobile"
                                               value="{{$user->mobile}}">

                                    </div>
                                    @if ($errors->has('mobile'))
                                        <strong class="text-danger">{{$errors->first('mobile')}}</strong>
                                    @endif
                                </div>
                                @if($user->level != 'user')
                                    <div class="col-md-6 col-sm-6 mt-2">
                                        <lable for="Reference_code">معرف :</lable>
                                        <div class="input-group border-input">
                                            <input class="form-control a "
                                                   type="text"
                                                   id="Reference_code"
                                                   placeholder="کد معرف"
                                                   disabled
                                                   name="Reference_code"
                                                   value="{{$user->parent ?? null }}">

                                        </div>
                                        @if($errors->has('Reference_code'))
                                            <strong class=" text-danger">{{$errors->first('Reference_code')}}</strong>
                                        @endif
                                    </div>
                                @endif

                                @if($user->level != 'user')
                                    <div class="col-md-6 col-sm-6 mt-2">
                                        <lable>استان :</lable>
                                        <div class="input-group border-input">
                                            <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                                   type="text" placeholder="استان "
                                                   name="province"
                                                   value="{{$user->city ? $user->city->province->name : ""}}">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 mt-2">
                                        <lable>شهر :</lable>

                                        <div class="input-group border-input">
                                            <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                                   type="text" placeholder="شهر"
                                                   name="city"
                                                   value="{{$user->city ? $user->city->name : ""}}">

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mt-2 ">
                                        <lable>تاریخ تولد</lable>

                                        <div class="input-group border-input">
                                            <input class="form-control a {{$user->level == 'visitor' || 'admin' ? 'none-cursor' : ''}}"
                                                   type="text" placeholder="تاریخ تولد"
                                                   name="berth_date"
                                                   value="{{$user->birth_date}}">

                                        </div>
                                        @if ($errors->has('berth_date'))
                                            <strong class="text-danger">{{$errors->first('berth_date')}}</strong>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-md-6 col-sm-6 col-12  mt-2 ">
                                    <lable>پست الکترونیک :</lable>

                                    <div class="input-group border-input">
                                        <input class="form-control a"
                                               type="text" placeholder="پست الکترونیک "
                                               name="email" value="{{$user->email}}">

                                    </div>
                                    @if ($errors->has('email'))
                                        <strong class="text-danger">{{$errors->first('email')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-6 col-sm-6 col-12 mt-2 ">
                                    <lable>شماره کارت :</lable>

                                    <div class=" input-group border-input">
                                        <input class="form-control a"
                                               type="text" placeholder="کارت‌های عضو شتاب"
                                               name="bank_id" value="{{$user->bank_id}}">
                                    </div>
                                    @if ($errors->has('bank_id'))
                                        <strong class="text-danger">{{$errors->first('bank_id')}}</strong>
                                    @endif
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit"></i> ثبت
                                        ویرایش اطلاعات
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="{{route('user.changePassword',['id'=>auth()->user()->id])}}" method="post">
                        @csrf
                        <div class="col-md-10 mx-auto mt-5 shadow-sm py-3">
                            <div class="row justify-content-center border-profile-body">

                                <div class="col-12 d-flex my-4 align-items-center justify-content-center">
                                    <span class="line"></span>
                                    <span class="mx-2 best_sellers text-secondary text-center">تغییر رمز عبور</span>
                                    <span class="line"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12  mt-2">
                                    <lable>رمز عبور جدید:</lable>
                                    <div class="input-group border-input">
                                        <input class="form-control a" type="password" placeholder="رمز عبور جدید "
                                               name="password">

                                    </div>
                                    @if ($errors->has('password'))
                                        <strong class="text-danger">{{$errors->first('password')}}</strong>
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 col-sm-6 mt-2">
                                    <lable>تکرار رمز عبور جدید :</lable>

                                    <div class="input-group border-input">
                                        <input class="form-control a " type="password"
                                               placeholder="تکرار رمز عبور جدید :"
                                               name="password_confirmation">

                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <strong class="text-danger">{{$errors->first('password_confirmation')}}</strong>
                                    @endif
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-key"></i>تغییر
                                        رمز عبور
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection