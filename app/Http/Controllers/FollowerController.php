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

    //follow user function
    public function storefollow(Request $request)
    {
        //defining
        $follow = new Follows;

        //check for authentication of the user
        $user = Auth::user();

        $follow->user_id = $user->id;
        $follow->following_id = $request->id;

        //follow a user
        $follow->save();

        return back()
            ->with('success', 'You are now following this user');
        //
    }

    //unfollow user
    public function destroy($id)
    {
        //check for authentication of the user
        if (Auth::check()) {

            //unfollow
            $unfollow = Follows::where([['user_id', auth()->user()->id], ['following_id', $id]])
                ->delete();
                
            //if unfollow then it goes back
            if ($unfollow) {
                return back()->with('success', 'You have unfollow this person');

                //if not
            } else {
                return redirect('/profile/' . auth()->user()->username);
            };
        }
    }
}
