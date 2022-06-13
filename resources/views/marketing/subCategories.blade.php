@extends('marketing.master')

<style>
    .owl-controls {
        display: none !important;
    }
</style>

@section('content')
    <div style="margin-top: 180px"></div>
    @foreach($subCategories as $category)
        <div class="box-categories my-5">
            <div class="d-flex align-items-center justify-content-between  mt-2">
                <div class="d-flex align-items-center fa fa-box-open btn-lg line-categories p-0"><p class="p-0 m-0">
                        {{$category->name}}</p></div>
                <div class="">
                    <a href="{{route('shopping.allProducts',['id'=>$category->slug])}}" class="text-info">مشاهده
                        همه</a>
                </div>
            </div>
            <div class="prev-shop">
                <div class="my-3 py-3 owl-carousel " style="z-index: 99">
                    @foreach($category->products->take('15') as $product)
                        <div class=" mx-auto">
                            <a href="{{route('shopping.products.show',['productSlug'=>$product->slug])}}"
                               class="border-shop d-flex flex-column align-items-center justify-content-center mx-auto">
                                <div class="position-relative">
                                    <img class="hvr-grow" src="{{$product->imagePath()}}"
                                         alt="{{$product->name}}" style="width: 230px!important;">
                                    <div class="hover-border hover-border d-flex align-items-center justify-content-center">
                                        <p class="m-0">{{$product->user->nicname ?? ""}}</p>
                                    </div>
                                </div>
                                <p style="z-index: 999" class="text-dark text-center mt-3">{{$product->name}}</p>

                                <del class="m-0 text-black small">
                                    {{number_format($product->price)}}
                                </del>

                                <span class="text-center text-{{$product->active['color']}}  font-weight-bold">
                                {{$product->getOriginal('active') == 1 ?  number_format($product->discount) . ' تومان' : 'ناموجود'}}
                            </span>

                                @if(auth()->check() && auth()->user()->hasPlan($product->categories()->first()->id))
                                    <span class="text-info small">
                                {{  'پورسانت : ' . number_format($product->commission()) . ' تومان'}}
                            </span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="button-center">
                    <div class="product-section__nav-btn">
                        <button class="next fa btn fa-chevron-right  btn_next_owl"></button>
                        <button class="prev fa btn fa-chevron-left btn_prev_owl"></button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection