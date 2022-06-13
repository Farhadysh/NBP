@extends('admin.master')

@section('content')
    <div class="col-md-12 bg-white p-2">

        <div class="row col-md-12 mr-1">

        </div>

        <div class="row col-md-12 mr-1">
            <div class="col-md-8 bg-light text-center my-1 p-5 border shadow-sm">
                <h3 class="text-info">Shortcuts</h3>
            </div>
            <div class="col-md-4 bg-light text-center my-1 p-5 border shadow-sm">
                <div class="col-md-12 mx-auto">
                    <a href='{{route('admin.users.plan')}}' class="btn btn-outline-info cursor-pointer p-3">محاسبه پلن درآمد</a>
                </div>
            </div>
        </div>
        <div class="row col-md-12 mr-1">
            <div class="col-md-5 bg-light text-center my-1 p-5 border shadow-sm">
                <h3 class="text-danger">Alarm</h3>
            </div>
            <div class="col-md-7 bg-light text-center my-1 p-5 border shadow-sm">
                <h3 class="text-primary">Details</h3>
            </div>
        </div>
        <div class="row col-md-12 mr-1">
            <div class="col-md-7 bg-light text-center my-1 p-5 border shadow-sm">
                <h3 class="text-muted">Chart 2</h3>
            </div>
            <div class="col-md-5 bg-light text-center my-1 p-5 border shadow-sm">
                <h3 class="text-muted">Chart 3</h3>
            </div>
        </div>

    </div>
@endsection