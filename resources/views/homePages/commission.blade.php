@extends('homePages.master')

@section('content')
    <div class="col-12 col-lg-9 pl-0 mr-auto  my-5 pr-0 pr-md-5 ">
        <table class="table table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">مبلغ</th>
                <th scope="col">موضوع</th>
                <th scope="col">تاریخ درخواست</th>
            </tr>
            </thead>

            <tbody>
            @foreach($commissions as $commission)
                <tr class="text-center">
                    <td>{{number_format($commission->price)}}</td>
                    <td>{{$commission->subject}}</td>
                    <td>{{$commission->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{$commissions->render()}}
    </div>
@endsection