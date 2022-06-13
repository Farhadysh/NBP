@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / دسته بندی / ایجاد دسته بندی</div>
        <a href="{{route('admin.packages.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.packages.update',['id'=>$package->id])}}" method="post"
          class="border p-3 align-items-center bg-white rounded shadow-sm mt-3" enctype="multipart/form-data">
        {{method_field('PATCH')}}
        @csrf
        <div class="row col-md-12 text-center justify-content-center">
            <div class="form-group col-md-3">
                <label for="name">نام پکیج</label>
                <input type="text" class="form-control font-small" name="name"
                       placeholder="نام پکیج" value="{{$package->name}}">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>
            <div class="col-md-3 form-group">
                <label for="category_id">دسته بندی</label>
                <select class="form-control" name="category_id">
                    <option value="0" {{$package->category_id == 0 ? 'selected' : ''}}>اصلی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $package->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                    <strong class="error">{{$errors->first('category_id')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="price">قیمت</label>
                <input type="text" class="form-control font-small" name="price"
                       placeholder="قیمت" value="{{$package->price}}">
                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-2">
                <label for="points">امتیاز</label>
                <input type="number" class="form-control font-small" name="points"
                       placeholder="امتیاز" value="{{$package->points}}">
                @if ($errors->has('points'))
                    <strong class="error">{{$errors->first('points')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-2">
                <label for="active">وضعیت</label>
                <select name="active" id="active" class="form-control">
                    <option value="1" {{$package->active == 1 ? 'selected' : ''}}>فعال</option>
                    <option value="0" {{$package->active == 0 ? 'selected' : ''}}>غیر فعال</option>
                </select>
            </div>
        </div>
        <div class="col-md-5 my-2 text-center mx-auto">
            <div class="image-box">
                <input type="file" name="image" id="onet">
                <img class="" id="onetImage"
                     src="{{$package->image}}">
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ویرایش
            </button>
        </div>
    </form>

@endsection