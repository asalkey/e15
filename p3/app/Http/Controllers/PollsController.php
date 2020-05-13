<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Result;
use Illuminate\Support\Facades\Auth;

class PollsController extends Controller
{
    public function index()
    {
		$polls = Poll::orderByDesc('created_at')->get();
		
		return view('polls.index')->with([
            'polls' => $polls
        ]);
    }
    
    public function show($id){
        $poll = Poll::where('id', '=', $id)->first();

        return view('polls.show')->with([
            'poll' => $poll
        ]);
    }
    
    public function store(Request $request){
		$user = $request->user();
		
		$request->validate([
			'question' => 'required',
			'option' => 'required|array|min:1',
			'option.*' => 'required|string|min:1'
		]);
		
		$poll = new Poll;
		$poll->options = json_encode($request->option);
		$poll->question = $request->question;
		$poll->ismultiple = false;
		$poll->user()->associate($user->id); 
		$poll->save();
	
        return redirect("/user/polls")->with([
            'flash-alert' => 'Poll created'
        ]);
    }
    
    public function edit(){
        
    }
    
    public function create(){
        return view('polls.create');
    }
    
    public function update(){
    }
    
    public function destroy(Request $request){
        $user = Auth::user();
        
		$poll = Poll::where('id', '=', $request->pollID)->where('user_id', '=', $user->id)->first();
		$poll->results()->delete();
        $poll->delete();

        return redirect('/user/polls')->with([
            'flash-alert' => 'Poll deleted'
        ]);
    }
}
