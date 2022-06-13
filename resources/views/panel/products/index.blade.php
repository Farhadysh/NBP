@extends('panel.master')

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <div class="col-md-12 mx-auto">
            <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
        </div>
        <div id="div_search" class="col-md-12 mx-auto">
            <form action="{{route('panel.products.search')}}"
                  class="border-0 rounded p-2 mt-3 form-row" method="get">
                <div class="form-group col-md-2">
                    <label for="code">کد محصول</label>
                    <input type="text" class="form-control font-small" id="code" name="code"
                           placeholder="کد محصول">
                </div>
                <div class="form-group col-md-2">
                    <label for="name">نام محصول</label>
                    <input type="text" class="form-control font-small" id="name" name="name"
                           placeholder="نام محصول">
                </div>

                <div class="form-group col-md-2">
                    <label for="brand">برند</label>
                    <input type="text" class="form-control font-small"
                           id="brand" name="brand"
                           placeholder="برند">
                </div>

                <div class="form-group col-md-2">
                    <label for="subCat">دسته بندی</label>
                    <select name="subCat" id="subCat"
                            class="form-control cat font-small">
                        <option value="">انتخاب دسته بندی</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="category_id">رسته</label>
                    <select name="category_id" id="category_id" class="form-control subCat font-small">
                        <option value="">انتخاب رسته</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="active">وضعیت</label>
                    <select name="active" id="active" class="form-control font-small">
                        <option value="">انتخاب وضعیت</option>
                        <option value="1">فعال</option>
                        <option value="0">غیر فعال</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-outline-info btn-sm">جست و جو</button>
                </div>
            </form>
        </div>
        <table class="table bg-white  shadow-sm mt-3">
            <thead>
            <tr class="bg-info text-light text-center">
                <th>عکس محصول</th>
                <th>کد محصول</th>
                <th>نام محصول</th>
                {{--                <th>واحد</th>--}}
                <th>دسته بندی</th>
                <th>وضعیت</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="text-center">
                    <td>
                        <img width="100" height="100" class="border border-info"
                             src="{{asset($product->images->where('thumb',1)->first->image['image'])}}"
                             alt="{{$product->name}}">
                        <span></span>
                    </td>
                    <td class=" pt-5">{{$product->id}}</td>
                    <td class=" pt-5">{{$product->name}}</td>
                    <td class=" pt-5">
                        {{$product->categories()->first()->name}}
                    </td>

                    <td class=" pt-5 text-{{$product->active['color']}}">{{$product->active['title']}}</td>

                    <td class="pt-5">
                        <a href="{{route('panel.products.edit',['id'=>$product->id])}}"
                           class="btn btn-outline-info btn-sm fa fa-edit"></a>
                        @if($product->approved)
                            <a href="{{route('panel.products.active',['id'=>$product->id])}}"
                               class="btn btn-outline-success btn-sm fa fa-check"><span
                                        class="fa fa-ban mr-1 text-danger"></span></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$products->appends(request()->toArray())->links()}}
        </div>
    </div>
@endsection
