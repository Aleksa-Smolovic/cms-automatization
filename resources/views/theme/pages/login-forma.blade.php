@extends('layouts.empty')

@section('css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<style>
	html,
	body {
		height: 100%;
	}
	body {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
	}
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
	<div class="card ">
		<div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="../assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
				</div>
				<div class="form-group">
					<input class="form-control form-control-lg" id="password" type="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
			</form>
		</div>
		<div class="card-footer bg-white p-0  ">
			<div class="card-footer-item card-footer-item-bordered">
				<a href="#" class="footer-link">Create An Account</a></div>
				<div class="card-footer-item card-footer-item-bordered">
					<a href="#" class="footer-link">Forgot Password</a>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end login page  -->
	<!-- ============================================================== -->
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
@endsection