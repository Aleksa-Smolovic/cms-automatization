@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
@endsection

@section('content')
<div class="container-fluid  dashboard-content">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Morris.js </h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Charts</a></li>
							<li class="breadcrumb-item active" aria-current="page">Morris.js</li>
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
		<!--area chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Area Chart</h5>
				<div class="card-body">
					<div id="morris_area"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end area chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!--line chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Line Chart</h5>
				<div class="card-body">
					<div id="morris_line"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end line chart  -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!--bar chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Bar Chart</h5>
				<div class="card-body">
					<div id="morris_bar"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end bar chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!--stacked chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Stacked Bars </h5>
				<div class="card-body">
					<div id="morris_stacked"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!--end stacked chart  -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!-- upadating chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Updating data </h5>
				<div class="card-body">
					<div id="morris_udateing"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end upadating chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- donut chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Donut Chart </h5>
				<div class="card-body">
					<div id="morris_donut"></div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end donut chart  -->
		<!-- ============================================================== -->
	</div>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/morris-bundle/Morrisjs.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection