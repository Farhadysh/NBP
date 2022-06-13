@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / کتابخانه / ثبت کتاب جدید</div>
        <a href="{{route('admin.libraries.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.libraries.store')}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3" enctype="multipart/form-data">
        @csrf
        <div class="row col-md-12">
            <div class="form-group col-md-3">
                <label for="name">نام کتاب</label>
                <input type="text" class="form-control font-small" name="name"
                       placeholder="نام کتاب">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="writer">نام نویسنده</label>
                <input type="text" class="form-control font-small" name="writer"
                       placeholder="نویسنده">
                @if ($errors->has('writer'))
                    <strong class="error">{{$errors->first('writer')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="publisher">ناشر</label>
                <input type="text" class="form-control font-small" name="publisher"
                       placeholder="ناشر">
                @if ($errors->has('publisher'))
                    <strong class="error">{{$errors->first('publisher')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="country">محل نشر</label>
                <input type="text" class="form-control font-small" name="country"
                       placeholder="محل نشر">
            </div>
            <div class="form-group col-md-3">
                <label for="date">تاریخ نشر</label>
                <input type="text" class="form-control font-small" name="date"
                       placeholder="تاریخ نشر">
                @if ($errors->has('date'))
                    <strong class="error">{{$errors->first('date')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="title">ژانر</label>
                <input type="text" class="form-control font-small" name="title"
                       placeholder="ژانر">
                @if ($errors->has('title'))
                    <strong class="error">{{$errors->first('title')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="book_url">آدرس کتاب</label>
                <input type="text" class="form-control font-small" name="book_url"
                       placeholder="آدرس کتاب">
                @if ($errors->has('book_url'))
                    <strong class="error">{{$errors->first('book_url')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="voice_url">آدرس فایل صوتی</label>
                <input type="text" class="form-control font-small" name="voice_url"
                       placeholder="آدرس فایل صوتی">
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