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
        @include('errors')
        <form action="{{route('panel.products.update',['id'=>$product->id])}}" method="post"
              class="border bg-white rounded shadow-sm p-3 d-flex flex-wrap" enctype="multipart/form-data">
            @csrf @method('patch')
            <div class="form-group col-md-4">
                <label for="name">نام محصول</label>
                <input type="text" class="form-control font-small"
                       id="name"
                       name="name"
                       value="{{$product->name}}"
                       placeholder="نام محصول">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="brand">برند</label>
                <input type="text" class="form-control font-small"
                       id="brand"
                       name="brand"
                       value="{{$product->brand}}"
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
            {{--                       value="{{$product->production_price}}"--}}
            {{--                       placeholder="قیمت تولید">--}}
            {{--                @if ($errors->has('production_price'))--}}
            {{--                    <strong class="error">{{$errors->first('production_price')}}</strong>--}}
            {{--                @endif--}}
            {{--            </div>--}}

            <div class="form-group col-md-4">
                <label for="company_price">قیمت شرکت</label>
                <input type="text" class="form-control font-small"
                       id="company_price"
                       name="company_price"
                       value="{{$product->company_price}}"
                       placeholder="قیمت شرکت">
                @if ($errors->has('company_price'))
                    <strong class="error">{{$errors->first('company_price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="price">قیمت عرف بازار</label>
                <input type="text" class="form-control font-small"
                       id="price"
                       name="price"
                       value="{{$product->price}}"
                       placeholder="قیمت عرف بازار">

                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="discount">قیمت با تخفیف</label>
                <input type="text" class="form-control font-small"
                       id="discount"
                       name="discount"
                       value="{{$product->discount}}"
                       placeholder="قیمت با تخفیف">

                @if ($errors->has('discount'))
                    <strong class="error">{{$errors->first('discount')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="commission">مبلغ پورسانت</label>
                <input type="text" class="form-control font-small"
                       id="commission"
                       name="commission"
                       value="{{$product->commission}}"
                       placeholder="مبلغ پورسانت">

                @if ($errors->has('commission'))
                    <strong class="error">{{$errors->first('commission')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="limit_count">موجودی</label>
                <input type="text" class="form-control font-small"
                       id="limit_count"
                       name="limit_count" value="{{$product->limit_count}}"
                       placeholder="موجودی">
                @if ($errors->has('limit_count'))
                    <strong class="error">{{$errors->first('limit_count')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="limit_weight">وزن (گرم)</label>
                <input type="text" class="form-control font-small"
                       id="limit_weight"
                       name="limit_weight"
                       value="{{$product->limit_weight}}"
                       placeholder="وزن">

                @if ($errors->has('limit_weight'))
                    <strong class="error">{{$errors->first('limit_weight')}}</strong>
                @endif
            </div>

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="unit">واحد</label>--}}
            {{--                <select name="unit" class="form-control font-small" id="unit">--}}
            {{--                    <option value="" selected>واحد</option>--}}
            {{--                    <option value="عدد" {{$product->unit == 'عدد' ? 'selected' : ''}}>عدد</option>--}}
            {{--                    <option value="کیلو گرم" {{$product->unit == 'کیلو گرم' ? 'selected' : ''}}>کیلو گرم</option>--}}
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
            {{--                       value="{{$product->telegram}}"--}}
            {{--                       placeholder="تلگرام">--}}
            {{--            </div>--}}

            {{--            <div class="form-group col-md-4">--}}
            {{--                <label for="instagram">لینک اینستاگرام</label>--}}
            {{--                <input type="text" class="form-control font-small"--}}
            {{--                       id="instagram"--}}
            {{--                       name="instagram"--}}
            {{--                       value="{{$product->instagram}}"--}}
            {{--                       placeholder="اینستاگرام">--}}
            {{--            </div>--}}

            <div class="form-group col-md-4">
                <label for="parent_id">دسته بندی</label>
                <select name="parent_id" class="form-control font-small cat" id="category">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories->where('parent_id',0) as $category)
                        <option value="{{$category->id}}" {{$category->id == $parent_id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('parent_id'))
                    <strong class="error">{{$errors->first('parent_id')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="category_id">دسته بندی</label>
                <select name="category_id" class="form-control font-small subCat" id="category_id">
                    <option value="" selected>دسته بندی ها</option>
                    @foreach($children as $child)
                        <option value="{{$child->id}}" {{$product->categories->first()->id == $child->id ? 'selected' : ''}} >{{$child->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                    <strong class="error">{{$errors->first('category_id')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="sendDay">ارسال</label>
                <select name="sendDay" class="form-control font-small " id="sendDay">
                    <option value="1" {{$product->sendDay == '1' ? 'selected' : ''}}>آماده ارسال</option>
                    <option value="2" {{$product->sendDay == '2' ? 'selected' : ''}}>دو روز مانده تا ارسال</option>
                </select>
                @if ($errors->has('sendDay'))
                    <strong class="error">{{$errors->first('sendDay')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="tag_id">برچسب</label>
                <select name="tag_id[]" class="form-control font-small selectpicker" id="tag_id" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                                {{in_array($tag->id,$product->tags()->pluck('id')->toArray()) ? 'selected' : ''}}>{{$tag->name}}</option>
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

            <div class="row col-md-12 justify-content-center">
                @foreach($product->images as $image)
                    <div class="position-relative mt-3 mr-1">
                        <img class="mx-auto my-3" src="{{asset($image['image'])}}" width="250" height="200">
                        <a href="{{route('panel.products.destroy_image',['id'=>$image->id])}}"
                           class="btn btn-danger fa fa-times btn-sm position-absolute rounded-circle py-2"
                           style="top: 0;right: 5px"></a>
                        <label>
                            <input type="radio" class="position-absolute option-input radio mr-3" name="thumb"
                                   value="{{$image->id}}"
                                   style="top: 0;right: 200px" {{$image->thumb == 1 ? 'checked' : ''}}/>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="col-md-5 my-2 mx-auto">
                <div class="image-box">
                    <input name="image[]" id="one" type="file" typeof="png,jpg,jpeg">
                    <img id="oneImage" src="/image/fm_no_image.jpg"/>
                </div>
                <label>
                    <input type="radio" class="option-input radio mr-3" name="thumb" value="0"/>
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
                <textarea name="description" rows="8"
                          class="form-control font-small"
                          id="description" placeholder="توضیحات">{{$product->description}}</textarea>
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

                    @foreach($product->properties as $index => $property)
                        <div class="row justify-content-center {{$index == 0 ? '' : 'mt-2'}}">
                            <div class="col-md-3">
                                <input name="title[]" type="text" value="{{$property->title}}" class="form-control"
                                       placeholder="نام ویژگی">
                            </div>

                            <div class="col-md-9">
                                <textarea name="prop[]" type="text" class="form-control"
                                          placeholder="ویژگی">{{$property->prop}}</textarea>
                            </div>
                        </div>
                    @endforeach
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