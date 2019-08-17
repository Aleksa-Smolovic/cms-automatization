@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection

@section('content')
<div class="container-fluid  dashboard-content">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Gauge</h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Charts</a></li>
							<li class="breadcrumb-item active" aria-current="page">Gauge</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pageheader -->
	<!-- ============================================================== -->

	<div class="row">
		<!-- ============================================================== -->
		<!-- gauge one  -->
		<!-- ============================================================== -->
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Gauge#1</h5>
				<div class="card-body">
					<canvas id="gauge1"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end gauge one  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- gauge two  -->
		<!-- ============================================================== -->
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Gauge#2</h5>
				<div class="card-body">
					<canvas id="gauge2"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end gauge two  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- gauge three  -->
		<!-- ============================================================== -->
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Gauge#3</h5>
				<div class="card-body">
					<canvas id="gauge3"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end gauge three  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- gauge four  -->
		<!-- ============================================================== -->
		<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Gauge#4</h5>
				<div class="card-body">
					<canvas id="gauge4"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end gauge four  -->
		<!-- ============================================================== -->
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/gauge/gauge.min.js') }}"></script>
<script src="{{ asset('assets/vendor/gauge/gauge.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection