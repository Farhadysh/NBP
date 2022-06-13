@extends('admin.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/kamadatepicker.min.css')}}">

    <style>
        .bd-table td {
            padding: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <div class="col-md-12 mx-auto">
            <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
        </div>
        <div id="div_search" class="col-md-12 mx-auto">
            <form action="{{route('admin.orders.search')}}"
                  class="border-0 rounded p-2 mt-3 form-row" method="get">
                <div class="form-group col-md-2">
                    <label for="from_date">از تاریخ</label>
                    <input type="text" class="form-control font-small" id="from_date" name="from_date"
                           placeholder="از تاریخ">
                </div>

                <div class="form-group col-md-2">
                    <label for="to_date">تا تاریخ</label>
                    <input type="text" class="form-control font-small" id="to_date" name="to_date"
                           placeholder="تا تاریخ">
                </div>

                <div class="form-group col-md-2">
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" class="form-control font-small" id="mobile" name="mobile"
                           placeholder="موبایل">
                </div>
                <div class="form-group col-md-2">
                    <label for="id">شماره سفارش</label>
                    <input type="text" class="form-control font-small" id="id" name="id"
                           placeholder="شماره سفارش">
                </div>

                <div class="form-group col-md-2">
                    <label for="status" class="small font-weight-bold">وضعیت پرداخت</label>
                    <select class="form-control font-small" id="status" name="status">
                        <option value="" selected></option>
                        <option value="init">پرداخت نشده</option>
                        <option value="success">پرداخت شده</option>
                        <option value="failed">نا موفق</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="send_status" class="small font-weight-bold">وضعیت سفارش</label>
                    <select class="form-control font-small" id="send_status" name="send_status">
                        <option value="" selected></option>
                        <option value="init">در صف بررسی</option>
                        <option value="send">ارسال شده</option>
                        <option value="delivery">تحویل به مشتری</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-outline-info btn-sm">جست و جو</button>
                </div>
            </form>
        </div>

        <div class="col-md-12 mx-auto mt-2">
            <table class="table">
                <tr class="text-center bg-info text-white">
                    <th>شماره سفارش</th>
                    <th>نام و نام خانوادگی</th>
                    <th>موبایل</th>
                    <th>تاریخ سفارش</th>
                    <th>شماره تراکنش</th>
                    <th>جمع کل</th>
                    <th>وضعیت پرداخت</th>
                    <th>وضعیت سفارش</th>
                    <th>وضعیت تسویه</th>
                    <th>تنطیمات</th>
                </tr>
                <tbody>
                @foreach($orders as $order)
                    <tr class="text-center bg-white">
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->fullName ?? ""}}</td>
                        <td>{{$order->user->mobile ?? ""}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->RefID ?? "-"}}</td>
                        <td>
                            {{number_format($order->send_price + $order->orderLists->sum(function ($q){
                                return $q->discount * $q->count;
                            }))}}
                        </td>
                        <td class="font-weight-bold text-{{$order->status['color']}}">{{$order->status['title']}}</td>
                        <td>
                            <select class="form-control font-small send_status" data-id="{{$order->id}}"
                                    id="send_status" name="send_status">
                                <option value="init" {{$order->send_status == 'init' ? 'selected' : ''}}>در صف بررسی
                                </option>
                                <option value="send" {{$order->send_status == 'send' ? 'selected' : ''}}>ارسال شده
                                </option>
                                <option value="delivery" {{$order->send_status == 'delivery' ? 'selected' : ''}}>تحویل
                                    به مشتری
                                </option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control font-small clear" data-id="{{$order->id}}"
                                    id="clear" name="clear">
                                <option value="0" {{$order->clear == 0 ? 'selected' : ''}}>تسویه نشده
                                </option>
                                <option value="1" {{$order->clear == 1 ? 'selected' : ''}}>تسویه شده</option>
                            </select>
                        </td>
                        <td>
                            <a target="_blank" href="{{route('admin.orders.factor',['id'=>$order->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-list"></a>
                            @if($order->getOriginal('status') != 0)
                                <a href="{{route('admin.orders.changeStatus',['id'=>$order->id,'status'=>2])}}"
                                   class="btn btn-sm btn-outline-success fa fa-arrow-left"></a>
                                <a href="{{route('admin.orders.changeStatus',['id'=>$order->id,'status'=>4])}}"
                                   class="btn btn-sm btn-outline-danger fa fa-ban"></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$orders->appends(request()->toArray())->links()}}
            </div>

            <table class="table  table-bordered table-success text-center">
                <thead>
                <tr>
                    <th>جمع صفحه</th>
                    <th>جمع کل</th>
                    <th>سود صفحه</th>
                    <th>سود کل</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-weight-bold">{{number_format($data['total_page'])}}</td>
                    <td class="font-weight-bold">{{number_format($data['total'])}}</td>
                    <td class="font-weight-bold">{{number_format($data['profit_page'])}}</td>
                    <td class="font-weight-bold">{{number_format($data['profit_total'])}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/kamadatepicker.min.js')}}"></script>

    <script>
        let customOptions = {
            nextButtonIcon: "/image/timeir_next.png",
            previousButtonIcon: "/image/timeir_prev.png",
            forceFarsiDigits: true,
            markToday: true,
            markHolidays: true,
            highlightSelectedDay: true,
            sync: true,
            gotoToday: true,
        };
        kamaDatepicker('from_date', customOptions);
        kamaDatepicker('to_date', customOptions);

        const className = document.querySelectorAll('.send_status');

        Array.from(className).forEach(function (element) {
            element.addEventListener('change', function () {
                let id = element.getAttribute('data-id');
                let status = $(this).children('option:selected').val();
                // loading.modal('show');

                $.ajax({
                    url: '/admin/orders/changeStatus/' + id + '/' + status,
                    type: 'get',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        setTimeout(function () {
                            // loading.modal('hide');
                            // window.location.reload();
                        }, 1500);
                    }, error: function (errors) {
                        setTimeout(function () {
                            // loading.modal('hide');
                            // window.location.reload();
                        }, 1500);
                    }
                });
            });
        });

        const clears = document.querySelectorAll('.clear');

        Array.from(clears).forEach(function (element) {
            element.addEventListener('change', function () {
                let id = element.getAttribute('data-id');
                let clear = $(this).children('option:selected').val();
                // loading.modal('show');

                $.ajax({
                    url: '/admin/orders/changeClear/' + id + '/' + clear,
                    type: 'get',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        setTimeout(function () {
                            // loading.modal('hide');
                            // window.location.reload();
                        }, 1500);
                    }, error: function (errors) {
                        setTimeout(function () {
                            // loading.modal('hide');
                            // window.location.reload();
                        }, 1500);
                    }
                });
            });
        });
    </script>
@endsection