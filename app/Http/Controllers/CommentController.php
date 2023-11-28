<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view("news.comment");
    }
    //
    public function storecomment(Request $request):RedirectResponse
    {
        $request->validate([
            'comment'=>'required',
        ]);

        $comment = new Comment;
        $newsId = $request->news_id;
        $comment->news_id = $newsId;
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back();
    }

    public function show($news_id)
    {
        $news = News::findOrFail($news_id);
        $comments = $news->comments;
        return view("news.comment", compact("news", "comments"));
    }
}
