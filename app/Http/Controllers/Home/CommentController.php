<?php

namespace App\Http\Controllers\Home;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check())
            return redirect('/login');

        $request->validate([
            'message' => 'string',
            'product_id' => 'required|exists:products,id'
        ]);

        auth()->user()->comments()->create([
            'product_id' => $request->product_id,
            'message' => $request->message,
        ]);

        alert()->success('نظر شما با موفقیت ثبت شد.');

        return redirect()->back();
    }
}
