<?php

namespace App\Http\Controllers\Admin;

use App\PlanUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \App\PlanUser $planUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PlanUser $planUser)
    {
        return view('admin.plans.show',compact('planUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PlanUser $planUser
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanUser $planUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PlanUser $planUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanUser $planUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PlanUser $planUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PlanUser $planUser)
    {
        try {
            $planUser->delete();
        } catch (\Exception $e) {
        }

        alert()->success('اطلاعات با موفقیت حذف گردید.');

        return back();
    }
}
