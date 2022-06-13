@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / پلن‌ها</div>
        <a href="/admin/plans/buys" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام</th>
                <th>دسته بندی</th>
                <th>قیمت</th>
                <th>امتیاز</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-center">
                <td>{{$planUser->plan->name}}</td>
                <td>{{$planUser->plan->category->name ?? "-"}}</td>
                <td>{{number_format($planUser->price)}}</td>
                <td>{{$planUser->score}}</td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>استان</th>
                <th>شهر</th>
                <th>کدپستی</th>
                <th>شماره موبایل</th>
                <th>آدرس</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-center">
                <td>{{$planUser->address->city->name}}</td>
                <td>{{$planUser->address->city->province->name}}</td>
                <td>{{$planUser->address->postal_code}}</td>
                <td>{{number_format($planUser->address->mobile)}}</td>
                <td>{{$planUser->address->address}}</td>
            </tr>
            </tbody>
        </table>
    </div>


@endsection