@extends('admin.master')

@section('content')

    <div class="col-12">
        <div class="row d-flex align-items-center">
            <div class="w-100 text-center pt-5 font-weight-bold text-success">
                <h2 class="text-center">لیست جایگاهای {{$user->name}} {{$user->last_name}}</h2>
            </div>
            <div class="col-md-12 padding-top-register mt-3">
                <div class="row mx-auto">
                    <div class="container">
                        <table class="table table-responsive-md table-striped shadow-sm bg-white table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">نام</th>
                                <th>مشاور</th>
                                <th scope="col">دست چپ</th>
                                <th scope="col">مجموع امتیاز</th>
                                <th scope="col">دست راست</th>
                                <th scope="col">کد</th>
                                <th scope="col">کیف پول</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->positions as $position)
                                <tr class="text-center">
                                    <td class="text-warning" scope="row">{{$position->name}}</td>
                                    <td class="text-warning">{{$position->parent->name ?? ""}}</td>
                                    <td>{{$position->leftCount}}</td>
                                    <td>{{$position->leftCount + $position->rightCount}}</td>
                                    <td>{{$position->rightCount}}</td>
                                    <td>{{$position->visitor_code}}</td>
                                    <td>{{number_format($position->wallet)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection