@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / نقش / ایجاد نقش</div>
        <a href="{{route('admin.roles.index')}}" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <form action="{{route('admin.roles.update',$role->id)}}" method="post"
          class="border p-3 align-items-center rounded shadow-sm mt-3 bg-white" enctype="multipart/form-data">
        @csrf @method('patch')
        <div class="row col-md-12 text-center justify-content-center">
            <div class="form-group col-md-3">
                <label for="name">نام نقش</label>
                <input type="text" class="form-control font-small" name="name"
                       placeholder="نام نقش" value="{{$role->name}}">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="col-12 d-flex flex-wrap text-right">

                @foreach($permissions as $index => $permission)
                    <div class="form-group col-md-3 text-right">
                        <input type="checkbox" name="permission_id[]"
                               value="{{$permission->id}}" {{in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'checked' : ''}}>
                        {{$permission->name}}
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="col-md-4 btn btn-sm btn-outline-info px-3 category-save-btn mx-auto" type="submit">ذخیره
            </button>
        </div>
    </form>

@endsection