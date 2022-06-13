<?php

namespace App\Http\Controllers\Admin;

use App\PackageList;
use App\PlanUser;
use App\VisitCart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class VisitCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitCarts = new VisitCart();
        $visitCarts = $visitCarts->latest()->paginate(10);

        return view(\request()->route()->getName())->with([
            'visitCarts' => $visitCarts
        ]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required|string',
            'plan_id' => 'required'
        ]);

//        $visitCart = new VisitCart();
//        $visitCart->user_id = auth()->user()->id;
//        $visitCart->numeric_id = $request->numeric_id;
//        $visitCart->email = $request->email;
//        $visitCart->description = $request->description;
//        $visitCart->save();

        $client = new Client();

        $data['password'] = Hash::make($data['password']);

        $response = $client->post("http://nbpkart.ir/api/register", [
            'form_params' => $data
        ]);

        $response = json_decode($response->getBody(), true);
        if ((isset($response['status']) && $response['status'] == 400) || (isset($response['errors']))) {
            return back()->withErrors([
                'mobile' => $response['errors']['mobile']
            ]);
        }

        $plan = PlanUser::where('id', $request->plan_id)->first();
        if ($plan->used) {
            alert()->error('این شغل قبلا استفاده شده است.');
            return redirect('user/myPackages');
        }

        if (auth()->user()->id == $plan->user_id) {
            $plan->used = 1;
            $plan->save();
        }

        alert()->success('ثبت نام با موفقیت انجام شد');
        return redirect('user/myPackages');
    }

    public function seen(VisitCart $visitCart)
    {
        $visitCart->update([
            'seen' => 1
        ]);

        alert()->success('با موفقیت تغییر یافت');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\VisitCart $visitCart
     * @return \Illuminate\Http\Response
     */
    public function show(VisitCart $visitCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VisitCart $visitCart
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitCart $visitCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VisitCart $visitCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitCart $visitCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VisitCart $visitCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitCart $visitCart)
    {
        try {
            $visitCart->delete();
        } catch (\Exception $e) {
        }

        alert()->success('با موفقیت حذف شد');
        return redirect()->back();
    }
}
