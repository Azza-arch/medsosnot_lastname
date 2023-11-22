<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view("news.comment");
    }
    //
    public function storecomment(Request $request)
    {
        $comment = new Comment;
        $comment->id = $request->id;
        $newsId = $request->news_id;
        $comment->news_id = $newsId;
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back()->with("success", "");
    }

    public function show($news_id)
    {
        $news = News::findOrFail($news_id);
        $comments = $news->comments;
        return view("news.comment", compact("news", "comments"));
    }
}
