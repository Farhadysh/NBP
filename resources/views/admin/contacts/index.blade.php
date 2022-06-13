@extends('admin.master')

@section('content')

    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / تماس با ما</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    @foreach($contacts as $contact)
        <div class="card p-3 mt-2">
            <div class="d-flex justify-content-between">
                <div>
                    <span>{{$contact->name}} {{$contact->last_name}}</span>
                    <span class="text-danger text-v-sm mr-2">{{$contact->created_at}}</span>
                </div>
            </div>
            <div class="mt-2">
                <h5 class="mt-3">{{$contact->title}}</h5>
                <span class="text-muted text-v-sm text-justify">{{$contact->description}}</span>
            </div>
        </div>
    @endforeach

    <div class="col-md-12 d-flex justify-content-center mt-3">
        {{$contacts->render()}}
    </div>
@endsection