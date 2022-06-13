<?php

namespace App\Http\Controllers\Panel;


use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::whereHas('product', function ($q) {
            $q->where('user_id', auth()->user()->id);
        })->latest()->paginate(10);

        foreach ($comments as $comment){
            $comment->sellerView = 1;
            $comment->save();
        }

        return view(\request()->route()->getName(), [
            'comments' => $comments
        ]);
    }
}
