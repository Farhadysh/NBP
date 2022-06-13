<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پنل مدیریت فروشگاه</title>

    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/vazir.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('image/Favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="{{asset('/css/kamadatepicker.min.css')}}" rel="stylesheet">
    <script src="{{asset('/js/kamadatepicker.min.js')}}" type="text/javascript"></script>
    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEU50MGV9u1Bq-Co8Y7r2IhucXgMC6dwU"></script>--}}
    @yield('css')
</head>
<body class="bg-light">

<div class="col-12 col-md-12">
    <div class="row justify-content-center mt-4" style="height: 80vh">
        <div class="col-md-8 border-factor bg-white">
            <div class="badge-factor">
                <h5 class="text-center py-3 text-muted">فاکتور مشتری</h5>
            </div>
            <div class="row-factor d-flex justify-content-between flex-wrap-reverse  my-md-3 my-2 mx-md-4 mx-1">
                <div class="flex-column">
                    <div class="d-flex pr-2 text-factor">
                        <strong> شماره فاکتور :‌ </strong>
                        <p class="pr-2">{{$order->id}}</p>
                    </div>
                    <div class="d-flex pr-2 text-factor">
                        <strong> نام مشتری :‌ </strong>
                        <p class="pr-2">{{$order->user->name}} {{$order->user->last_name}}</p>
                    </div>
                    <div class="d-flex pr-2 text-factor">
                        <strong> تاریخ صدور :‌ </strong>
                        <p class="pr-2">{{$order->created_at}}</p>
                    </div>
                    <div class="d-flex pr-2 text-factor">
                        <strong class="text-danger"> تخفیف :‌ </strong>
                        <p class="pr-2 text-danger">0</p>
                    </div>
                </div>
                <div class="mb-md-0 mb-3 img-factor">
                    <img src="/image/navLogo.png" alt="" width="150">
                </div>
            </div>

            <div class="pr-2 pl-2">
                <table class="table table-bordered p-3">
                    <thead>
                    <tr class="text-center badge-secondary">
                        <th scope="col">نام کالا</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">قیمت (تومان)</th>
                        <th scope="col">مجموع کل (تومان)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order->orderLists as $orderList)
                        <tr class="text-center">
                            <td scope="row">{{$orderList->product->name}}</td>
                            <td>{{$orderList->count}}</td>
                            <td>{{number_format($orderList->price)}}</td>
                            <td>{{number_format($orderList->price * $orderList->count)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between flex-wrap-reverse p-md-5 my-5 my-md-0 ml-md-4">
                <div>
                    <strong class="pb-5">آدرس تحویل :</strong>
                    <p>استان/شهرستان : {{$order->address->city->province->name}} - {{$order->address->city->name}}</p>
                    <p>آدرس : {{$order->address->address}}</p>
                    <p>کدپستی : {{$order->address->postal_code}}</p>
                    <p>شماره تلفن : {{$order->address->mobile}}</p>
                </div>
                <div class="d-flex">
                    <strong class="text-success"> جمع کل :‌ </strong>
                    <p class="pr-2 text-success">
                        {{number_format($total)}}
                    </p>
                </div>
            </div>
            <a onclick="window.print()" class="btn btn-outline-secondary fa fa-print float-left">  چاپ فاکتور</a>
        </div>
    </div>
</div>
</body>
</html>