@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / مدیریت کاربران</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>
    <div class="col-md-12 mx-auto">
        <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
    </div>
    <div id="div_search" class="col-md-12 mx-auto">
        <form action="{{route('admin.users.search')}}"
              class="border-0 rounded p-2 mt-3 form-row" method="get">
            <div class="form-group col-md-2">
                <label for="last_name">نام خانوادگی</label>
                <input type="text" class="form-control font-small" id="last_name" name="last_name"
                       placeholder="نام خانوادگی">
            </div>
            <div class="form-group col-md-2">
                <label for="factor_id">شماره موبایل</label>
                <input type="text" class="form-control font-small" id="mobile" name="mobile"
                       placeholder="شماره موبایل">
            </div>
            <div class="form-group col-md-2">
                <label for="phone">کد بازاریاب</label>
                <input type="text" class="form-control font-small" id="visitor_cod" name="visitor_cod"
                       placeholder="کد بازاریاب">
            </div>
            <div class="form-group col-md-2">
                <label for="pay_status" class="small font-weight-bold">نوع کاربری</label>
                <select class="form-control font-small" id="level" name="level">
                    <option value="" selected></option>
                    <option value="admin">مدیر</option>
                    <option value="visitor">بازاریاب</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-outline-info btn-sm">جست و جو</button>
            </div>
        </form>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>نام کاربری</th>
                <th>کد بازاریاب</th>
                <th>شماره مبایل</th>
                <th>معرف</th>
                <th>مشاور</th>
                <th>نام کاربری مشاور</th>
                <th>کد ملی</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center small">
                    <td class="">{{$user->name}}</td>
                    <td class="">{{$user->last_name}}</td>
                    <td class="">{{$user->username}}</td>
                    <td class="">{{$user->visitor_cod}}</td>
                    <td class="">{{$user->mobile}}</td>
                    <td class="">{{$user->Reference_code == null ? 'NBP' : $user->parent->name . ' - ' .  $user->parent->last_name}}</td>
                    <td class="">{{$user->Consultant_cod == null ? 'NBP' : $user->consultant->name . ' - ' .  $user->consultant->last_name}}</td>
                    <td class="">{{$user->Consultant_cod == null ? 'NBP' : $user->consultant->username}}</td>
                    <td class="">{{$user->national_cod}}</td>
                    <td>
                        <a href="{{route('admin.packages.indexAdmin',['id'=>$user->id])}}" class="btn btn-sm btn-outline-info fa fa-plus"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    </div>
@endsection