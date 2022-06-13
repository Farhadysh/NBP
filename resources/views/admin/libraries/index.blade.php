@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / کتابخانه</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.libraries.create')}}"
           class="btn btn-sm btn-outline-warning font-small">کتاب جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>عکس جلد</th>
                <th>نام کتاب</th>
                <th>ژانر</th>
                <th>نویسنده</th>
                <th>ناشر</th>
                <th>محل نشر</th>
                <th>تاریخ نشر</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($libraries as $library)
                <tr class="text-center">
                    <td class=""><img src="{{$library->image}}" width="150" height="100"></td>
                    <td class="pt-5">{{$library->name}}</td>
                    <td class="pt-5">{{$library->title}}</td>
                    <td class="pt-5">{{$library->writer}}</td>
                    <td class="pt-5">{{$library->publisher}}</td>
                    <td class="pt-5">{{$library->country}}</td>
                    <td class="pt-5">{{$library->date}}</td>
                    <td class="pt-5">
                        <form action="{{route('admin.libraries.destroy',['id'=>$library->id])}}" method="post">

                            <a href="{{route('admin.libraries.edit',['id'=>$library->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline-danger btn-sm fa fa-trash"></button>

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$libraries->links()}}
        </div>

    </div>

@endsection