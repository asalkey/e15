@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')
	<div class="d-flex justify-content-center">
		<h4>Current Polls</h4>
		@if(count($polls) == 0) 
			No polls have been added yet...
		@else
		<ul>
			@foreach($polls as $poll)
			<li>
				<a href="{{url('/poll',['id'=>$poll->id])}}">
				   {{ $poll->question}}
				</a>
			</li>
			<hr>
			@endforeach
		</ul>
		@endif
	</div>
@endsection
