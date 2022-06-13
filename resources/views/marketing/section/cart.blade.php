@if(Auth::check())
    <div class="modal right fade" id="myModal2"
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel2">سبد خرید</h4>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-bottom: 200px!important;">
                    <div class="col-12 modal_cart">
                        @if($total_cart == 0)
                            <div class="p-3 text-center">
                                <img src="{{asset('image/empty-cart.png')}}" width="100%">
                                <h6 class="my-3 text-muted">هیچ کالایی در سبد خرید وجود ندارد!</h6>
                            </div>
                        @else
                            @foreach($carts as $cart)
                                <div class="row img-modal">
                                    <div class="row img-modal mt-3 mt-5 parent">
                                        <img src="{{asset($cart->product->images->first()->image ?? "")}}" width="100"
                                             height="90"
                                             class="col-4 p-1">
                                        <div class="col-8 m-0">
                                            <div class="d-flex justify-content-between">
                                                <p>{{$cart->product->name}}</p>
                                                <a href=""
                                                   class="btn btn-outline-secondary btn-sm fa fa-times rounded h-75 delete"
                                                   data-id="{{$cart->id}}"></a>
                                            </div>
                                            <label class="pb-3 m-0 small"> قیمت : </label>
                                            @if(auth()->check() && auth()->user()->hasPlan($cart->product->categories()->first()->id))
                                                <span class="pb-3 m-0 small">{{number_format($cart->product->discount - $cart->product->commission())}}تومان </span>
                                            @else
                                                <span class="pb-3 m-0 small">{{number_format($cart->product->discount)}}تومان </span>
                                            @endif
                                            <br>
                                            <label class="pb-3 m-0 small text-success"> قیمت کل : </label>

                                            @if(auth()->check() && auth()->user()->hasPlan($cart->product->categories()->first()->id))
                                                <span class="pb-3 m-0 small text-success total_price">{{number_format(($cart->product->discount - $cart->product->commission()) * $cart->qty)}} تومان </span>
                                            @else
                                                <span class="pb-3 m-0 small text-success total_price">{{number_format($cart->product->discount * $cart->qty)}} تومان </span>
                                            @endif


                                            <div class="d-flex m-0 align-items-center text-size pb-3 dd">
                                                <label> تعداد : </label>
                                                <button class="btn btn-outline-dark fa fa-plus border-0 mx-0 p"></button>
                                                <input class="text1 input_count form-control mx-0 col-3 rounded-circle text-center border-0 count"
                                                       data-id="{{$cart->id}}" value="{{$cart->qty}}"
                                                       data-title="{{$cart->product->limit_count}}">
                                                <button class="fa fa-minus btn btn-outline-dark border-0 mx-0 m"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="fixed-bottom bg-white p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <p>جمع کل خرید</p>
                            <p class="text-success total_cart">{{number_format($total_cart)}} تومان</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="small">محدودیت وزن (10,000گرم)</p>
                            <p class="text-success total_weight">{{$total_weight}} </p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('shopping.orders.create')}}" name="submit" class="btn btn-info col-12">ادامه
                                ثبت سفارش</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif