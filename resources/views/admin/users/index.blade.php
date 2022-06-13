@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / مدیریت کاربران</div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
        </div>

        <div class="col-md-6 mx-auto text-left">
            <a href='{{route('admin.users.plan')}}' class="btn btn-outline-info cursor-pointer btn-sm">محاسبه پلن
                درآمد</a>
        </div>
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
                    <option value="seller">تامین کننده</option>
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
                <th>کد ملی</th>
                <th>نام کاربری</th>
                <th>کد بازاریاب</th>
                <th>نوع</th>
                <th>شماره مبایل</th>
                <th>کیف پول</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center small">
                    <td class="">{{$user->name}}</td>
                    <td class="">{{$user->last_name}}</td>
                    <td class="">{{$user->national_code}}</td>
                    <td class="">
                        <a href="{{route('admin.users.showChild',['id'=>$user->id])}}">
                            {{$user->mobile}}
                        </a>
                    </td>
                    <td class="">{{$user->visitor_code}}</td>
                    <td>{{$user->level}}</td>
                    <td class="">{{$user->mobile}}</td>
                    <td>{{number_format($user->wallet)}}</td>
                    <td>
                        <a href="{{route('admin.users.edit',['id'=>$user->id])}}"
                           class="btn btn-sm btn-outline-info fa fa-edit"></a>
                        @if($user->level != 'seller' && $user->level != 'admin')
                            <a href="{{route('admin.users.show',['id'=>$user->id])}}"
                               class="btn btn-sm btn-outline-dark fa fa-user"></a>
                            <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$user->id}}"
                               class="btn btn-sm btn-outline-primary fas fa-wallet"></a>
                        @endif

                        @if($user->level == 'seller' || $user->level == 'visitor')
                            @if(!$user->best)
                                <a href="/admin/seller/best/{{$user->id}}" class="btn btn-sm btn-success">برتر</a>
                            @else
                                <a href="/admin/seller/best/{{$user->id}}" class="btn btn-sm btn-danger">لغو برتر</a>
                            @endif
                        @endif

                    </td>
                </tr>

                @if($user->level != 'seller' && $user->level != 'admin')
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$user->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content col-md-10 mr-0">
                                <div class="background-header-modal">
                                    <div class="cover-header-modal text-center pt-2">
                                        <span class="line"></span>
                                        <h5 class="mx-2 font-weight-bold">اضافه کردن به کیف پول</h5>
                                        <span class="line"></span>
                                    </div>
                                </div>
                                <div class="modal-body text-center">
                                    <form action="{{route('admin.users.addWallet')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <input type="text" name="addWallet" class="form-control" placeholder="مبلغ">
                                        <select name="type" id="type" class="form-control mt-3">
                                            <option value="1">افزودن</option>
                                            <option value="0">کم کردن</option>
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm mt-3">اضافه کردن</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                @endif
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    </div>
@endsection