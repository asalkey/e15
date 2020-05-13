<!DOCTYPE html>
<html>
<head>
<title>Polled</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<link href="{{ asset('css/custom.css') }}" rel='stylesheet'>
</head>
<body class="{{$class}}">
 

<header>
	<nav class="navbar navbar-dark bg-dark">
		<div class="branding col">
			<a href="{{url('/')}}">
			 <img src="{{ asset('images/poll.png') }}">
			 <h1>Polled</h1>
			</a>
		</div>
		@if(Auth::user())
			<ul class="menu col">
				  <li><a href="{{ url('/') }}">All Polls</a></li>
				  <li><a href="{{ url('/user/polls') }}">My Polls</a></li>
				  <li><a href="{{ url('/poll/create') }}">Create a Poll</a></li>
				  <li><a href="{{ url('/user/profile')}}"> Profile </a></li>
				  <li>
				  <form method='post' id="logout" action="{{url('logout')}}">
						{{ csrf_field() }}
						<a href='#'  class='btn btn-outline-warning ' onClick='document.getElementById("logout").submit();'>Logout</a>
				  </form>
				  </li>
				</nav>
			</ul>
		@else
			<ul class="menu col">
				  <li><a dusk='login' class="btn btn-outline-warning" href="{{ url('/login') }}">Login</a></li>
				  <li><a dusk='register' class="btn btn-outline-warning" href="{{ url('/register') }}">Register </a></li>
			</ul>
		@endif
	</nav>
</header>

<main class="container">
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	
	@if(session('flash-alert'))
		<div class='alert alert-info'>
			{{ session('flash-alert') }}
		</div>
    @endif

	@yield('main')
</main>

</body>
</html>
