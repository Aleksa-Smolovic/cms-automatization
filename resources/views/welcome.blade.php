@extends('layouts.website')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-10 col-md-10 col-lg-10 col-xl-10 offset-xs-1 offset-md-1 offset-lg-1 offset-xl-1">
			<h1 class="text-center mt-4 mb-3">New Website</h1>
			<p>This is the starting point of an awesome website! :)</p>
		</div>
	</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection