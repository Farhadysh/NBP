@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / مدیریت کاربر / اطلاعات کاربر</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="col-md-10 bg-white shadow-sm mx-auto mt-5">
        <div class="col-md-12 text-center text-dark p-3">
            <h6 class="font-weight-bold text-muted">پکیج های خریداری شده</h6>
        </div>
        <div class="d-flex">
            <table class="table shadow-sm">
                <thead>
                <tr class="bg-info text-white text-center">
                    <th>نام شغل</th>
                    <th>دسته بندی</th>
                    <th>نام کاربر</th>
                    <th>قیمت</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->plans as $plan)
                    <tr class="text-center">
                        <td>{{$plan->plan->name}}</td>
                        <td>{{$plan->plan->category->name ?? "-"}}</td>
                        <td>{{$plan->user->fullName}}</td>
                        <td>{{number_format($plan->price)}}</td>
                        <td>{{$plan->created_at}}</td>
                        <td>
                            <span class="{{$plan->status == 1 ? 'bg-success' : 'bg-danger'}} text-white px-2 rounded">
                                {{$plan->status == 1 ? 'موفق' : 'ناموفق'}}
                            </span>
                        </td>
                        <td>
                            <form action="{{route('admin.planUsers.destroy',$plan->id)}}" method="post">
                                @csrf @method('delete')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection