@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / پلن‌ها</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="mt-3">
        <a href="{{route('admin.plans.create')}}"
           class="btn btn-sm btn-outline-warning font-small">شغل جدید</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>عکس</th>
                <th>نام</th>
                <th>دسته بندی</th>
                <th>قیمت</th>
                <th>امتیاز</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plans as $plan)
                <tr class="text-center">
                    <td>
                        <img width="100" src="{{asset($plan->image)}}" alt="{{asset($plan->name)}}"
                             title="{{asset($plan->name)}}">
                    </td>
                    <td>{{$plan->name}}</td>
                    <td>{{$plan->category->name ?? "-"}}</td>
                    <td>{{number_format($plan->price)}}</td>
                    <td>{{$plan->score}}</td>
                    <td>
                        <a href="{{route('admin.plans.edit',$plan->id)}}" class="fas fa-edit"></a>
                        @if($plan->active)
                            <span class="badge badge-success p-1">فعال</span>
                        @else
                            <span class="badge badge-danger p-1">غیر فعال</span>
                        @endif
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