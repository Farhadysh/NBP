@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-5 pr-0 pr-md-5">
        @if($user->plans->count())
            <div class="d-flex flex-wrap">
                @foreach($user->plans as $plan)
                    <div class="col-12 col-md-6 my-2">
                        <a href="@if($plan->plan->category_id) /shop/allProducts/{{$plan->plan->category->slug}} @else
                        @if($plan->plan_id == 1 )
                                /user/homePage/visitCart/{{$plan->id}}
                        @else
                                /user/homePage/sms/{{$plan->id}}
                        @endif
                        @endif">
                            <div class="shadow-sm d-flex flex-wrap">
                                <img src="{{asset($plan->plan->image)}}"
                                     width="40%" height="150" alt="{{$plan->plan->name}}"
                                     title="{{$plan->plan->name}}">
                                <div class="d-flex flex-wrap flex-column justify-content-between p-1 mr-3">
                                    <h6 class="text-dark m-0">{{$plan->plan->name}}</h6>

                                    <p class="text-dark m-0">تاریخ انقضا
                                        : {{jdate($plan->expire_at)->format('Y/m/d')}} </p>

                                    <h4 class="m-0 mr-1 text-dark font-weight-bold">
                                        <i class="fa fa-star text-warning"></i>
                                        {{$plan->score}}
                                    </h4>

                                </div>

                                <div class="col-12 mt-3">
                                    <p class="text-dark">{{$plan->plan->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex flex-column justify-content-center align-items-center p-3 bg-white shadow">
                <i class="fas fa-info-circle fa-3x text-dark"></i>
                <h3 class="text-center my-3 text-dark font-weight-bold">شما شغل فعالی ندارید.</h3>
                <a href="/plans" class="btn btn-outline-warning font-weight-bold">خرید شغل</a>
            </div>
        @endif
    </div>
@endsection