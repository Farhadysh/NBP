@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / تخفیف</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="">
        <form action="" class="d-flex">
            <div class="col-md-3">
                <input type="text" class="form-control" name="family" placeholder="نام خانوادگی">
            </div>

            <button type="submit" class="btn btn-sm btn-success">ذخیره</button>
        </form>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام و نام خانودگی</th>
                <th>تخفیف</th>
                <th>قیمت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($discounts as $payment)
                <tr class="text-center">
                    <td>{{$payment->user->fullName}}</td>
                    <td>{{$payment->discount->name}}</td>
                    <td>{{$payment->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$discounts->links()}}
        </div>
    </div>
@endsection