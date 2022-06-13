@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / دسته بندی</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.packages.create')}}"
           class="btn btn-sm btn-outline-info font-small">افزودن پکیج</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <td>عکس پکیج</td>
                <th>نام پکیج</th>
                <th>مدت اعتبار</th>
                <th>قیمت(تومان)</th>
                <th>امتیاز</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr class="text-center">
                    <td class=""><img src="{{$package->image}}" width="150" height="100"></td>
                    <td class="pt-5">{{$package->name}}</td>
                    <td class="pt-5">1 سال بعد از خرید</td>
                    <td class="pt-5">{{$package->price}}</td>
                    <td class="pt-5">{{$package->points}}</td>
                    <td class="pt-5">
                        <form action="{{--{{route('admin.categories.destroy',['id'=>$category->id])}}--}}" method="post">

                            <a href="{{route('admin.packages.edit',['id'=>$package->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}

                            {{--@if($category->getOriginal('active') == \App\Category::ACTIVE_TRUE)
                                <button type="submit"
                                        class="btn btn-sm btn-danger font-small">غیر فعال
                                </button>
                            @else
                                <button type="submit"
                                        class="btn btn-sm btn-success font-small"> فعال
                                </button>
                            @endif--}}

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$packages->links()}}
        </div>

    </div>

@endsection