@extends('panel.master')

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
{{--        <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>--}}
    </div>
{{--    <div id="div_search" class="col-md-12 mx-auto">--}}
{{--        <form action="{{route('admin.checkouts.index')}}"--}}
{{--              class="border-0 rounded p-2 mt-3 form-row" method="get">--}}

{{--            <div class="form-group col-md-12">--}}
{{--                <button type="submit" class="btn btn-outline-info btn-sm">جست و جو</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <td>شماره درخواست</td>
                <td>تاریخ</td>
                <td>مبلغ</td>
                <td>وضعیت پرداخت</td>
            </tr>
            </thead>
            <tbody>
            @foreach($checkouts as $checkout)
                <tr class="text-center small">
                    <td class="">{{$checkout->id}}</td>
                    <td class="">{{$checkout->created_at}}</td>
                    <td class="">{{number_format($checkout->price)}}</td>
                    <td>
                        @if($checkout->getOriginal('status') == 'success')
                            <span class="bg-success px-2 text-white rounded">تسویه شده</span>
                        @else
                            <span class="bg-danger px-2 text-white rounded">تسویه نشده</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table  table-bordered table-success text-center">
            <thead>
            <tr>
                <th>جمع صفحه</th>
                <th>جمع کل</th>
                {{--                    <th>سود صفحه</th>--}}
                {{--                    <th>سود کل</th>--}}
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="font-weight-bold">{{number_format($data['total_page'])}}</td>
                <td class="font-weight-bold">{{number_format($data['total'])}}</td>
                {{--                    <td class="font-weight-bold">{{number_format($data['profit_page'])}}</td>--}}
                {{--                    <td class="font-weight-bold">{{number_format($data['profit_total'])}}</td>--}}
            </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{$checkouts->links()}}
        </div>
    </div>
@endsection