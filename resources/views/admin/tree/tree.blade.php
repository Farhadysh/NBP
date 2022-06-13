@extends('admin.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded">
        <div class="text-dark path-name">داشبورد / درخت</div>
        <a href="/admin" class="btn btn-sm btn-outline-warning font-small">بازگشت</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>نام</th>
            <th>والد</th>
            <th>راست</th>
            <th>چپ</th>
            <th>کیف پول</th>
            <th> راست/ چپ</th>
            <th>وضعیت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($positions as $position)
            <tr>
                <td>{{$position->name}}</td>
                <td>{{$position->parent->name ?? "-"}}</td>
                <td>{{$position->rightCount}}</td>
                <td>{{$position->leftCount}}</td>
                <td>{{$position->wallet}}</td>
                <td>{{$position->r_hand}} | {{$position->l_hand}}</td>
                <td>
                    @if($position->active)
                        <span style="width: 100px;height: 100px" class="px-2 font-small bg-success rounded text-white">فعال</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--    <ul id="tree1">--}}
    {{--        @include('admin.tree.list',['items' => $data])--}}
    {{--    </ul>--}}
@endsection