@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / کارت تخفیف</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام(کارت)</th>
                <th>نام خانوادگی(کارت)</th>
                <th>شماره موبایل(کارت)</th>
                <th>کد 16 رقمی کارت(کارت)</th>
                <th>نام بانک(کارت)</th>
                <th>نام بازاریاب</th>
                <th>نام خانوادگی بازاریاب</th>
                <th>موبایل بازاریاب</th>
                <th>وضعیت</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($discountCarts as $discountCart)
                <tr class="text-center bg-{{$discountCart->seen == 0 ? 'low-danger' : ''}}">
                    <td class="">{{$discountCart->name}}</td>
                    <td class="">{{$discountCart->last_name}}</td>
                    <td class="">{{$discountCart->mobile}}</td>
                    <td class="">{{$discountCart->bank_id}}</td>
                    <td class="">{{$discountCart->bank_name}}</td>
                    <td class="">{{$discountCart->user->name}}</td>
                    <td class="">{{$discountCart->user->last_name}}</td>
                    <td class="">{{$discountCart->user->mobile}}</td>
                    <td>
                        <span style="white-space: nowrap"
                              class="rounded bg-{{$discountCart->status == 'success' ? 'success' : 'danger'}}
                                      text-white px-3 ">{{$discountCart->status == 'success' ? 'موفق' : 'ناموفق'}}</span>
                    </td>
                    <td class="">
                        @if($discountCart->status == 'success')
                            <a href="{{route('admin.discountCarts.seen',['id' => $discountCart->id])}}"
                               class="btn btn-sm btn-outline-info" style="white-space: nowrap">صادر شد</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$discountCarts->links()}}
        </div>

    </div>

@endsection