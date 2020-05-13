<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Validation\Rule;

use App\Result;
use App\User;
use App\Poll;

class ResultsController extends Controller
{
	public function store(Request $request){
		$user = $request->user();
		$didSubmit = Result::where('user_id', $user->id)->where('poll_id', $request->pollID)->exists();
		
		if($didSubmit){
			return redirect()->back()->with('flash-alert', 'Poll response already submitted');
		}

		$request->validate([
			'answer' => ['required']
		]);
		
		$result = new Result;
		$result->answer= json_encode($request->answer);
		$result->poll()->associate($request->pollID);
		$result->user()->associate($user->id); 
		$result->save();
		
        return redirect("result/{$request->pollID}")->with([
            'flash-alert' => 'Your response has been added'
        ]);
	}
	
	public function show($id){
		$results = Result::select('answer')->where('poll_id', '=', $id)->get();
		$poll = Poll::where('id', '=', $id)->first();

		$tally = [];
		
		foreach ($results as $result){
			if(isset($tally[$result->answer])){
				$tally[$result->answer] += 1;
			}else{
				$tally[$result->answer] = 1;
			}
		}
		
		return view('results.show')->with([
			'tally' => $tally,
			'poll' => $poll
		]);
	}
}
