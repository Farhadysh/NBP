@extends('admin.master')

@section('content')
    <div class="d-flex flex-wrap  pt-0 mt-md-5 mt-0 mb-5">
        <div class="col-md-12 mx-auto">
            <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
        </div>
        <div id="div_search" class="col-md-12 mx-auto">
            <form class="border-0 rounded p-2 mt-3 form-row">
                <div class="form-group col-md-3">
                    <label for="code">کد محصول</label>
                    <input type="text" class="form-control font-small" id="code" name="code"
                           placeholder="کد محصول">
                </div>
                <div class="form-group col-md-3">
                    <label for="name">نام محصول</label>
                    <input type="text" class="form-control font-small" id="name" name="name"
                           placeholder="نام محصول">
                </div>

                <div class="form-group col-md-3">
                    <label for="user_id"> تامین کننده</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">انتخاب تامین کننده</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->fullName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="subCat">دسته بندی</label>
                    <select name="subCat" id="subCat" class="form-control cat">
                        <option value="">دسته بندی</option>
                        @foreach($subCat as $sub)
                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="category_id">رسته</label>
                    <select name="category_id" id="category_id" class="form-control cat subCat">
                        <option value="">انتخاب رسته</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="active">وضعیت</label>
                    <select name="active" id="active" class="form-control">
                        <option value="">انتخاب وضعیت</option>
                        <option value="1">فعال</option>
                        <option value="0">غیر فعال</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="page">صفحه</label>
                    <input type="text" class="form-control font-small" id="page" name="page"
                           placeholder="صفحه">
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
                <th>نام محصول</th>
                <th>تامین کننده</th>
                <th>واحد</th>
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
                    <td class=" pt-5">{{$product->name}}</td>
                    <td class=" pt-5">{{$product->user->fullName ?? ""}}</td>
                    <td class=" pt-5">{{$product->unit}}</td>
                    <td class=" pt-5">{{isset($product->categories()->first()->parent->name) ? $product->categories()->first()->parent->name : ''}}
                        - {{isset($product->categories()->first()->name) ? $product->categories()->first()->name : ''}}</td>

                    <td class=" pt-5 text-{{$product->active['color']}}">{{$product->active['title']}}</td>

                    <td class="pt-5">
                        <div class="d-flex">
                            @if($product->special)
                                <a href="/admin/products/special/{{$product->id}}" class="btn btn-sm btn-danger">غیر
                                    ویژه</a>
                            @else
                                <a href="/admin/products/special/{{$product->id}}"
                                   class="btn btn-sm btn-success">ویژه</a>
                            @endif
                            <a href="{{route('admin.products.edit',['id'=>$product->id])}}"
                               class="btn btn-outline-info btn-sm fa fa-edit mx-1"></a>
                            <a href="{{route('admin.products.active',['id'=>$product->id])}}"
                               class="btn btn-outline-success btn-sm fa fa-check"><span
                                        class="fa fa-ban mr-1 text-danger"></span></a>

                            @if(!$product->approved)
                                <a href="{{route('admin.products.approved',['id'=>$product->id])}}"
                                   class="btn btn-sm btn-success font-small mt-2">تایید محصول</a>

                                @if(!$product->cause)
                                    <a href="{{route('admin.products.cause',['id'=>$product->id])}}"
                                       class="btn btn-sm btn-danger font-small mt-2 mx-1">عدم تایید</a>
                                @endif
                            @endif

                            <span>{{$product->upodate_at}}</span>
                        </div>
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
