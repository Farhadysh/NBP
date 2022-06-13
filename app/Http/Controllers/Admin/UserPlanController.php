<?php

namespace App\Http\Controllers\Admin;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPlanController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check())
                if (auth()->user()->level == 'user' ||
                    auth()->user()->level == 'seller') {
                    return redirect('/');
                } else {
                    return $next($request);
                }

            return redirect('/');
        });
    }

    public function index()
    {
        return view('homePages.plans', [
            'plans' => Plan::where('active', true)->get()
        ]);
    }

    public function store($id)
    {
        if ($id) {
            session(['plan_id' => $id]);

            return redirect()->route('user.packageList.index');
        }

        return redirect()->back();
    }
}
