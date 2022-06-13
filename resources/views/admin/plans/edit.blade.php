@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / پلن / ویرایش</div>
        <a href="{{route('admin.plans.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.plans.update',$plan->id)}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3" enctype="multipart/form-data">
        @csrf @method('patch')
        <div class="row col-md-12 ">
            <div class="form-group col-md-3">
                <label for="name">نام پلن</label>
                <input type="text" id="name" value="{{$plan->name}}"
                       class="form-control font-small" name="name"
                       placeholder="نام پلن">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="category_id">دسته بندی</label>
                <select name="category_id" id="category_id" class="form-control font-small">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $plan->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="price">قیمت</label>
                <input type="number" id="price" value="{{$plan->price}}"
                       class="form-control font-small" name="price"
                       placeholder="قیمت">
                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="discount">قیمت با تخفیف</label>
                <input type="number" id="discount" class="form-control font-small"
                       name="discount" value="{{$plan->discount}}"
                       placeholder="قیمت با تخفیف">
                @if ($errors->has('discount'))
                    <strong class="error">{{$errors->first('discount')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="score">امتیاز</label>
                <input type="text" id="score" value="{{$plan->score}}"
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

            <div class="form-group col-12">
                <label for="description">توضیحات</label>
                <textarea type="number" id="description" class="form-control font-small"
                          name="description" rows="6" placeholder="توضیحات">{{$plan->description}}</textarea>
                @if ($errors->has('description'))
                    <strong class="error">{{$errors->first('description')}}</strong>
                @endif
            </div>

            <div class="form-group col-3">
                <label for="active">فعال / غیرفعال</label>
                <select name="active" id="active" class="form-control">
                    <option value="1" {{$plan->active == 1 ? 'selected' : ''}}>فعال</option>
                    <option value="0" {{$plan->active == 0 ? 'selected' : ''}}>غیر فعال</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ذخیره
            </button>
        </div>
    </form>

@endsection