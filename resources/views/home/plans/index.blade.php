@extends('master')

@section('content')
    <div class="col-md-12 mt-4">
        <div class="d-flex flex-wrap">
            @foreach($plans as $plan)
                <div class="col-md-6  col-lg-3 mt-3 mt-lg-0">
                    <div class="bg-white shadow p-3">
                        <h5 class="m-3 text-center font-weight-bold">{{$plan->name}}</h5>
                        <div class="dropdown-divider"></div>

                        <div class="d-flex justify-content-center my-5">
                            <h2 class="text-center font-weight-bold">{{number_format($plan->price)}}</h2>
                            <span class="mt-2 mr-2 font-weight-bold">تومان</span>
                        </div>

                        <div class="d-flex justify-content-center font-weight-bold">
                            {{$plan->expire_time}} روز اعتبار
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="d-flex justify-content-center font-weight-bold mt-5">
                            {{$plan->score}} امتیاز
                        </div>
                        <div class="dropdown-divider"></div>

{{--                        <div class="d-flex justify-content-center font-weight-bold mt-5">--}}
{{--                            {{$plan->positionCount}} جایگاه--}}
{{--                        </div>--}}
{{--                        <div class="dropdown-divider"></div>--}}

                        <div class=" text-center mt-5">
                            <a href="/plans/store/{{$plan->id}}" class="btn btn-outline-warning rounded-pill">سفارش
                                دهید</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection