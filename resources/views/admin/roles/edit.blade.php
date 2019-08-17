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
					<h2 class="pageheader-title">Edit Role </h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Role</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 offset-xl-2 offset-md-2 offset-lg-2 offset-sm-2">
			<div class="card">
				<h5 class="card-header">Edit Role</h5>
				<div class="card-body">
					<form method="POST" action="{{ route('roles.update', $role->id) }}">
						@method('PATCH')
						@csrf

						<div class="form-group" style="display:none;">
							<input class="form-control" name="id" type="text" value="{{ old('name') ?? $role->id }}">
						</div>

						<div class="form-group">
							<label class="col-form-label" for="name">Name</label>
								<input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" type="text" placeholder="Role Name" value="{{ old('name') ?? $role->name }}">
						</div>
						
						@include('partials.error', ['name' => 'name'])
						
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Update Role</button>
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