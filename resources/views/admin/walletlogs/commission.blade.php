@extends('admin.master')

@section('content')
    <div class="register-body" style="margin-top: 105px">
        <div class="border-register mx-auto">
            <div class="cover-register-border">
                <div class="image-border-register">
                    <img src="{{asset('image/logo.png')}}" alt="nbpmarketing" width="90">
                </div>
                <div class="p-md-5 p-sm-3">
                    <div class="text-center pt-5 font-weight-bold text-success"><h2>لیست پورسانت های شما</h2></div>

                    <div class="col-md-12 padding-top-register">
                        <div class="row">
                            <div class="container">

                                <!-- Bootstrap table and table-striped classes -->
                                <table class="table table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th scope="col">تاریخ</th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">موضوع</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($commissions as $commission)
                                        <tr class="text-center">
                                            <td>{{$commission->create_at}}</td>
                                            <td>{{number_format($commission->price)}}</td>
                                            <td>{{$commission->subject}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{$commissions->render()}}
        </div>
    </div>
@endsection