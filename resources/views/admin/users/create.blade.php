@extends('layouts.index')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/inputmask/css/inputmask.css') }}"/>
@endsection

@section('content')
<div class="container-fluid">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Add User </h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="admin" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add User</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 offset-xl-1 offset-md-1 offset-lg-1 offset-sm-1">
			<div class="card">
				<h5 class="card-header">Add User</h5>
				<div class="card-body">
					<form method="POST" action="{{ route('users.store') }}">
						@csrf
						
						<div class="form-group">
							<label class="col-form-label" for="first_name">First Name</label>
								<input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') }}">
						</div>
						
						@include('partials.error', ['name' => 'first_name'])

						<div class="form-group">
							<label class="col-form-label" for="last_name">Last Name</label>
							<input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') }}">
						</div>
						
						@include('partials.error', ['name' => 'last_name'])

						<div class="form-group">
							<label class="col-form-label" for="username">Username</label>
							<input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Username" value="{{ old('username') }}">
						</div>

						@include('partials.error', ['name' => 'username'])

						<div class="form-group">
							<label class="col-form-label" for="email">Email</label>
							<input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
						</div>
						
						@include('partials.error', ['name' => 'email'])

						<div class="form-group">
							<label class="col-form-label" for="role_id">Role</label>
							<div class="row">
								<div class="col-xs-2 col-md-2 col-lg-2 col-xl-2">
									<select class="form-control" name="role_id">
										@foreach($roles as $role)
											<option value="{{ $role->id }}"
												{{ old('role_id') == $role->id ? 'selected' : '' }}
											>
												{{ ucfirst($role->name) }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-form-label" for="password">Password | <small>Optional Field</small></label>
							<input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" type="password" placeholder="Password"> {{-- value="{{ old('password') ?? $user->password }}" --}}
						</div>
						
						@include('partials.error', ['name' => 'password'])
						
						<div class="form-group">
							<label class="col-form-label" for="password_confirmation">Confirm Password</label>
							<input class="form-control" name="password_confirmation" type="password" placeholder="Password"> {{-- value="{{ old('password_confirmation') ?? $user->password }}" --}}
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Add User</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="{{ asset('assets/vendor/inputmask/js/jquery.inputmask.bundle.js') }}"></script>
@endsection