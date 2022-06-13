<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view(\request()->route()->getName());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'mobile' => 'required|unique:users,mobile,' . auth()->user()->id,
            'birth_date' => 'nullable',
            'national_code' => 'nullable',
            'password' => 'nullable|confirmed',
            'bank_id' => 'nullable',
            'nickname' => 'nullable|string'
        ]);

        $data = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'birth_date' => $request->birth_date,
            'national_code' => $request->national_code,
            'bank_id' => $request->bank_id,
            'nickname' => $request->nickname
        ];

        if ($request->password)
            $data['password'] = bcrypt($request->password);

        auth()->user()->update($data);

        alert()->success('اطلاعات با موفقیت ویرایش شد.');

        return redirect()->back();

    }
}
