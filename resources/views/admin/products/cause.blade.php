@extends('admin.master')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}">
    <style>
        .dropdown-item {
            text-align: right;
            font-size: 14px;
        }

        .filter-option-inner-inner {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-wrap pt-0 mt-md-5 mt-0 mb-5">
        <form action="{{route('admin.products.unapprovedStore')}}" method="post"
              class="border bg-white col-12 rounded shadow-sm p-3 d-flex flex-wrap" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="product_id" value="{{$product->id}}">

            <div class="form-group col-md-4">
                <label for="name">نام محصول</label>
                <input type="text" class="form-control font-small"
                       id="name" disabled
                       name="name"
                       value="{{$product->name}}"
                       placeholder="نام محصول">
                @if ($errors->has('name'))
                    <strong class="error">{{$errors->first('name')}}</strong>
                @endif
            </div>

            <div class="form-group col-md-12">
                <label for="cause">علت</label>
                <textarea type="text" class="form-control font-small"
                          id="cause"
                          name="cause"
                          placeholder="علت">{{old('cause')}}</textarea>
                @if ($errors->has('cause'))
                    <strong class="error">{{$errors->first('cause')}}</strong>
                @endif
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-outline-success btn-sm font-small my-4 py-2 w-25">ذخیره</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/bootstrap-select.min.js')}}"></script>

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + input['id'] + 'Image').attr('src', e.target.result);
                };


                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#one").change(function () {
            readURL(this);
        });

        $("#two").change(function () {
            readURL(this);
        });
        $("#three").change(function () {
            readURL(this);
        });

        $("#four").change(function () {
            readURL(this);
        });
    </script>
@endsection