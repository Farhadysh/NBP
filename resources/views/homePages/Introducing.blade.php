@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  mt-5 pr-0 pr-md-5">
        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded small-none">
            <strong class="large">معرف های من</strong>
        </div>
        <div class="d-flex justify-content-between align-items-center  p-3 border-bottom small-none">
            <p class="text-sing-in">آقای {{auth()->user()->fullName}} خوش آمدید.</p>
        </div>

        <div class="col-12  py-3">
            <div class="row mx-auto pb-5 align-items-center justify-content-center">
                @foreach($users as $user)
                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                        <div class="d-flex flex-column align-items-center justify-content-center shadow-sm">
                            <img class="p-2" src="{{asset($user->image)}}" width="100%" alt="">
                            <div class="p-4">
                                <h5 class="text-dark"><i class="fa fa-user ml-3"></i>{{$user->fullName}}</h5>
                                <p class="text-secondary text-justify text-news py-2 ">
                                    <i class="fa fa-money-bill-alt ml-3"></i> میزان درآمد
                                    : {{number_format($user->checkouts->sum('price'))}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
