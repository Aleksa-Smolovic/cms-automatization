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
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header" id="top">
				<h2 class="pageheader-title">All Users </h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Admin</a></li>
							<li class="breadcrumb-item active" aria-current="page">All Users</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 offset-xl-2 offset-md-2 offset-lg-2 offset-sm-2">
		<div class="card">
			<h5 class="card-header">Edit User</h5>
			<div class="card-body">
				<form method="POST" action="{{ route('users.update', compact('user')) }}">
					@method('PATCH')
					@csrf
					
					<div class="form-group">
						<label class="col-form-label" for="first_name">First Name</label>
							<input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') ?? $user->first_name }}">
					</div>
					
					@include('partials.error', ['name' => 'first_name'])

					<div class="form-group">
						<label class="col-form-label" for="last_name">Last Name</label>
						<input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') ?? $user->last_name }}">
					</div>
					
					@include('partials.error', ['name' => 'last_name'])

					<div class="form-group">
						<label class="col-form-label" for="username">Username</label>
						<input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Username" value="{{ old('username') ?? $user->username }}">
					</div>

					@include('partials.error', ['name' => 'username'])

					<div class="form-group">
						<label class="col-form-label" for="email">Email</label>
						<input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="email" placeholder="Email" value="{{ old('email') ?? $user->email }}">
					</div>
					
					@include('partials.error', ['name' => 'email'])

					<div class="form-group">
						<label class="col-form-label" for="role_id">Role</label>
						<div class="row">
							<div class="col-xs-3 col-md-3 col-lg-3 col-xl-3">
								<select class="form-control" name="role_id">
									@foreach($roles as $role)
										<option value="{{ $role->id }}"
											@if(!empty(old('role_id')))
												{{ $role->id == old('role_id') ? 'selected' : '' }}
											@else
												{{ $role->id == $user->role_id ? 'selected' : '' }}
											@endif
										>
											{{ old('role_id')->name ?? ucfirst($role->name) }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-form-label" for="password">Password | <small>Optional</small></label>
						<input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" type="password" placeholder="Password"> {{-- value="{{ old('password') ?? $user->password }}" --}}
					</div>
					
					@include('partials.error', ['name' => 'password'])
					
					<div class="form-group">
						<label class="col-form-label" for="password_confirmation">Confirm Password</label>
						<input class="form-control" name="password_confirmation" type="password" placeholder="Password"> {{-- value="{{ old('password_confirmation') ?? $user->password }}" --}}
					</div>
					
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Edit User</button>
					</div>
				</form>
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