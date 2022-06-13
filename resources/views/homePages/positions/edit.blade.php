@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  pr-0 pr-md-5 pb-5">
        <div class="d-flex flex-wrap shadow bg-white">
            <div class="col-md-12 mt-5 ">
                <div class="row  d-flex align-items-center">
                    <div class=" mx-auto col-12 size  ">
                        <div class="col-md-12 ">
                            <div class="row mx-auto">
                                <div class="container">
                                    <table class="table table-striped shadow-sm bg-white table-bordered">
                                        <thead>
                                        <tr class="text-center ">
                                            <th>نام</th>
                                            <th>مشاور</th>
                                            <th>دست چپ</th>
                                            <th>دست راست</th>
                                            <th>کد</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($positions as $position)
                                            <tr class="text-center">
                                                <td class="text-warning">{{$position->name}}</td>
                                                <td class="text-warning">{{$position->parent->name ?? ""}}</td>
                                                <td>{{$position->leftCount}}</td>
                                                <td>{{$position->rightCount}}</td>
                                                <td>{{$position->visitor_code}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                @if($planUser->positionCount > $planUser->positions->count())
                    <form action="/user/positions/store" method="post"
                          class="bg-white p-3  d-flex flex-wrap ">
                        @csrf

                        <input type="hidden" value="{{$planUser->id}}" name="plan_user_id">

                        <div class="col-md-12">
                            <label for="name">نام جایگاه</label>
                            <input type="text" class="form-control" placeholder="نام جایگاه" name="name"
                                   id="name" value="{{old('name')}}">
                        </div>

                        @error('name')
                        <span class="text-danger mr-3 mt-2 text-v-sm">{{$message}}</span>
                        @enderror

                        <div class="col-md-12 mt-3">
                            <label for="Reference_code">کد معرف</label>
                            <input type="text" class="form-control" placeholder="کد معرف" name="Reference_code"
                                   id="Reference_code" value="{{old('Reference_code')}}">
                        </div>
                        @error('Reference_code')
                        <span class="text-danger mr-3 mt-2 text-v-sm">{{$message}}</span>
                        @enderror
                        <div class="col-md-12 mt-3 ">
                            <label for="Consultant_code">کد مشاور</label>
                            <input type="text" class="form-control" placeholder="کد مشاور" name="Consultant_code"
                                   id="Consultant_code" value="{{old('Consultant_code')}}">
                        </div>
                        @error('Consultant_code')
                        <span class="text-danger mr-3 mt-2 text-v-sm">{{$message}}</span>
                        @enderror
                        <div class="col-12 text-center mt-4">
                            <button class="btn btn-sm btn-success">ثبت جایگاه</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-success shadow-sm text-center">
                        تبریک! تمام جایگاه ها را ثبت کرده اید.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection