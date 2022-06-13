<?php

namespace App\Http\Controllers\Panel;

use App\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $checkouts = auth()->user()->checkouts()->latest();

        $data = [
            'total' => $checkouts->sum('price'),
            'total_page' => 0,
        ];

        $checkouts = $checkouts->paginate(25);

        $data['total_page'] = $checkouts->sum('price');

        return view(\request()->route()->getName(), [
            'checkouts' => $checkouts,
            'data' => $data
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
        $request->validate([
            'price' => 'required|integer|min:50000|max:' . auth()->user()->wallet
        ]);

        if (auth()->user()->checkouts()->where('status', 'init')->exists()) {
            alert()->error('یک درخواست در صف بررسی موجود میباشد.');
            return redirect()->back();
        }

        auth()->user()->checkouts()->create([
            'price' => $request->price
        ]);

        alert()->success('درخواست با وفقیت ارسال شد.');

        return redirect()->route('panel.checkouts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Checkout $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Checkout $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Checkout $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Checkout $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
