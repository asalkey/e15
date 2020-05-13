@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')

		<div class="d-flex justify-content-center">
			<div class="col-3"><h4>User Profile</h4></div>
			<div class="col-9 box">
			<form method="post" action="{{url('/user/profile/edit')}}">
				{{ csrf_field() }}
				{{  method_field('put') }}
				<div class="form-group">
					<input type="text" name="name" value="{{$user->name}}">
				</div>
				<div class="form-group">
					<input type="email" name="email" value="{{$user->email}}">
				</div>
				<input type="submit" value="Update">
			</form>
			</div>
		</div>
@endsection
