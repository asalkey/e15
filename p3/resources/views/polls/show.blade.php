@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')
	<div class="d-flex justify-content-center">
		<div class="col-3"><h4>Poll</h4></div>
		<div class="col-9 box">
			<p>{{$poll->question}}</p>
			<form method="post" action="{{url('/result')}}">
				{{csrf_field()}}
				@foreach(json_decode($poll->options,true) as $option)
					<div class="row">
						@if($poll->ismultiple)
							<input type="checkbox" name="answer[]" value={{$option}}>
						@else
							<input type="radio" name="answer[]" value={{$option}}>
						@endif
							<label>{{ $option}}</label>
					</div>
				@endforeach
				<input type="hidden" value="{{$poll->id}}" name="pollID">
				<input type="submit" value="submit">
			</form>
		</div>
	</div>
@endsection
