@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / برچسب / ویرایش برچسب</div>
        <a href="{{route('admin.tags.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.tags.update',['id'=>$tag->id])}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        <div class="col-md-12 row justify-content-center">
            <div class="form-group col-md-3">
                <label for="name">نام دسته بندی</label>
                <input type="text" class="form-control font-small" name="name"
                       placeholder="نام دسته بندی" value="{{$tag->name}}">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ویرایش</button>
        </div>
    </form>

@endsection