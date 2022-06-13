@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / پلن‌ها</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="table-responsive mt-3">
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
            @foreach($plans as $plan)
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
                            @if($plan->address)
                                <a href="{{route('admin.planUsers.show',$plan->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$plans->links()}}
        </div>

    </div>

@endsection