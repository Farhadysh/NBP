@extends('profile.master')

@section('content')
    <div class="d-flex flex-wrap " style="margin-top: 65px">
        @include('profile.section.sidebar')
        <div class="col-md-9 mx-auto mt-5">
            <table class="table table-info">
                <tr class="text-center">
                    <th>نام محصول</th>
                    <th>مبلغ (تومان)</th>
                    <th>کمیسیون (تومان)</th>
                    <th>واحد</th>
                    <th>تعداد</th>
                    <th>مبلغ کل (تومان)</th>
                </tr>
                <tbody>
                @foreach($orderLists as $orderList)
                    <tr class="text-center bg-white">
                        <td>{{$orderList->product->name}}</td>
                        <td>{{number_format($orderList->price)}}</td>
                        <td>{{number_format($orderList->commission)}}</td>
                        <td>{{$orderList->product->unit}}</td>
                        <td>{{$orderList->count}}</td>
                        <td>{{number_format($orderList->count * $orderList->price)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection