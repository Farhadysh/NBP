@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / نقش ها</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.roles.create')}}"
           class="btn btn-sm btn-outline-warning font-small">نقش جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>نام نقش</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr class="text-center">
                    <td class="pt-3">{{$role->name}}</td>
                    <td class="pt-3">
                        <form action="{{route('admin.roles.destroy',['id'=>$role->id])}}" method="post">

                            <a href="{{route('admin.roles.edit',['id'=>$role->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$roles->links()}}
        </div>

    </div>

@endsection