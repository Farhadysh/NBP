@extends('marketing.master')

@section('content')
    <div class="col-12 d-flex  my-5 align-items-center">
        <span class="mx-2 best_sellers mr-1 text-center">سبد محصولات</span>
        <span class="line1"></span>
    </div>
    <div class="col-12 my-5">
        <div class="row ">
            @foreach($categories as $category)
                <a href="{{route('shopping.subCategories',['categorySlug'=>$category->slug])}}"
                   class="col-md-3 col-sm-6 col-12 image-shopping my-md-4 my-2 mx-auto">
                    <img src="{{$category->image}}" class="shadow-sm" alt="{{$category->name}}">
                    <span class="orange-card"><img src="{{asset('image/sabad.png')}}" alt="{{$category->name}}"></span>
                    <div class="logo-shop d-flex align-items-center justify-content-center">
                        <img src="{{asset('image/logo.png')}}" alt="nbpmarketing">
                        <p>{{$category->name}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection