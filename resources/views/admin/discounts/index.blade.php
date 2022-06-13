@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / تخفیف</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="d-flex">
        <div class="mt-3">
            <a href="{{route('admin.discounts.create')}}"
               class="btn btn-sm btn-outline-warning font-small">تخفیف جدید</a>
        </div>

        <div class="mt-3 mr-2">
            <a href="/admin/discounts/payments"
               class="btn btn-sm btn-outline-primary font-small">لیست خریدها</a>
        </div>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <th>عکس تخفیف</th>
                <th>نام تخفیف</th>
                <th>قیمت</th>
                <th>وضعیت</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($discounts as $discount)
                <tr class="text-center">
                    <td class=""><img src="{{asset($discount->imagePath())}}" width="150" height="100"></td>
                    <td class="pt-5">{{$discount->name}}</td>
                    <td class="pt-5">{{number_format($discount->price)}}</td>
                    <td class="pt-5 text-{{$discount->active['color']}}">{{$discount->active['title']}}</td>
                    <td class="pt-5">
                        <form action="{{route('admin.discounts.destroy',['id'=>$discount->id])}}" method="post">

                            <a href="{{route('admin.discounts.edit',['id'=>$discount->id])}}"
                               class="btn btn-sm btn-outline-info fa fa-edit"></a>
                            @csrf
                            {{method_field('DELETE')}}

                            @if($discount->getOriginal('active') == \App\Category::ACTIVE_TRUE)
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger fa fa-ban">غیر فعال
                                </button>
                            @else
                                <button type="submit"
                                        class="btn btn-sm btn-outline-success fa fa-check"> فعال
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$discounts->links()}}
        </div>
    </div>
@endsection