@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto mt-5 mb-5  pr-0 pr-md-5">

        <table class="table table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">مبلغ</th>
                <th scope="col">تاریخ درخواست</th>
                <th scope="col">وضعیت پرداخت</th>
            </tr>
            </thead>

            <tbody>
            @foreach($checkouts as $checkout)
                <tr class="text-center">
                    <td>{{number_format($checkout->price)}}</td>
                    <td>{{$checkout->created_at}}</td>
                    <td class="text-success">
                        <span class="bg-{{$checkout->status['color']}} rounded py-1 text-white px-3">{{$checkout->status['title']}}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{$checkouts->render()}}
    </div>
@endsection