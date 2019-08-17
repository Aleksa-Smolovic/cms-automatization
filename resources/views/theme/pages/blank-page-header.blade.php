@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection

@section('content')
 <div class="container-fluid dashboard-content">
 	<!-- ============================================================== -->
 	<!-- pageheader -->
 	<!-- ============================================================== -->
 	<div class="row">
 		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
 			<div class="page-header">
 				<h2 class="pageheader-title">Blank Pageheader </h2>
 				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
 				<div class="page-breadcrumb">
 					<nav aria-label="breadcrumb">
 						<ol class="breadcrumb">
 							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
 							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
 							<li class="breadcrumb-item active" aria-current="page">Blank Pageheader</li>
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
 		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
 			<h3 class="text-center">Content goes here!</h3>
 		</div>
 	</div>
 </div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection