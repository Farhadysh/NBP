@extends('marketing.master')

@section('css')
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection

@section('content')
    <div class="col-12 d-flex  my-5 align-items-center " style="margin-top: 180px !important;">
        @if(count($products))
            <span class="mx-2 best_sellers mr-1 text-center">{{$products->first()->categories->first()->name}}</span>
        @endif
        <span class="line1"></span>
    </div>
    <div class="col-12">
        <div class="row justify-content-center flex-wrap">
            @foreach($products as $product)
                <a href="{{route('shopping.products.show',['productSlug'=>$product->slug])}}"
                   class="border-shop1 d-flex flex-column align-items-center justify-content-center ">
                    <div class="position-relative">
                        <img class="hvr-grow" src="{{asset($product->imagePath())}}" alt="{{$product->name}}">
                        <div class="hover-border d-flex align-items-center justify-content-center">
                            <p class="m-0">{{$product->user->nickname ?? ""}}</p>
                        </div>
                    </div>
                    <p style="z-index: 999" class="text-dark m-0 py-3">{{$product->name}}</p>
                    <div class="d-flex flex-column flex-column text-center">
                        <span class="orange-card-shop"><img src="{{asset('image/sabad.png')}}" alt="سبد خرید"></span>
                        <span class="text-{{$product->active['color']}}  font-weight-bold"> {{$product->getOriginal('active') == 1 ?  number_format($product->discount) . 'تومان' : 'ناموجود'}}</span>
                        @if(auth()->check() && auth()->user()->hasPlan($product->categories()->first()->id))
{{--                            <span class="text-info small">--}}
{{--                                {{  'پورسانت : ' . number_format($product->commission()) . ' تومان'}}--}}
{{--                            </span>--}}
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="container my-5">
        <div class="mainbox">
            <div class="pgn row justify-content-center">
                {{$products->appends(['search'=>request('search')])->links()}}
            </div>
        </div>
    </div>
@endsection