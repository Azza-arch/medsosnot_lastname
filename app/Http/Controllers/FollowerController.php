<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function index()
    {
        return view("news.profile");
    }

    public function storefollow(Request $request)
    {
        $follow = new Follows;
        $follow->user_id = $request->id;
        $follow->following_id = $request->id;
        $follow->save();
        return back()
            ->with('success', 'You are now following this user');
        //
    }

    /**
     * Display the specified resource.
     */
    public function shows()
    {
        $user = Auth::user();
        $followers = $user->followers;
        return view('news.profile',compact("followers"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $unfollow = Follows::where([['user_id', auth()->user()->id], ['following_id', $id]])
                ->delete();
            if ($unfollow) {
                return back();
            } else {
                return redirect('/profile/' . auth()->user()->username);
            };
        }
    }
}
