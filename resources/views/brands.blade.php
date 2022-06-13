@extends('master')

@section('content')
    <div class="col-12  " style="margin-top: 140px !important;">
        <div class="border-bottom mx-4">
            <h5 class="font-weight-bold text-danger">برند های طرف قرار داد</h5>
        </div>
    </div>
    <div class="col-12 ">
        <div class="row p-4">
            @foreach($brands as $brand)
                <div class="col-6 col-sm-2 col-md-3 col-lg-1 my-2">
                    <div class="border-brand ">
                        <a href="#">
                            <img src="{{asset($brand->image)}}" width="100%" alt="{{$brand->name}}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection