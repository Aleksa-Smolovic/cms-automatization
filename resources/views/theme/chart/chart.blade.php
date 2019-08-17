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
				<h2 class="pageheader-title">Chart.js</h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Charts</a></li>
							<li class="breadcrumb-item active" aria-current="page">Chart.js</li>
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
		<!-- line chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Line Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_line"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end line chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- bar chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Bar Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_bar"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end bar chart  -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!-- radar chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Radar Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_radar"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end radar chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- polar chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Polar Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_polar"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end polar chart  -->
		<!-- ============================================================== -->
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!-- pie chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Pie Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_pie"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end pie chart  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- doughnut chart  -->
		<!-- ============================================================== -->
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			<div class="card">
				<h5 class="card-header">Doughnut Charts</h5>
				<div class="card-body">
					<canvas id="chartjs_doughnut"></canvas>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end doughnut chart  -->
		<!-- ============================================================== -->
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/charts-bundle/chartjs.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection