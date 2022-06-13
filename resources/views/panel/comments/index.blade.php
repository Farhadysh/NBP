@extends('panel.master')

@section('content')

    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        @foreach($comments as $comment)
            <div class="card p-3 mt-2 col-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <span>{{$comment->user->name}} {{$comment->user->last_name}}</span>
                        <span class="text-danger text-v-sm mr-2">{{$comment->created_at}}</span>
                    </div>
                    <div class="{{$comment->url}}">
                        <a href="/shop/products/{{$comment->product->slug}}" target="_blank" class="text-dark">
                            <span>{{$comment->product->name}}</span>
                        </a>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-muted text-v-sm text-justify">{{$comment->message}}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection