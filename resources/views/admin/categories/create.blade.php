@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / دسته بندی / ایجاد دسته بندی</div>
        <a href="{{route('admin.categories.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.categories.store')}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3" enctype="multipart/form-data">
        @csrf
        <div class="row col-md-12 text-center justify-content-center">
            <div class="form-group col-md-3">
                <label for="name">نام دسته بندی</label>
                <input type="text" class="form-control font-small" name="name"
                       placeholder="نام دسته بندی">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>
            <div class="col-md-3 form-group">
                <label for="name">نسبت دسته بندی</label>
                <select class="form-control" name="parent_id">
                    <option value="0" selected>اصلی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 my-2 text-center mx-auto">
            <div class="image-box">
                <input type="file" name="image" id="onet">
                <img class="" id="onetImage"
                     src="/image/fm_no_image.jpg">
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ذخیره</button>
        </div>
    </form>

@endsection