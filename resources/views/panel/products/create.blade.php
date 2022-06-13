@extends('panel.master')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}">
    <style>
        .dropdown-item {
            text-align: right;
            font-size: 14px;
        }

        .filter-option-inner-inner {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <form action="{{route('panel.products.store')}}" method="post"
              class="border bg-white rounded shadow-sm p-3 d-flex flex-wrap" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-md-4">
                <label for="name">نام محصول(اجباری)</label>
                <input type="text" class="form-control font-small"
                       id="name"
                       name="name"
                       value="{{old('name')}}"
                       placeholder="نام محصول">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="brand">برند(اجباری)</label>
                <input type="text" class="form-control font-small"
                       id="brand"
                       name="brand"
                       value="{{old('brand')}}"
                       placeholder="برند">
                @if ($errors->has('brand'))
                    <strong class="error">{{$errors->first('brand')}}</strong>
                @endif
            </div>

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="production_price">قیمت تولید</label>--}}
            {{--                <input type="text" class="form-control font-small"--}}
            {{--                       id="production_price"--}}
            {{--                       name="production_price"--}}
            {{--                       value="{{old('production_price')}}"--}}
            {{--                       placeholder="قیمت تولید">--}}
            {{--                @if ($errors->has('production_price'))--}}
            {{--                    <strong class="error">{{$errors->first('production_price')}}</strong>--}}
            {{--                @endif--}}
            {{--            </div>--}}

            <div class="form-group col-md-4">
                <label for="company_price">قیمت شرکت(اجباری)</label>
                <input type="text" class="form-control font-small"
                       id="company_price"
                       name="company_price"
                       value="{{old('company_price')}}"
                       placeholder="قیمت شرکت">
                @if ($errors->has('company_price'))
                    <strong class="error">{{$errors->first('company_price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="discount">قیمت با تخفیف(اجباری)</label>
                <input type="text" class="form-control font-small"
                       id="discount"
                       name="discount"
                       value="{{old('discount')}}"
                       placeholder="قیمت با تخفیف">

                @if ($errors->has('discount'))
                    <strong class="error">{{$errors->first('discount')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="price">قیمت عرف بازار(اجباری)</label>
                <input type="text" class="form-control font-small"
                       id="price"
                       name="price"
                       value="{{old('price')}}"
                       placeholder="قیمت عرف بازار">

                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="commission">مبلغ پورسانت</label>
                <input type="text" class="form-control font-small"
                       id="commission"
                       name="commission"
                       value="{{old('commission')}}"
                       placeholder="مبلغ پورسانت">

                @if ($errors->has('commission'))
                    <strong class="error">{{$errors->first('commission')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="limit_count">موجودی(اختیاری)</label>
                <input type="text" class="form-control font-small"
                       id="limit_count"
                       name="limit_count" value="{{old('limit_count')}}"
                       placeholder="موجودی">
                @if ($errors->has('limit_count'))
                    <strong class="error">{{$errors->first('limit_count')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="limit_weight">وزن (گرم)(اختیاری)</label>
                <input type="text" class="form-control font-small"
                       id="limit_weight"
                       name="limit_weight"
                       value="{{old('limit_weight')}}"
                       placeholder="وزن">

                @if ($errors->has('limit_weight'))
                    <strong class="error">{{$errors->first('limit_weight')}}</strong>
                @endif
            </div>

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="unit">واحد</label>--}}
            {{--                <select name="unit" class="form-control font-small" id="unit">--}}
            {{--                    <option value="" selected>واحد</option>--}}
            {{--                    <option value="عدد" {{old('unit') == 'عدد' ? 'selected' : ''}}>عدد</option>--}}
            {{--                    <option value="کیلو گرم" {{old('unit') == 'کیلو گرم' ? 'selected' : ''}}>کیلو گرم</option>--}}
            {{--                </select>--}}
            {{--                @if ($errors->has('unit'))--}}
            {{--                    <strong class="error">{{$errors->first('unit')}}</strong>--}}
            {{--                @endif--}}
            {{--            </div>--}}

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="telegram">لینک تلگرام</label>--}}
            {{--                <input type="text" class="form-control font-small"--}}
            {{--                       id="telegram"--}}
            {{--                       name="telegram"--}}
            {{--                       placeholder="تلگرام">--}}
            {{--            </div>--}}

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="instagram">لینک اینستاگرام</label>--}}
            {{--                <input type="text" class="form-control font-small"--}}
            {{--                       id="instagram"--}}
            {{--                       name="instagram"--}}
            {{--                       placeholder="اینستاگرام">--}}
            {{--            </div>--}}

            <div class="form-group col-md-4">
                <label for="parent_id">دسته بندی(اجباری)</label>
                <select name="parent_id" class="form-control font-small cat" id="parent_id">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories->where('parent_id',0) as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('parent_id'))
                    <strong class="error">{{$errors->first('parent_id')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="category_id">رسته</label>
                <select name="category_id" class="form-control font-small subCat" id="category_id">
                    <option value="" selected>رسته</option>

                </select>
                @if ($errors->has('category_id'))
                    <strong class="error">{{$errors->first('category_id')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="sendDay">ارسال(اجباری)</label>
                <select name="sendDay" class="form-control font-small " id="sendDay">
                    <option value="1" {{old('sendDay') == '1' ? 'selected' : ''}}>آماده ارسال</option>
                    <option value="2" {{old('sendDay') == '2' ? 'selected' : ''}}>دو روز مانده تا ارسال</option>
                </select>
                @if ($errors->has('sendDay'))
                    <strong class="error">{{$errors->first('sendDay')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="tag_id">برچسب</label>
                <select name="tag_id[]" class="form-control font-small selectpicker" id="tag_id" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('tag_id'))
                    <strong class="error">{{$errors->first('tag_id')}}</strong>
                @endif
            </div>

            <div class="col-md-12">
                <h6>افزودن عکس</h6>
                @if ($errors->has('image'))
                    <strong class="error">{{$errors->first('image')}}</strong>
                @endif
            </div>
            <div class="col-md-5 my-2 mx-auto">
                <div class="image-box">
                    <input name="image[]" id="one" type="file" typeof="png,jpg,jpeg">
                    <img id="oneImage" src="/image/fm_no_image.jpg"/>
                </div>
                <label>
                    <input type="radio" class="option-input radio mr-3" name="thumb" value="0" checked/>
                    <span>عکس شاخص</span>
                </label>
            </div>
            <div class="col-md-5 my-2 mx-auto">
                <div class=" image-box">
                    <input name="image[]" id="two" type="file" typeof="png,jpg,jpeg">
                    <img id="twoImage" src="/image/fm_no_image.jpg"/>
                </div>
                <label>
                    <input type="radio" class="option-input radio mr-3" name="thumb" value="1"/>
                    <span>عکس شاخص</span>
                </label>
            </div>
            <div class="col-md-5 my-2 mx-auto">
                <div class=" image-box">
                    <input name="image[]" id="three" type="file" typeof="png,jpg,jpeg">
                    <img id="threeImage" src="/image/fm_no_image.jpg"/>
                </div>
                <label>
                    <input type="radio" class="option-input radio mr-3" name="thumb" value="2"/>
                    <span>عکس شاخص</span>
                </label>
            </div>

            <div class="col-md-5 my-2 mx-auto">
                <div class=" image-box">
                    <input name="image[]" id="four" type="file" typeof="png,jpg,jpeg">
                    <img id="fourImage" src="/image/fm_no_image.jpg"/>
                </div>
                <label>
                    <input type="radio" class="option-input radio mr-3" name="thumb" value="3"/>
                    <span>عکس شاخص</span>
                </label>
            </div>

            <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea name="description"
                          class="form-control font-small" rows="8"
                          id="description" placeholder="توضیحات">{{old('description')}}</textarea>
                @if ($errors->has('description'))
                    <strong class="error">{{$errors->first('description')}}</strong>
                @endif
            </div>
            <div class="form-group col-md-12 prop">
                <label for="Property">ویژگی ها</label>

                @if ($errors->has('prop.*') || $errors->has('title.*'))
                    <strong class="error">ویژگی ها تکمیل شود</strong>
                @endif

                @if(old('prop'))
                    @foreach(old('prop') as $index => $prop)
                        <div class="row justify-content-center {{$index != 0 ? 'mt-2' : ''}}">
                            <div class="col-md-3">
                                <input name="title[]" type="text" value="{{old('title')[$index]}}" class="form-control"
                                       placeholder="نام ویژگی">
                            </div>

                            <div class="col-md-9">
                                <textarea name="prop[]" type="text" class="form-control"
                                          placeholder="ویژگی">{{$prop}}</textarea>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="رنگ" class="form-control" placeholder="نام ویژگی">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="ابعاد" class="form-control"
                                   placeholder="نام ویژگی">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="مدل" class="form-control" placeholder="نام ویژگی">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="ضمانت" class="form-control"
                                   placeholder="نام ویژگی">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="شماره مجوز" class="form-control"
                                   placeholder="نام ویژگی">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-2">
                        <div class="col-md-3">
                            <input name="title[]" type="text" value="زمان تحویل" class="form-control"
                                   placeholder="زمان تحویل">
                        </div>

                        <div class="col-md-9">
                            <textarea name="prop[]" type="text" class="form-control" placeholder="ویژگی"></textarea>
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-md-12 text-center">
                <a class="btn btn-outline-info fa fa-plus col-md-3 add_prop cursor-pointer"></a>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-outline-success btn-sm font-small my-4 py-2 w-25">ذخیره</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/bootstrap-select.min.js')}}"></script>

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + input['id'] + 'Image').attr('src', e.target.result);
                };


                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#one").change(function () {
            readURL(this);
        });

        $("#two").change(function () {
            readURL(this);
        });
        $("#three").change(function () {
            readURL(this);
        });

        $("#four").change(function () {
            readURL(this);
        });
    </script>
@endsection