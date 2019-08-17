@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css') }}">
@endsection

@section('content')
<div class="container-fluid dashboard-content">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Vector Map </h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Maps</a></li>
							<li class="breadcrumb-item active" aria-current="page">Vector Map</li>
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
		<!-- world map -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">World Map</h5>
				<div class="card-body">
					<div id="world-map-markers" style="height: 450px;"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end world map -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!--india -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">India</h5>
				<div class="card-body">
					<div id="india" style="height: 450px;"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end india -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!--USA -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">USA</h5>
				<div class="card-body">
					<div id="usa" style="height: 450px;"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end USA -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Australia map -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Australia Map</h5>
				<div class="card-body">
					<div id="australia" style="height: 450px;"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end Australia map -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!-- UK map -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Uk Map</h5>
				<div class="card-body">
					<div id="uk" style="height: 450px;"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- UK map -->
		<!-- ============================================================== -->
	</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="{{ asset('assets/libs/js/gmaps.min.js') }}"></script>
<!-- jvactormap js -->
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-in-mill.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-uk-mill-en.js') }}"></script>
<script src="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-au-mill.js') }}"></script>
<script src="{{ asset('assets/libs/js/jvectormap.custom.js') }}"></script>
@endsection

