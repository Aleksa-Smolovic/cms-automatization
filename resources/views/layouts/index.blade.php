<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{!! csrf_token() !!}">

	@yield('css')

	<!-- css start -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}">
	<!-- css end -->

	<link rel="shortcut icon" href="{{ asset('img/favicon-32x32.png') }}" />

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>@yield('title', 'Administracija')</title>
</head>

<body>
	<div class="dashboard-main-wrapper">
		<div class="dashboard-header">
			<nav class="navbar navbar-expand-lg bg-white fixed-top">
				<a class="navbar-brand" href="/">Home</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto navbar-right-top">
						<li class="nav-item">
							<div id="custom-search" class="top-search-bar">
								<input class="form-control" type="text" placeholder="Search..">
							</div>
						</li>
						<li class="nav-item dropdown notification">
							<a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
							<ul class="dropdown-menu dropdown-menu-right notification-dropdown">
								<li>
									<div class="notification-title"> Notification</div>
									<div class="notification-list">
										<div class="list-group">
											<a href="#" class="list-group-item list-group-item-action active">
												<div class="notification-info">
													<div class="notification-list-user-img"><img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>
													<div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
														<div class="notification-date">2 min ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="list-group-item list-group-item-action">
												<div class="notification-info">
													<div class="notification-list-user-img"><img src="{{ asset('assets/images/avatar-3.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>
													<div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham </span>is now following you
														<div class="notification-date">2 days ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="list-group-item list-group-item-action">
												<div class="notification-info">
													<div class="notification-list-user-img"><img src="{{ asset('assets/images/avatar-4.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>
													<div class="notification-list-user-block"><span class="notification-list-user-name">Monaan Pechi</span> is watching your main repository
														<div class="notification-date">2 min ago</div>
													</div>
												</div>
											</a>
											<a href="#" class="list-group-item list-group-item-action">
												<div class="notification-info">
													<div class="notification-list-user-img"><img src="{{ asset('assets/images/avatar-5.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>
													<div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span>accepted your invitation to join the team.
														<div class="notification-date">2 min ago</div>
													</div>
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<div class="list-footer"> <a href="#">View all notifications</a></div>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown connection">
							<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
							<ul class="dropdown-menu dropdown-menu-right connection-dropdown">
								<li class="connection-list">
									<div class="row">
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/github.png') }}" alt=""> <span>Github</span></a>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/dribbble.png') }}" alt=""> <span>Dribbble</span></a>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/dropbox.png') }}" alt=""> <span>Dropbox</span></a>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/bitbucket.png') }}" alt=""> <span>Bitbucket</span></a>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/mail_chimp.png') }}" alt=""><span>Mail chimp</span></a>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
											<a href="#" class="connection-item"><img src="{{ asset('assets/images/slack.png') }}" alt=""> <span>Slack</span></a>
										</div>
									</div>
								</li>
								<li>
									<div class="conntection-footer"><a href="#">More</a></div>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown nav-user">
							<a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('assets/images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle"></a>
							<div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
								<div class="nav-user-info">
									<h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
									<span class="status"></span><span class="ml-2">Available</span>
								</div>
								<a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
								<a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="nav-left-sidebar sidebar-dark">
			<div class="menu-list">
				<nav class="navbar navbar-expand-lg navbar-light">
					<a class="d-xl-none d-lg-none" href="#">Dashboard</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav flex-column">
							<li class="nav-divider">
								Admin
							</li>
							<ul class="nav flex-column">

								@include('layouts.sidebar-items')

								<li class="nav-item">
									<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>

							</ul>

							<li class="nav-divider">
								Menu
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
								<div id="submenu-1" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
											<div id="submenu-1-2" class="collapse submenu" style="">
												<ul class="nav flex-column">
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.index') }}">E Commerce Dashboard</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.products') }}">Product List</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.product-single') }}">Product Single</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.product-checkout') }}">Product Checkout</a>
													</li>
												</ul>
											</div>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('dashboard.finance') }}">Finance</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('dashboard.sales') }}">Sales</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
											<div id="submenu-1-1" class="collapse submenu" style="">
												<ul class="nav flex-column">
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.influencer') }}">Influencer</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.influencer-finder') }}">Influencer Finder</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="{{ route('dashboard.influencer-profile') }}">Influencer Profile</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>UI Elements</a>
								<div id="submenu-2" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.cards') }}">Cards <span class="badge badge-secondary">New</span></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.general') }}">General</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.carousel') }}">Carousel</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.list-group') }}">List Group</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.typography') }}">Typography</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.accordions') }}">Accordions</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('uielements.tabs') }}">Tabs</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Chart</a>
								<div id="submenu-3" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.c3-charts') }}">C3 Charts</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.chartist-charts') }}">Chartist Charts</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.chart') }}">Chart</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.morris') }}">Morris</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.sparkline') }}">Sparkline</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('chart.guage') }}">Guage</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Forms</a>
								<div id="submenu-4" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('forms.form-elements') }}">Form Elements</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('forms.form-validation') }}">Parsely Validations</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('forms.multiselect') }}">Multiselect</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('forms.datepicker') }}">Date Picker</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('forms.bootstrap-select') }}">Bootstrap Select</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Tables</a>
								<div id="submenu-5" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('tables.general-tables') }}">General Tables</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('tables.data-tables') }}">Data Tables</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-divider">
								Features
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i> Pages </a>
								<div id="submenu-6" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.blank-page') }}">Blank Page</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.blank-page-header') }}">Blank Page Header</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.login-forma') }}">Login</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.page-404') }}">404 page</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.sign-up') }}">Sign up Page</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.forgot-password') }}">Forgot Password</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.pricing') }}">Pricing Tables</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.timeline') }}">Timeline</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.calendar') }}">Calendar</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.sortable-nestable-lists') }}">Sortable/Nestable List</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.widgets') }}">Widgets</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.media-object') }}">Media Objects</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.cropper-image') }}">Cropper</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('pages.color-picker') }}">Color Picker</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-inbox"></i>Apps <span class="badge badge-secondary">New</span></a>
								<div id="submenu-7" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('apps.inbox') }}">Inbox</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('apps.email-details') }}">Email Detail</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('apps.email-compose') }}">Email Compose</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('apps.message-chat') }}">Message Chat</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Icons</a>
								<div id="submenu-8" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-fontawesome') }}">FontAwesome Icons</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-material') }}">Material Icons</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-simple-lineicon') }}">Simpleline Icon</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-themify') }}">Themify Icon</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-flag') }}">Flag Icons</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('icons.icon-weather') }}">Weather Icon</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-map-marker-alt"></i>Maps</a>
								<div id="submenu-9" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('maps.map-google') }}">Google Maps</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('maps.map-vector') }}">Vector Maps</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu Level</a>
								<div id="submenu-10" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#">Level 1</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
											<div id="submenu-11" class="collapse submenu" style="">
												<ul class="nav flex-column">
													<li class="nav-item">
														<a class="nav-link" href="#">Level 1</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="#">Level 2</a>
													</li>
												</ul>
											</div>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">Level 3</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<div class="dashboard-wrapper">

			@yield('content')

			<div class="footer" style="position:fixed; bottom:0; width:100%; z-index: 1">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="text-md-right footer-links d-none d-sm-block">
								<a href="javascript: void(0);">About</a>
								<a href="javascript: void(0);">Support</a>
								<a href="javascript: void(0);">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- js start -->
	<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
	<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
	<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>

	<script src="{{ asset('admin_css_js/ajaxSubmitForm.js') }}"></script>
	<script src="{{ asset('admin_css_js/delete.js') }}"></script>
	<script src="{{ asset('admin_css_js/ajaxFetch.js') }}"></script>

	<script src="{{ asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js') }}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js') }}"></script>
	<script src="{{ asset('https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/datepicker/moment.js') }}"></script>
	<script src="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
	<script src="{{ asset('assets/vendor/datepicker/datepicker.js') }}"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
	<script src="{{ asset('admin_css_js/summernote.js') }}"></script>
	<!-- js end -->

	<script>
		$('.table').DataTable({
			"ordering": false,
			"language": {
				"url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Croatian.json"
			}
		});
	</script>

	@yield('js')

</body>

</html>