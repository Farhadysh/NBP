@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / برچسب</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.tags.create')}}"
           class="btn btn-sm btn-outline-warning font-small">برچسب جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام برچسب</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr class="text-center">
                    <td class="">{{$tag->name}}</td>
                    <td class="">
                        <form action="{{route('admin.tags.destroy',['id'=>$tag->id])}}" method="post">

                            <a href="{{route('admin.tags.edit',['id'=>$tag->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}

                            <button type="submit" class="btn btn-sm fa fa-trash"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$tags->links()}}
        </div>

    </div>

@endsection