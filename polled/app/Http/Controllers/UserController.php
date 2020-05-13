<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Poll;
use App\User;

class UserController extends Controller
{
    public function showPolls(){
		$user = Auth::user();
	
        $polls = Poll::where('user_id', '=', $user->id)->get();

        return view('user.polls')->with([
            'polls' => $polls
        ]);
    }
    
    public function showProfile(){
		$user = Auth::user();
		
        return view('user.profile')->with([
            'user' => $user
        ]);
    }
    
    public function updateProfile(Request $request){
		
		$user = Auth::user();
		$profile = User::where('id', '=', $user->id)->first();
		
		$request->validate([
			'name' => 'required|min:1',
			'email' => 'required|email',
		]);
		
		$profile->name = $request->name;
		$profile->email = $request->email;
		 
		$profile->save();
		
        return redirect("/user/profile")->with([
            'flash-alert' => 'Your profile has been updated'
        ]);
    }
}
