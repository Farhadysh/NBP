<?php

namespace App\Http\Controllers\Admin;

use App\DiscountCart;
use App\PackageList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class DiscountCartController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discountCarts = new DiscountCart();
        $discountCarts = $discountCarts->latest()->paginate(10);


        return view('admin.discountCarts.index')->with([
            'discountCarts' => $discountCarts
        ]);
    }

    public function seen(DiscountCart $discountCart)
    {
        $discountCart->seen = 1;
        $discountCart->save();

        alert()->success('انجام شد');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws \SoapFault
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|numeric',
            'bank_id' => 'required|numeric',
            'bank_name' => 'required',
        ]);

//        session(['name' => $request->name]);
//        session(['last_name' => $request->last_name]);
//        session(['mobile' => $request->mobile]);
//        session(['bank_id' => $request->bank_id]);
//        session(['bank_name' => $request->bank_name]);

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = 25000;
        $Description = 'پرداخت هزینه صدور کارت تخفیف';
        $Email = 'nbpacademy@gmail.com';
        $Mobile = $request->mobile;
        $CallbackURL = 'http://www.nbpmarketing.ir/user/discount/payment';

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

        if ($result->Status == 100) {
            DiscountCart::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'bank_id' => $request->bank_id,
                'bank_name' => $request->bank_name,
                'Authority' => $result->Authority,
                'price' => $Amount,
                'status' => 'init'
            ]);

            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
        } else {
            alert()->error('خطا در پرداخت.');

            return redirect('/');
        }
    }

    public function payment()
    {
        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = 25000;
        $Authority = \request('Authority');

        $discount = new DiscountCart();
        $discount = $discount->where('Authority', $Authority)->first();

        auth()->loginUsingId($discount->user_id);

        if (\request('Status') == 'OK') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {


                $user = auth()->user();
                $user->wallet += 15000;
                $user->save();

                PackageList::whereHas('planUser', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->where('package_id', 2)->first()->decrement('count', 1);

                $discount->status = 'success';
                $discount->RefID = 45;
                $discount->save();

                alert()->success('درخواست با موفقیت ارسال شد');
                return redirect('/user/homePage');

            } else {
                $discount->status = 'failed';
                $discount->save();

                alert()->error('خطا در پرداخت.');

                return redirect('/');
            }
        } else {
            $discount->status = 'failed';
            $discount->save();

            alert()->error('خطا در پرداخت.');

            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\DiscountCart $discountCart
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountCart $discountCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\DiscountCart $discountCart
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountCart $discountCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\DiscountCart $discountCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscountCart $discountCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\DiscountCart $discountCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountCart $discountCart)
    {
        //
    }
}
