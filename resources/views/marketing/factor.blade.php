<!DOCTYPE html>
<html lang="en">
@include('marketing.section.justNav')
<div class="col-12" style="margin-top: 75px">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="border-factor">
            <div class="badge-factor">
                <h3 class="text-center py-3 ">فاکتور مشتری</h3>
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
                        <strong> شماره تراکنش :‌ </strong>
                        <p class="pr-2">{{$order->RefID ?? '-'}}</p>
                    </div>
                </div>
                <div class="mb-md-0 mb-3 img-factor">
                    <img src="{{asset('image/navLogo.png')}}" alt="" width="230">
                </div>
            </div>

            <div class="pr-2 pl-2">
                <table class="table table-bordered p-3">
                    <thead>
                    <tr class="text-center badge-secondary">
                        <th scope="col">نام کالا</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">قیمت (تومان)</th>
                        <th scope="col">قیمت کل (تومان)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order->orderLists as $orderList)
                        <tr class="text-center">
                            <td scope="row">{{$orderList->product->name}}</td>
                            <td>{{$orderList->count}}</td>
                            <td>{{number_format($orderList->discount)}}</td>
                            <td>{{number_format($orderList->discount * $orderList->count)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between flex-wrap-reverse p-md-5 my-5 my-md-0 ml-md-4">
                <div>
                    <strong class="pb-5">آدرس تحویل :</strong>
                    <p>استان/شهرستان : {{$order->address->city->province->name}} / {{$order->address->city->name}}</p>
                    <p>آدرس : {{$order->address->address}}</p>
                    <p>شماره تلفن : {{$order->address->mobile}}</p>
                </div>
                <div class="d-flex">
                    <strong class="text-success"> جمع کل :‌ </strong>
                    <p class="pr-2 text-success">
                        {{number_format($total)}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>