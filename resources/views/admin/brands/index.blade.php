@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / برندها</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="col-12">
        <form class="form-row col-12">
            <div class="col-12 col-md-4">
                <label for="name">نام برند</label>
                <input name="name" id="name" class="form-control"/>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-sm btn-success">جستجو</button>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.brands.create')}}"
           class="btn btn-sm btn-outline-warning font-small">برند جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام برند</th>
                <th>عکس برند</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr class="text-center">
                    <td class=""><img src="{{asset($brand->image)}}" width="150" height="100"></td>
                    <td class="pt-5">{{$brand->name}}</td>
                    <td class="pt-5">
                        <form action="{{route('admin.brands.destroy',['id'=>$brand->id])}}" method="post">

                            <a href="{{route('admin.brands.edit',['id'=>$brand->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$brands->links()}}
        </div>

    </div>

@endsection