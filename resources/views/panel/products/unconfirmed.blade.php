@extends('panel.master')

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <div class="col-md-12 mx-auto">
            <a id="btn_search" class="btn btn-outline-warning cursor-pointer fa fa-search"></a>
        </div>
        <div id="div_search" class="col-md-12 mx-auto">
            <form action=""
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
                <th>علت</th>
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
                    <td class=" pt-5">{{$product->cause}}</td>
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
            {{$products->links()}}
        </div>
    </div>
@endsection
