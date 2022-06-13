@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / مدیریت کاربران</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="col-md-10 shadow-sm bg-white mx-auto rounded d-flex justify-content-center mt-5">
        <form action="{{route('admin.users.update',['id'=>$user->id])}}" method="post"
              class="border-0 rounded p-2 mt-3 mx-0 form-row">

            @method('PATCH')
            @csrf
            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input type="text" class="form-control font-small" id="title" name="name"
                       value="{{$user->name}}">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="last_name">نام خانوادگی</label>
                <input autocomplete="off" type="text" class="form-control font-small" name="last_name"
                       value="{{$user->last_name}}">
                @if ($errors->has('last_name'))
                    <strong class="error">{{$errors->first('last_name')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="mobile">شماره موبایل</label>
                <input type="text" class="form-control font-small" name="mobile"
                       value="{{$user->mobile}}">
                @if ($errors->has('mobile'))
                    <strong class="error">{{$errors->first('mobile')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="national_code">کد ملی</label>
                <input type="text" class="form-control font-small" name="national_code"
                       value="{{$user->national_code}}" id="national_code">
                @if ($errors->has('national_code'))
                    <strong class="error">{{$errors->first('national_code')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="parent">کد معرف</label>
                <input type="text" class="form-control font-small" name="parent"
                       value="{{$user->parent}}" id="parent">
                @if ($errors->has('parent'))
                    <strong class="error">{{$errors->first('parent')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="level">سطح</label>
                <select name="level" id="level" class="form-control font-small">
                    <option value="">انتخاب سطح کاربر</option>
                    <option value="user" {{$user->level == 'user' ? 'selected' : ''}}>کاربر عادی</option>
                    <option value="admin" {{$user->level == 'admin' ? 'selected' : ''}}>کاربر</option>
                    <option value="visitor" {{$user->level == 'visitor' ? 'selected' : ''}}>بازاریاب</option>
                    <option value="seller" {{$user->level == 'seller' ? 'selected' : ''}}>تامین کننده</option>
                    <option value="customer" {{$user->level == 'customer' ? 'selected' : ''}}>فروشنده</option>
                </select>

                @if ($errors->has('level'))
                    <strong class="error">{{$errors->first('level')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="role_id">نقش</label>
                <select name="role_id[]" id="role_id" class="form-control font-small">
                    <option value="">انتخاب نقش کاربر</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('level'))
                    <strong class="error">{{$errors->first('level')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="password">رمز عبور</label>
                <input type="password" class="form-control font-small" name="password"
                       value="" id="password" placeholder="رمز عبور">
                @if ($errors->has('password'))
                    <strong class="error">{{$errors->first('password')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3 mt-1">
                <button type="submit" class="btn btn-outline-info mt-4">ویرایش</button>
            </div>
        </form>
    </div>

    <div class="col-md-10 shadow-sm bg-white p-4 mx-auto rounded d-flex flex-wrap justify-content-center mt-5">
        <h5 class="w-100">افزودن شغل</h5>

        <form action="/admin/users/addPlan" method="post" class="w-100 form-row mt-3">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">

            <div class="col-md-3">
                <label for="plan_id">انتخاب شغل</label>
                <select name="plan_id" id="plan_id" class="form-control">
                    <option value="">انتخاب شغل</option>
                    @foreach($plans as $plan)
                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-sm btn-success px-5">ذخیره</button>
            </div>

            <div class="col-12 dropdown-divider my-5"></div>

            <h6>آخرین شغل ها</h6>
            <table class="table">
                <thead>
                <tr>
                    <th>اسم شغل</th>
                    <th>تاریخ انقضا</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->plans()->latest()->take(5)->get() as $plan)
                    <tr>
                        <td>{{$plan->plan->name}}</td>
                        <td>{{jdate($plan->expire_at)->format('Y/m/d')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
@endsection