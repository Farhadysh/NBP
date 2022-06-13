@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / دسته بندی</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="col-12">
        <form class="form-row col-12">
            <div class="col-12 col-md-4">
                <label for="parent_id">والد</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">انتخاب والد</option>
                    @foreach($subCat as $sub)
                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-4">
                <label for="name">نام دسته بندی</label>
                <input name="name" id="name" class="form-control"/>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-sm btn-success">جستجو</button>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.categories.create')}}"
           class="btn btn-sm btn-outline-warning font-small">دسته بندی جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>عکس دسته بندی</th>
                <th>نام دسته بندی</th>
                <th>نسبت</th>
                <th>وضعیت</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="text-center">
                    <td class=""><img src="{{$category->imagePath()}}" width="150" height="100"></td>
                    <td class="pt-5">{{$category->name}}</td>
                    @if($category->parent)
                        <td class="pt-5">{{$category->parent->name}}</td>
                    @else
                        <td class="pt-5">نسبت اصلی</td>
                    @endif
                    <td class="pt-5 text-{{$category->active['color']}}">{{$category->active['title']}}</td>
                    <td class="pt-5">
                        <form action="{{route('admin.categories.destroy',['id'=>$category->id])}}" method="post">

                            <a href="{{route('admin.categories.edit',['id'=>$category->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}

                            @if($category->getOriginal('active') == \App\Category::ACTIVE_TRUE)
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger fa fa-ban">غیر فعال
                                </button>
                            @else
                                <button type="submit"
                                        class="btn btn-sm btn-outline-success fa fa-check"> فعال
                                </button>
                            @endif

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$categories->links()}}
        </div>

    </div>

@endsection