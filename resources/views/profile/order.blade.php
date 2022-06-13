@extends('profile.master')

@section('content')
    <div class="d-flex flex-wrap " style="margin-top: 65px">
        @include('profile.section.sidebar')
        <div class="col-md-9 mx-auto mt-5">
            <table class="table table-info">
                <tr class="text-center">
                    <th>تاریخ سفارش</th>
                    <th>شماره سفارش</th>
                    <th>مقدار پورسانت</th>
                    <th>وضعیت سفارش</th>
                    <th>کالا های سفارش داده شده</th>
                </tr>
                <tbody>
                @foreach($orders as $order)
                    <tr class="text-center bg-white">
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->id}}</td>
                        <td>{{number_format($order->orderLists->sum('commission'))}}</td>
                        <td class="font-weight-bold text-{{$order->status['color']}}">{{$order->status['title']}}</td>
                        <td>
                            <a target="_blank" href="{{route('user.orderList',['id'=>$order->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-list"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection