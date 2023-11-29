<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("news.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function like(Request $request)
    {
        $like = new Like;
        $user = Auth::user();

        $newsId = $request->news_id;
        $like->news_id = $newsId;

        $like->user_id = $user->id;
        $like->like_id = $request->like_id;

        $like->save();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function unlike($id)
    {
        if (Auth::check()) {

            $unlike = Like::where([['user_id', auth()->user()->id], ['news_id', $id]])
                ->delete();
                if ($unlike) {
                    return back()->with('success', 'You have unfollow this person');
    
                    //if not
                } else {
                    return redirect('/profile/' . auth()->user()->username);
                };
        };
    }
}
