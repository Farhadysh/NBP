@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / کارت ویزیت</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table shadow-sm">
            <thead>
            <tr class="bg-info text-white text-center">
                <td>نام</td>
                <th>نام خانوادگی</th>
                <th>شماره تماس</th>
                <td>کد</td>
                <th>شماره موبایل دیگر</th>
                <th>تاریخ</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($visitCarts as $visitCart)
                <tr class="text-center bg-{{$visitCart->seen == 0 ? 'low-danger' : ''}}">
                    <td class="">{{$visitCart->user->name}}</td>
                    <td class="">{{$visitCart->user->last_name}}</td>
                    <td class="">{{$visitCart->user->mobile}}</td>
                    <td class="">{{$visitCart->numeric_id}}</td>
                    <td class="">{{$visitCart->email}}</td>
                    <td class="">{{$visitCart->created_at}}</td>
                    <td class="">
                        <form action="{{route('admin.visitCarts.destroy',['id'=>$visitCart->id])}}" method="post">
                            <a href="" data-toggle="modal" data-target="#exampleModalCenter{{$visitCart->id}}"
                               class="btn btn-sm btn-outline-info fa fa-eye"></a>
                            @if($visitCart->seen == 0)
                                <a href="{{route('admin.visitCarts.seen',['id'=>$visitCart->id])}}"
                                   class=" btn-sm btn-outline-primary">رسیذگی شد</a>
                            @endif
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-sm btn-outline-danger fa fa-trash"></button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="exampleModalCenter{{$visitCart->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content col-md-10 mr-0">
                            <div class="background-header-modal">
                                <div class="cover-header-modal text-center p-4">
                                    <span class="line"></span>
                                    <h5 class="mx-2 font-weight-bold">متن کارت</h5>
                                    <span class="line"></span>
                                </div>
                            </div>
                            <div class="modal-body text-center" style="white-space: pre-line">
                                {{$visitCart->description}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$visitCarts->links()}}
        </div>
    </div>

@endsection