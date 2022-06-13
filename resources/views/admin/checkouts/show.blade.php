@extends('admin.master')

@section('content')
    <div class="col-md-12 text-center text-dark">
        <h4 class="font-weight-bold my-4 text-muted">صورتحساب</h4>
    </div>
    <div class="col-md-8 shadow-sm bg-white mx-auto rounded p-4">
        <div class="mx-auto text-center p-4">
            <span class="font-weight-bold">نام کاربر:</span>
            <span>{{$user->name}} {{$user->last_name}}</span>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <span class="">مبلغ کیف پول (تومان):</span>
                <span class="text-danger">{{number_format($user->wallet)}}</span>
            </div>
        </div>
        <div class="">
            <form action="{{route('admin.incomes.store')}}" class="form-row" method="post">
                @csrf
                <input name="user_id" value="{{$user->id}}" type="hidden">
                <div class="form-group col-md-4">
                    <input class="money form-control" name="cost" id="" placeholder="مبلغ پرداختی">
                    @if ($errors->has('cost'))
                        <strong class="error">{{$errors->first('cost')}}</strong>
                    @endif
                </div>
                <input type="hidden" name="final_price" value="">
                <div class="form-group col-md-4">
                    <input autocomplete="off" class="form-control" name="date" id="date" placeholder="تاریخ پرداخت">
                    @if ($errors->has('date'))
                        <strong class="error">{{$errors->first('date')}}</strong>
                    @endif
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-outline-success btn-sm reload" type="submit">اعمال
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-10 mx-auto">
            <table class="table table-bordered rounded">
                <tr class="small bg-info text-white">
                    <th class="text-center">مبلغ پرداختی</th>
                    <th class="text-center">شماره تراکنش</th>
                    <th class="text-center">تاریخ پرداخت</th>
                    <th class="text-center">تنطیمات</th>
                </tr>
                @foreach($user->incomes as $income)
                    <tr>
                        <td class="text-center small">{{number_format($income->cost)}}</td>
                        <td class="text-center small">{{$income->ref_id}}</td>
                        <td class="text-center small">{{$income->date}}</td>
                        <td class="text-center small">
                            <form action="{{route('admin.incomes.destroy',['id'=>$income->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger fa fa-trash"></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection