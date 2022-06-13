<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntroducingController extends Controller
{
    public function index()
    {
        $positions = auth()->user()->positions->pluck('visitor_code');

        $users = User::whereHas('positions', function ($q) use ($positions) {
            $q->whereIn('Reference_code', $positions);
        })->get();

        return view('homePages.Introducing', [
            'users' => $users
        ]);
    }
}
