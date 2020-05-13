@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')
	<div class="d-flex justify-content-center">
		<div class="col-3"><h4>Your Polls</h4></div>
		@if(count($polls) == 0) 
			No polls have been added yet...
		@else
		<div class="col-9">
			<ul>
				@foreach($polls as $poll)
				<li>
					<a href="{{ url('/poll',['id'=> $poll->id])}}">
					   {{ $poll->question}}
					</a>
					<br/>
					<form method="post" action="{{url('/user/poll/delete')}}">
						{{ method_field('delete') }}
						{{ csrf_field() }}
						<input type="hidden" value="{{$poll->id}}" name="pollID" >
						<input type='submit' value='Delete poll' class='btn btn-outline-danger'>
					</form>
				</li>
				<hr>
				@endforeach
			</ul>
		@endif
	</div>
@endsection
