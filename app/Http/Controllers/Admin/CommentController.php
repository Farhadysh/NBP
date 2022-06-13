<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::latest()->paginate(10);

        return view(\request()->route()->getName(), [
            'comments' => $comments
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        alert()->success('نظر با موفقیت پاک شد.');

        return redirect()->back();
    }

    public function approved(Comment $comment)
    {
        $comment->approved = 1;
        $comment->save();
        alert()->success('نظر با موفقیت تایید شد.');

        return redirect()->back();

    }
}
