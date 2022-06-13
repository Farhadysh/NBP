@extends('homePages.master')

@section('content')
    <!--modal-->
    <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="myModalLabel2">پکیج های انتخاب شده</h5>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 modal_cart" style="margin-bottom: 250px">
                        @foreach($packageCarts as $packageCart)
                            <div class="row img-modal mt-3 mt-5 parent">
                                <img src="{{$packageCart->image}}" width="100" height="90" class="col-4 p-1">
                                <div class="col-8 m-0 ">
                                    <p>{{$packageCart->name}}</p>
                                    <label class="pb-3 m-0 small"> امتیاز : </label>
                                    <span class="pb-3 m-0 small">{{$packageCart->total_points}}</span>
                                    <div class="d-flex m-0 align-items-center text-size pb-3">
                                        <label> تعداد : </label>
                                        <button class="btn btn-outline-dark fa fa-plus border-0 p" {{$packageCart->package_id != 1 && $packageCart->package_id != 2 && $packageCart->package_id != 3  ? 'hidden' : ''}}></button>
                                        <input class="text1 input_count form-control mx-0 col-3 rounded-circle text-center border-0 count"
                                               data-id="{{$packageCart->id}}" value="{{$packageCart->count}}">
                                        <button class="fa fa-minus btn btn-outline-dark border-0 m" {{$packageCart->package_id != 1 && $packageCart->package_id != 2 && $packageCart->package_id != 3 ? 'hidden' : ''}}></button>
                                    </div>
                                    <div class=" d-flex text-danger align-items-center text-size">
                                        <label> حذف : </label>
                                        <a class="btn btn-outline-danger btn-sm fa fa-trash py-1 px-2 delete"
                                           data-id="{{$packageCart->id}}" data-title="{{$packageCart->package_id}}"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="fixed-bottom margin-modal">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="small">جمع امتیاز</p>
                            <p class="text-success total_points">{{$total_points}}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="small">امتیاز مورد نیاز برای خرید پکیج</p>
                            <p class="text-success">25 امتیاز</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p>مبلغ پکیج</p>
                            <p class="text-success">436,000 تومان</p>
                        </div>
                        <div class="d-flex justify-content-center em">
                            <a href="/admin/packageCart/adminStore" class="btn btn-info col-12 buy_package">خرید پکیج</a>
                        </div>
                    </div>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="d-flex  align-items-center justify-content-center" style="margin-top: 100px">
        <span class="line"></span>
        <span class="mx-2 best_sellers">خدمات</span>
        <span class="line"></span>
    </div>
    <div class="mx-auto col-md-9 p-0 col-sm-11 col-10 mt-2">
        <div class="row justify-content-center">
            @foreach($packages->where('category_id',0) as $package)
                <div class="col-md-4 col-sm-6 p-1">
                    <span class="text-dark bg-white rounded position-absolute p-2 package-counter font-weight-bold border border-warning">{{$package->points}}</span>
                    <figure class="snip1466">
                        <img class="img_media mb-4 pb-3" src="{{$package->image}}"
                             alt="sample52">
                        <div class="check-box">
                            <input type="radio" id="check{{$package->id}}" class="check"
                                   name="check{{$package->id}}"
                                   data-id="{{$package->id}}" {{in_array($package->id,$packageCarts->pluck('package_id')->toArray()) ? 'checked' : ''}}>
                            <label for="check{{$package->id}}" class="container my-auto">
                                <div class="check_label">
                                    <div class="effect"></div>
                                </div>
                                <p class="text-warning my-auto">{{$package->name}}</p>
                            </label>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>

    <div class=" mt-5 d-flex  align-items-center justify-content-center">
        <span class="line"></span>
        <span class="mx-2 best_sellers">سبد های کالا</span>
        <span class="line"></span>
    </div>

    <div class="col-md-10 col-sm-11 mx-auto mt-5">
        <div class="row justify-content-center ">
            @foreach($packages->where('category_id','!=',0) as $package)
                <div class="col-md-3 col-sm-6 col-10  my-3">
                    <span class="text-dark bg-white rounded position-absolute p-2 package-counter font-weight-bold border border-warning">{{$package->points}}</span>
                    <a class="image-body-home back-edit2">
                        <p class="text-header2">{{$package->name}}</p>
                        <img src="{{$package->image}}" alt="" class="shadow-home">
                    </a>
                    <div class="check-box1">
                        <input type="radio" id="check{{$package->id}}" class="check" name="check{{$package->id}}"
                               data-id="{{$package->id}}" {{in_array($package->id,$packageCarts->pluck('package_id')->toArray()) ? 'checked' : ''}}>
                        <label for="check{{$package->id}}" class="container my-auto">
                            <div class="check_label-box">
                                <div class="effect"></div>
                            </div>
                            <p class="text-warning my-auto text-check">سبد {{$package->name}}</p>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a data-toggle="modal" data-target="#myModal2" id="goTop" title="تعداد پکیج ">
        <i class="cart_count px-2 small position-absolute font-weight-bold"
           style="top: 30px;right: 40px;color: rgb(255,9,10)">{{$packageCarts->count()}}</i><span
                class="text-warning border-0 px-3 py-3 fa fa-shopping-cart fa-2x btn-lg"> </span>
    </a>
@endsection