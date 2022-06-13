<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\PackageCart;
use App\PackageList;
use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->level == 'user') {
            return redirect('/');
        } else {

            if (session()->has('plan_id')) {
                $plan = Plan::find(session('plan_id'));

                $packages = new Package();
                $packages = $packages->where('active', 1)->get();

                $packageCarts = new PackageCart();
                $packageCarts = $packageCarts->where('user_id', auth()->user()->id)->get();

                $total_points = 0;
                foreach ($packageCarts as $packageCart) {
                    $total_points += $packageCart->total_points * $packageCart->count;
                }

                return view('homePages.packages')->with([
                    'packages' => $packages,
                    'packageCarts' => $packageCarts,
                    'total_points' => $total_points,
                    'plan' => $plan,
                ]);
            } else {
                return redirect('/plans');
            }
        }
    }

    public function indexAdmin($id)
    {
        session(['user_id' => $id]);

        $packages = new Package();
        $packages = $packages->where('active', 1)->get();

        $packageCarts = new PackageCart();
        $packageCarts = $packageCarts->where('user_id', $id)->get();

        $total_points = 0;
        foreach ($packageCarts as $packageCart) {
            $total_points += $packageCart->total_points * $packageCart->count;
        }

        return view('admin.adminPackage.packages')->with([
            'packages' => $packages,
            'packageCarts' => $packageCarts,
            'total_points' => $total_points
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\PackageList $packageList
     * @return \Illuminate\Http\Response
     */
    public function show(PackageList $packageList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PackageList $packageList
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageList $packageList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PackageList $packageList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageList $packageList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PackageList $packageList
     * @return void
     */
    public function destroy(PackageList $packageList)
    {
        //
    }

}