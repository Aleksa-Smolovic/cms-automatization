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
				<h2 classs="pageheader-title">Pricing </h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pricing</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pageheader -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- pricing - one -->
	<!-- ============================================================== -->
	<div class="offset-xl-1 col-xl-10">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
				<div class="section-block">
					<h3>Influencer Pricing Table</h3>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-primary text-center p-3 ">
						<h4 class="mb-0 text-white"> Basic</h4>
					</div>
					<div class="card-body text-center">
						<h1 class="mb-1">$150</h1>
						<p>Per Month Plateform</p>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled bullet-check font-14">
							<li>Facebook, Instagram, Pinterest,Snapchat.</li>
							<li>Guaranteed follower growth for increas brand awareness.</li>
							<li>Daily updates on choose platforms</li>
							<li>Stronger customer service through daily interaction</li>
							<li>Monthly progress report</li>
							<li>1 Million Followers</li>
						</ul>
						<a href="#" class="btn btn-outline-secondary btn-block btn-lg">Get Started</a>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-info text-center p-3">
						<h4 class="mb-0 text-white"> Standard</h4>
					</div>
					<div class="card-body text-center">
						<h1 class="mb-1">$350</h1>
						<p>Per Month Plateform</p>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled bullet-check font-14">
							<li>Facebook, Instagram, Pinterest,Snapchat.</li>
							<li>Guaranteed follower growth for increas brand awareness.</li>
							<li>Daily updates on choose platforms</li>
							<li>Stronger customer service through daily interaction</li>
							<li>Monthly progress report</li>
							<li>2 Blog Post & 3 Social Post</li>
							<li>5 Millions Followers</li>
							<li>Growth Result</li>
						</ul>
						<a href="#" class="btn btn-secondary btn-block btn-lg">Get Started</a>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-primary text-center p-3">
						<h4 class="mb-0 text-white">Premium</h4>
					</div>
					<div class="card-body text-center">
						<h1 class="mb-1">$550</h1>
						<p>Per Month Plateform</p>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled bullet-check font-14">
							<li>Facebook, Instagram, Pinterest,Snapchat.</li>
							<li>Guaranteed follower growth for increas brand awareness.</li>
							<li>Daily updates on choose platforms</li>
							<li>Stronger customer service through daily interaction</li>
							<li>Monthly progress report & Growth Result</li>
							<li>4 Blog Post & 6 Social Post</li>
						</ul>
						<a href="#" class="btn btn-secondary btn-block btn-lg">Contact us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pricing - one  -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- pricing - two -->
	<!-- ============================================================== -->
	<div class="offset-xl-1 col-xl-10">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
				<div class="section-block">
					<h3>Feature Based Pricing</h3>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-white text-center p-4 ">
						<h3 class="mb-1">Professional</h3>
						<span class="mb-2 d-block">Best for solor users</span>
						<h1 class="mb-1"><span class="font-24">$</span><sub class="display-4">19</sub></h1>
						<p>a month per user</p>
						<a href="#" class="btn btn-secondary mb-2">Start 14 Day Free Trial</a>
						<p>$19 month to month</p>
					</div>
					<div class="card-body">
						<ul class="list-unstyled bullet-check font-14  mb-0">
							<li>Up to 10 Templates</li>
							<li>Unlimited Download & Access</li>
							<li>Support</li>
						</ul>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled font-14 ">
							<li>Integer in lorem dapibus</li>
							<li>Lacinia libero eget, faucibus leo.</li>
							<li>Quisque consectetur arcu</li>
							<li>Integer cursus metus quis</li>
							<li>Vivamus in velit at mauris imperdiet</li>
							<li>Nunc pellentesque facilisis finibus.</li>
						</ul>
						<a href="#" class="btn btn-outline-secondary btn-block btn-lg">Get Started</a>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-white text-center p-4 ">
						<h3 class="mb-1">Business</h3>
						<span class="mb-2 d-block">Best for small & medium businesses</span>
						<h1 class=" mb-1"><span class="font-24">$</span><sub class="display-4">19</sub></h1>
						<p>a month per user</p>
						<a href="#" class="btn btn-secondary mb-2">Start 14 Day Free Trial</a>
						<p>$39 month to month</p>
					</div>
					<div class="card-body">
						<ul class="list-unstyled bullet-check mb-0">
							<li>Up to 10 Templates</li>
							<li>Unlimited Download & Access</li>
							<li>Support</li>
						</ul>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled">
							<li>Integer in lorem dapibus</li>
							<li>Lacinia libero eget, faucibus leo.</li>
							<li>Quisque consectetur arcu</li>
							<li>Integer cursus metus quis</li>
							<li>Vivamus in velit at mauris imperdiet</li>
							<li>Nunc pellentesque facilisis finibus.</li>
						</ul>
						<a href="#" class="btn btn-outline-secondary btn-block btn-lg">Get Started</a>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-header bg-white text-center p-4 ">
						<h3 class="mb-1">Business</h3>
						<span class="mb-2 d-block">Best for small & medium businesses</span>
						<h1 class=" mb-1"> <sub class="display-4">Let's Talk</sub></h1>
						<p>For more details contact us.</p>
						<a href="#" class="btn btn-secondary mb-2">Contact us Now</a>
						<p>Ask to our expert.</p>
					</div>
					<div class="card-body">
						<ul class="list-unstyled bullet-check mb-0">
							<li>Up to 10 Templates</li>
							<li>Unlimited Download & Access</li>
							<li>Support</li>
						</ul>
					</div>
					<div class="card-body border-top">
						<ul class="list-unstyled">
							<li>Integer in lorem dapibus</li>
							<li>Lacinia libero eget, faucibus leo.</li>
							<li>Quisque consectetur arcu</li>
							<li>Integer cursus metus quis</li>
							<li>Vivamus in velit at mauris imperdiet</li>
							<li>Nunc pellentesque facilisis finibus.</li>
						</ul>
						<a href="#" class="btn btn-outline-secondary btn-block btn-lg">Get Started</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pricing - two  -->
	<!-- ============================================================== -->
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
@endsection