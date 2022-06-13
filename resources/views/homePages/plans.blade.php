@extends('homePages.master')

@section('content')

    <div class="col-12 col-lg-9 pl-0 mr-auto  my-md-5 my-1 mb-5 pr-0 pr-md-5">
        <div class="d-flex justify-content-between align-items-center  p-0 p-md-3 border-bottom">
            <p class="text-sing-in">پلن ها</p>
        </div>

        <div class="col-12 py-3">
            <div class="row">
                @foreach($plans as $index => $plan)
                    <div class="col-6 col-sm-4 col-lg-3 my-2">
                        <a href="/plans/addToCart/{{$plan->id}}">
                            <div class="shadow-sm d-flex flex-column justify-content-between" style="min-height: 400px">
                                <div class="">
                                    <img src="{{asset($plan->image)}}" width="100%" height="150" alt="{{$plan->name}}"
                                         title="{{$plan->name}}">
                                    <div class="p-1">
                                        <h6 class="mt-3 text-dark"
                                            style="white-space: pre-line;font-size: 14px">{{$plan->name}}</h6>
                                        <p class="text-muted"
                                           style="font-size: 12px">{{Str::limit($plan->description,200)}}</p>
                                    </div>
                                </div>
                                <div class="p1">
                                    @if($plan->discount)
                                       <div class="text-center">
                                           <del class="text-center text-danger text-small">
                                               {{number_format($plan->price)}} تومان
                                           </del>
                                       </div>
                                        <p class="text-center text-success font-weight-bold">
                                            {{number_format($plan->discount)}} تومان
                                        </p>
                                    @else
                                        <p class="text-center text-success font-weight-bold">
                                            {{number_format($plan->price)}} تومان
                                        </p>
                                    @endif

                                    <div class="text-center d-flex justify-content-center">

                                        <h4 class="m-0 mr-1 text-dark font-weight-bold">
                                            <i class="fa fa-star text-warning"></i>
                                            {{$plan->score}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection