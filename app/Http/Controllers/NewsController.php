<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // Display the news index page
    public function index()
    {
        return view("news.index");
    }

    // Store a new news article
    public function storenews(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:255',
        ]);

        // Create a new News instance
        $news = new News;
        
        // Assign values to News attributes from the request
        $news->title = $request->title;
        $news->description = $request->description;
        $news->image = $request->image;
        
        // Assign the authenticated user's id to the news article
        $news->user_id = auth()->user()->id;

        // Save the news article to the database
        $news->save();

        // Redirect with a success message
        return redirect("news")->with('success', 'You have posted the news');
    }

    // Delete a news article
    public function deletenews($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Find the news article by its id
            $news = News::findOrFail($id);
            
            // Delete associated comments
            $news->comments()->delete();
            
            // Delete the news article
            $news->delete();

            // Redirect back with a success message
            return back()->with('success', 'You have deleted the news');
        }
    }

    // Show news articles associated with the authenticated user
    public function showmy()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Retrieve news articles associated with the authenticated user
        $news = $user->news;
        
        // Return the profile view with the associated news articles
        return view("news.profile", compact("news"));
    }

    // Show all news articles
    public function showNews()
    {
        // Retrieve all news articles in descending order by creation date
        $news = News::orderBy('created_at', 'desc')->get();
        
        // Return the news index view with the retrieved news articles
        return view("news.index", compact("news"));
    }
}
