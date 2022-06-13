@extends('panel.master')

@section('content')
    <div class="d-flex flex-wrap pt-md-5 pt-0 mt-md-5 mt-0 mb-5">
        <form action="{{route('panel.checkouts.store')}}" method="post"
              class="border bg-white rounded shadow-sm p-3 col-12 d-flex flex-wrap" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-md-4">
                <label for="price">مبلغ درخواستی(حداقل 50000 تومان)</label>
                <input type="text" class="form-control font-small"
                       id="price"
                       name="price"
                       value="{{old('price')}}"
                       placeholder="مبلغ درخواستی">
                @if ($errors->has('price'))
                    <strong class="error">{{$errors->first('price')}}</strong>
                @endif
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-outline-success btn-sm font-small my-4 py-2 w-25">ذخیره</button>
            </div>
        </form>
    </div>
@endsection