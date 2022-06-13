@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / پلن / جدید</div>
        <a href="{{route('admin.plans.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.plans.store')}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3" enctype="multipart/form-data">
        @csrf
        <div class="row col-md-12 ">
            <div class="form-group col-md-3">
                <label for="name">نام شغل</label>
                <input type="text" id="name" class="form-control font-small" name="name"
                       placeholder="نام شغل" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="category_id">دسته بندی</label>
                <select name="category_id" id="category_id" class="form-control font-small">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="price">قیمت</label>
                <input type="number" id="price" class="form-control font-small"
                       name="price" value="{{old('price')}}"
                       placeholder="قیمت">
                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="discount">قیمت با تخفیف</label>
                <input type="number" id="discount" class="form-control font-small"
                       name="discount" value="{{old('discount')}}"
                       placeholder="قیمت با تخفیف">
                @if ($errors->has('discount'))
                    <strong class="error">{{$errors->first('discount')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="score">امتیاز</label>
                <input type="text" id="score" value="{{old('score')}}"
                       class="form-control font-small" name="score"
                       placeholder="امتیاز">
                @if ($errors->has('score'))
                    <strong class="error">{{$errors->first('score')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="image">عکس</label>
                <input type="file" id="image"
                       class="form-control font-small" name="image"
                       placeholder="عکس">
                @if ($errors->has('image'))
                    <strong class="error">{{$errors->first('image')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea type="number" id="description" class="form-control font-small"
                          name="description" rows="6" placeholder="توضیحات">{{old('description')}}</textarea>
                @if ($errors->has('description'))
                    <strong class="error">{{$errors->first('description')}}</strong>
                @endif
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ذخیره
            </button>
        </div>
    </form>

@endsection