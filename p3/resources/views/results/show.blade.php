@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')
	<div class="d-flex justify-content-center">
		<div class="col-3"><h4>poll results</h4></div>
		<div class="col-9 box">
			<p>{{$poll->question}}</p>
			<ul>
				@foreach($tally as $option => $count)
					<li>{{$option}} - {{$count}} </li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
