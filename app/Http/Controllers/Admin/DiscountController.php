<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use App\DiscountCart;
use App\DisPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class DiscountController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $discounts = Discount::query();

        $discounts = $discounts->latest()->paginate(20);

        return view(\request()->route()->getName(), [
            'discounts' => $discounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(\request()->route()->getName());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $data['image'] = $this->uploadImage($data['image'], "discounts");

        Discount::create($data);

        alert()->success('تخفیف با موفقیت ذخیره گردید.');

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Discount $discount)
    {
        return view(\request()->route()->getName(), [
            'discount' => $discount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Discount $discount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'image' => 'required|image',
            'active' => 'required'
        ]);

        if ($data['image']) {
            $data['image'] = $this->uploadImage($data['image'], "discounts");
            if (file_exists(public_path($discount->image)))
                unlink(public_path($discount->image));
        } else {
            $data['image'] = $discount->image;
        }

        $discount->update($data);

        alert()->success('تخفیف با موفقیت ویرایش گردید.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Discount $discount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->active = !$discount->getOriginal('active');
        $discount->save();

        alert()->success('با موفقیت تغییر وضعیت پیدا کرد.');

        return redirect()->back();

        alert()->success('تخفیف با موفقیت حذف گردید.');

        return back();
    }

    public function payment(Discount $discount)
    {
        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $discount->price;
        $Description = "پرداخت کارت تخفیف {$discount->name}";
        $Email = 'nbpacademy@gmail.com';
        $Mobile = auth()->user()->mobile ?? "";
        $CallbackURL = 'http://www.nbpbook.ir/user/discounts/callback';

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

            DisPayment::create([
                'discount_id' => $discount->id,
                'user_id' => auth()->user()->id,
                'price' => $discount->price,
                'Authority' => $result->Authority,
            ]);

            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
        } else {
            alert()->error('خطا در پرداخت.');

            return redirect('/');
        }
    }

    public function callback()
    {
        if (!\request()->has('Authority')) {
            return redirect('/');
        }

        $Authority = request('Authority');
        $payment = DisPayment::where('Authority', $Authority)->first();

        if (!$payment) {
            return redirect('/');
        }

        auth()->loginUsingId($payment->user_id);

        $MerchantID = 'aeeee87e-8f7b-11e9-bd33-000c29344814';
        $Amount = $payment->price;

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

                auth()->loginUsingId($payment->user_id);

                alert()->success('پکیج با موفقیت ثبت شد');

                DisPayment::where('Authority', $Authority)->update([
                    'status' => 'success',
                    'RefId' => $result->RefID
                ]);

                return redirect('user/homePage');

            } else {
                auth()->loginUsingId($payment->user_id);
                alert()->error('پرداخت نا موفق.');

                DisPayment::where('Authority', $Authority)->update([
                    'status' => 'failed',
                ]);

                return redirect('user/homePage');
            }

        } else {
            auth()->loginUsingId($payment->user_id);
            alert()->info('پرداخت با موفقیت لغو گردید.');

            DisPayment::where('Authority', $Authority)->update([
                'status' => 'failed',
            ]);
            return redirect('user/homePage');
        }
    }

    public function paymentLists()
    {
        $discounts = new DisPayment();

        if ($family = \request('')) {
            $discounts = $discounts->whereHas('user', function ($q) use ($family) {
                $q->where('family', 'LIKE', "{$family}");
            });
        }

        $discounts = $discounts->latest()->paginate(25);

        return view('admin.discounts.payments', [
            'discounts' => $discounts
        ]);
    }
}
