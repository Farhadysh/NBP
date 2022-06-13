@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / درخواست تسویه</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="col-md-12 mx-auto">
        <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
    </div>
    <div id="div_search" class="col-md-12 mx-auto">
        <form action="{{route('admin.checkouts.seller')}}"
              class="border-0 rounded p-2 mt-3 form-row" method="get">
            <div class="form-group col-md-2">
                <label for="last_name">نام خانوادگی</label>
                <input type="text" class="form-control font-small"
                       value="{{request()->has('last_name') ? request('last_name') : ''}}" id="last_name"
                       name="last_name"
                       placeholder="نام خانوادگی">
            </div>
            <div class="form-group col-md-2">
                <label for="factor_id">شماره موبایل</label>
                <input type="text" class="form-control font-small"
                       value="{{request()->has('mobile') ? request('mobile') : ''}}" id="mobile" name="mobile"
                       placeholder="شماره موبایل">
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
                <th>شماره موبایل</th>
                <th>معرف</th>
                <th>شماره حساب</th>
                <th>مبلغ درخواستی(تومان)</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($checkouts as $checkout)
                <tr class="text-center small {{$checkout->getOriginal('init') == 1 ? 'bg-low-danger' : ''}}">
                    <td class="">{{$checkout->user->name}}</td>
                    <td class="">{{$checkout->user->last_name}}</td>
                    <td class="">{{$checkout->user->mobile}}</td>
                    <td>{{$checkout->user->parentUser->user->name}} {{$checkout->user->parentUser->user->last_name}}</td>
                    <td class="">{{$checkout->user->bank_id}}</td>
                    <td class="">{{number_format($checkout->price)}}</td>
                    <td>
                        @if($checkout->getOriginal('status') == 'init')
                            <form action="{{route('admin.checkouts.store')}}" method="post">
                                @csrf
                                @if($checkout->position_id)
                                    <input type="text" hidden name="position_id" value="{{$checkout->position->id}}">
                                @endif
                                <input type="text" hidden name="checkout_id" value="{{$checkout->id}}">
                                <button class="btn btn-sm btn-warning ">
                                    تسویه حساب
                                </button>
                            </form>
                        @else
                            <span class="bg-success px-2 text-white rounded">تسویه شده</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$checkouts->links()}}
        </div>
    </div>
@endsection