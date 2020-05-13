@extends('layouts.application',['class' => (Auth::user()) ? 'loggedin' : 'loggedout'])

@section('main')
	@include('polls._form')
@endsection
