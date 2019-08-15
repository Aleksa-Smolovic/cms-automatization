<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Lorem</title>
	{{-- <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}"> --}}

	@yield('css')

	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<style>
		.container {
			max-width: 1340px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
		<a class="navbar-brand" href="/">Lorem Ipsum</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				@guest
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('register') }}">Register <span class="sr-only">(current)</span></a>
					</li>
				@endguest
				<li class="nav-item active">
					@auth
						<a class="nav-link" href="{{ route('logout') }}">Logout <span class="sr-only">(current)</span></a>
					@else
						<a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
					@endauth
				</li>
				<li class="nav-item dropdown">
					@auth
		       	@if(auth()->user()->role->id === 1)
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Pages
			        </a>
			        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="{{ route('admin.index') }}">Admin</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
			          <a class="dropdown-item" href="{{ route('users.create') }}">Add User</a>
			          <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
			        </div>
		        @endif
	        @endauth
	      </li>
			</ul>
		</div>
		</div>
	</nav>
	
	@yield('content')

	{{-- <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js') }}"></script> --}}
	
	@yield('js')

</body>
</html>