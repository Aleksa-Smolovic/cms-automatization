<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Lorem</title>

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
						<a class="nav-link d-inline-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							Logout <span class="sr-only">(current)</span></a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						@if(auth()->user()->role->id === 1)
							<a class="nav-link d-inline-block" href="{{ route('admin.index') }}">Admin <span class="sr-only">(current)</span></a>
						@endif
					@else
						<a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
					@endauth
				</li>
			</ul>
		</div>
		</div>
	</nav>
	
	@yield('content')

	
	@yield('js')

</body>
</html>