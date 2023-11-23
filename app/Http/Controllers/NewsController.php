<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        return view("news.index");
    }
    //
    public function storenews(Request $request): RedirectResponse
    {
        $request->validate([
            'title' =>'required',
            'description' => 'required|max:255',
        ]);

        $news = new News;
        $news->id = $request->id;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->image = $request->image;
        $news->user_id = auth()->user()->id;
        $news->save();
        return redirect("news")->with('success','You have post the news');
    }

    public function deletenews($id)
    {
        if (Auth::check()) {
            $news = News::findOrFail($id);
            $news->comments()->delete(); // Delete associated comments
            $news->delete();
            return back()->with('success','You have delete the news');
        }
    }

    public function showmy()
    {
        // Get the authenticated user
        $user = Auth::user();
        // Retrieve news articles associated with the authenticated user
        $news = $user->news;
        return view("news.profile", compact("news"));
    }

    public function showNews()
    {

        $news = News::orderBy('created_at', 'desc')->get();
        return view("news\index", compact("news"));
    }
}
