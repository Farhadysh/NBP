@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-3 pr-0 pr-md-5">
        <table class="table table-striped bg-white shadow-sm">
            <thead>
            <tr class="text-center">
                <th>شماره سفارش</th>
                <th>تاریخ</th>
                <th>مبلغ</th>
                <th>وضعیت</th>
                <th>مشاهده</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="text-center">
                    <td>{{$order->id}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        {{
                        number_format($order->orderLists->sum(function ($q){
                           return $q->discount * $q->count;
                        })+$order->send_price)
                        }}
                    </td>
                    <td class="font-weight-bold text-{{$order->status['color']}}">{{$order->status['title']}}</td>
                    <td>
                        <a href="/user/factor/{{$order->id}}" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection