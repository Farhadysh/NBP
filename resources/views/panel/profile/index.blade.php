@extends('panel.master')

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">

        <div class=" col-12 mx-auto borer-profile-sidebar ">
            <form action="{{route('user.profileImage')}}"
                  method="post" enctype="multipart/form-data">
                @csrf
                <div class="image-box2 rounded-circle mt-3 mx-auto border {{$errors->has('image') ? 'border-danger' : ''}}"
                     style="width: 63%">
                    <input type="file" name="image" id="profile">
                    <img class="rounded-circle" id="profileImage" alt="عکس کاربر"
                         src="{{asset(auth()->user()->image ? auth()->user()->image : '/image/user.png')}}" width="140" height="140">
                </div>
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <button type="submit" class="btn btn-sm btn-outline-info px-5 mt-2">تغییر</button>
            </form>
        </div>

        <form action="{{route('panel.profile.store')}}" method="post"
              class="border bg-white rounded shadow-sm p-3 d-flex flex-wrap" enctype="multipart/form-data">
            @csrf

            <div class="form-group col-md-4">
                <label for="name">نام</label>
                <input type="text" class="form-control font-small"
                       id="name"
                       name="name"
                       value="{{auth()->user()->name}}"
                       placeholder="نام">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="last_name">نام خانوادگی</label>
                <input type="text" class="form-control font-small"
                       id="last_name"
                       name="last_name"
                       value="{{auth()->user()->last_name}}"
                       placeholder="نام خانوادگی">
                @if ($errors->has('last_name'))
                    <strong class="error">{{$errors->first('last_name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="nickname">نام فروشگاه</label>
                <input type="text" class="form-control font-small"
                       id="nickname"
                       name="nickname"
                       value="{{auth()->user()->nickname}}"
                       placeholder="نام فروشگاه">
                @if ($errors->has('nickname'))
                    <strong class="error">{{$errors->first('nickname')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="mobile">موبایل</label>
                <input type="text" class="form-control font-small"
                       id="mobile"
                       name="mobile"
                       value="{{auth()->user()->mobile}}"
                       placeholder="موبایل">
                @if ($errors->has('mobile'))
                    <strong class="error">{{$errors->first('mobile')}}</strong>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label for="email">ایمیل</label>
                <input type="text" class="form-control font-small"
                       id="email"
                       name="email"
                       value="{{auth()->user()->email}}"
                       placeholder="ایمیل">
                @if ($errors->has('email'))
                    <strong class="error">{{$errors->first('email')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="bank_id">شماره حساب</label>
                <input type="text" class="form-control font-small"
                       id="bank_id"
                       name="bank_id"
                       value="{{auth()->user()->bank_id}}"
                       placeholder="شماره حساب">

                @if ($errors->has('bank_id'))
                    <strong class="error">{{$errors->first('bank_id')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="birth_date">تاریخ تولد</label>
                <input type="text" class="form-control font-small"
                       id="birth_date"
                       name="birth_date"
                       value="{{auth()->user()->birth_date}}"
                       placeholder="تاریخ تولد">

                @if ($errors->has('birth_date'))
                    <strong class="error">{{$errors->first('birth_date')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="national_code">کدملی</label>
                <input type="text" class="form-control font-small"
                       id="national_code"
                       name="national_code"
                       value="{{auth()->user()->national_code}}"
                       placeholder="کدملی">

                @if ($errors->has('national_code'))
                    <strong class="error">{{$errors->first('national_code')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="password">رمز عبور</label>
                <input type="text" class="form-control font-small"
                       id="password"
                       name="password"
                       placeholder="رمز عبور">

                @if ($errors->has('password'))
                    <strong class="error">{{$errors->first('password')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="password_confirmation">تکرار رمز عبور</label>
                <input type="text" class="form-control font-small"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="تکرار رمز عبور">

                @if ($errors->has('password_confirmation'))
                    <strong class="error">{{$errors->first('password_confirmation')}}</strong>
                @endif
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-outline-success btn-sm font-small my-4 py-2 w-25">ذخیره</button>
            </div>
        </form>
    </div>
@endsection