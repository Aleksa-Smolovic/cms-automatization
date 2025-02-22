@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/summernote/css/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/cs') }}s/materialdesignicons.min.css">
@endsection

@section('content')
<div class="container-fluid">
	<aside class="page-aside">
		<div class="aside-content">
			<div class="aside-header">
				<button class="navbar-toggle" data-target=".aside-nav" data-toggle="collapse" type="button"><span class="icon"><i class="fas fa-caret-down"></i></span></button><span class="title">Mail Service</span>
				<p class="description">Service description</p>
			</div>
			<div class="aside-compose"><a class="btn btn-lg btn-secondary btn-block" href="#">Compose Email</a></div>
			<div class="aside-nav collapse">
				<ul class="nav">
					<li><a href="#"><span class="icon"><i class="fas fa-fw fa-inbox"></i></span>Inbox<span class="badge badge-primary float-right">8</span></a></li>
					<li class="active"><a href="#"><span class="icon"><i class="fas fa-fw  fa-envelope"></i></span>Sent Mail</a></li>
					<li><a href="#"><span class="icon"><i class="fas fa-fw fa-briefcase"></i></span>Important<span class="badge badge-secondary float-right">4</span></a></li>
					<li><a href="#"><span class="icon"><i class="fas fa-fw fa-file"></i></span>Drafts</a></li>
					<li><a href="#"><span class="icon"><i class="fas fa-fw fa-star"></i></span>Tags</a></li>
					<li><a href="#"><span class="icon"><i class="fas fa-fw fa-trash"></i></span>Trash</a></li>
				</ul><span class="title">Labels</span>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="#"><i class="m-r-10 mdi mdi-label text-secondary"></i>
					Important </a></li>
					<li><a href="#">
						<i class="m-r-10 mdi mdi-label text-primary"></i> Business   </a></li>
						<li><a href="#"> <i class="m-r-10 mdi mdi-label text-brand"></i>
						Inspiration </a></li>
					</ul>
				</div>
			</div>
		</aside>
		<div class="main-content container-fluid p-0">
			<div class="email-head">
				<div class="email-head-title">Compose new message<span class="icon mdi mdi-edit"></span></div>
			</div>
			<div class="email-compose-fields">
				<div class="to">
					<div class="form-group row pt-0">
						<label class="col-md-1 control-label">To:</label>
						<div class="col-md-11">
							<select class="js-example-basic-multiple" multiple="multiple">
								<option value="Yellow" selected="selected">Yellow</option>
								<option value="White">White</option>
								<option value="Blue" selected="selected">Blue</option>
							</select>
						</div>
					</div>
				</div>
				<div class="to cc">
					<div class="form-group row pt-2">
						<label class="col-md-1 control-label">Cc</label>
						<div class="col-md-11">
							<select class="js-example-basic-multiple" multiple="multiple">
								<option value="Alabama">Alabama</option>
								<option value="Alaska" selected="selected">Alaska</option>
								<option value="Melbourne">Melbourne</option>
								<option value="Victoria" selected="selected">Victoria</option>
								<option value="Newyork">Newyork</option>
							</select>
						</div>
					</div>
				</div>
				<div class="subject">
					<div class="form-group row pt-2">
						<label class="col-md-1 control-label">Subject</label>
						<div class="col-md-11">
							<input class="form-control" type="text">
						</div>
					</div>
				</div>
			</div>
			<div class="email editor">
				<div class="col-md-12 p-0">
					<div class="form-group">
						<label class="control-label sr-only" for="summernote">Descriptions </label>
						<textarea class="form-control" id="summernote" name="editordata" rows="6" placeholder="Write Descriptions"></textarea>
					</div>
				</div>
				<div class="email action-send">
					<div class="col-md-12 ">
						<div class="form-group">
							<button class="btn btn-primary btn-space" type="submit"><i class="icon s7-mail"></i> Send</button>
							<button class="btn btn-secondary btn-space" type="button"><i class="icon s7-close"></i> Cancel</button>
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
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({ tags: true });
	});
</script>
<script>
	$(document).ready(function() {
		$('#summernote').summernote({
			height: 300
		});
	});
</script>
@endsection