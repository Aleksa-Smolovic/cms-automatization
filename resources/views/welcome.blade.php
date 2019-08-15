@extends('layouts.pocetna')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-10 col-md-10 col-lg-10 col-xl-10 offset-xs-1 offset-md-1 offset-lg-1 offset-xl-1">
			<h1 class="text-center mt-4 mb-3">Welcome</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, eaque quisquam quis eligendi enim totam. Illo autem at reiciendis suscipit, deleniti nostrum minus voluptatum tempore! Dolor est rerum recusandae, quod! Porro nemo deleniti provident, incidunt tenetur dolores aliquid. Dolores, quam, facere. Unde quo, expedita temporibus inventore delectus non id sunt doloribus dicta aspernatur, vel nisi dolore laborum nam modi nihil? Eum facere similique sequi tenetur omnis quaerat excepturi, natus officia quae perferendis accusamus saepe itaque minima amet consequatur, consequuntur animi sapiente quo sed rem. Blanditiis quibusdam, voluptates corporis perferendis, doloribus sed, ab id iure qui, magnam a optio ratione fugit dolores excepturi deserunt tempore aperiam adipisci esse ut voluptas hic. Fugiat fuga, debitis iusto molestias ad aut, necessitatibus nemo voluptatem praesentium rem deleniti deserunt magni natus nobis suscipit consequuntur voluptate id blanditiis. Est esse, officiis quas sequi, blanditiis magni, quo quod fuga quam aperiam maiores harum et, dolores rem assumenda.</p>
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