@extends('admin.master')

@section('content')

    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / درخواست تسویه</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    @foreach($comments as $comment)
        <div class="card p-3 mt-2">
            <div class="d-flex justify-content-between">
                <div>
                    <span>{{$comment->user->name}} {{$comment->user->last_name}}</span>
                    <span class="text-danger text-v-sm mr-2">{{$comment->created_at}}</span>
                </div>
                <div class="{{$comment->url}}">
                    @if($comment->product)
                        <a href="/shop/products/{{$comment->product->slug}}" target="_blank" class="text-dark">
                            <span>{{$comment->product->name}}</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                <span class="text-muted text-v-sm text-justify">{{$comment->message}}</span>
            </div>

            <div class="col-12 mt-3">
                @if(!$comment->approved)
                    <a href="{{route('admin.comments.approved',['id'=>$comment->id])}}"
                       class="btn btn-sm btn-success">تایید</a>
                @endif
                <a href="{{route('admin.comments.destroy',['id'=>$comment->id])}}"
                   class="btn btn-sm btn-danger">حذف</a>
            </div>

        </div>
    @endforeach
@endsection