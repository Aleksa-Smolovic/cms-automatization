@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/vector-map/jqvmap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="dashboard-finance">
	<div class="container-fluid dashboard-content">
		<!-- ============================================================== -->
		<!-- pageheader  -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header">
					<h3 class="mb-2">Finance Dashboard </h3>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Finance Dashboard Template</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end pageheader  -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="offset-xl-10 col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
				<form>
					<div class="form-group">
						<input class="form-control" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Total Income</h5>
					<div class="card-body">
						<div class="metric-value d-inline-block">
							<h1 class="mb-1">$5,79,000</h1>
						</div>
						<div class="metric-label d-inline-block float-right text-success font-weight-bold">
							<span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">25%</span>
						</div>
					</div>
					<div class="card-body bg-light p-t-40 p-b-40">
						<div id="sparkline-revenue"></div>
					</div>
					<div class="card-footer text-center bg-white">
						<a href="#" class="card-link">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Total Expences</h5>
					<div class="card-body">
						<div class="metric-value d-inline-block">
							<h1 class="mb-1">$1,79,000</h1>
						</div>
						<div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
							<span class="icon-circle-small icon-box-xs text-danger bg-danger-light"><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">15%</span>
						</div>
					</div>
					<div class="card-body text-center bg-light p-t-40 p-b-40">
						<div id="sparkline-revenue2"></div>
					</div>
					<div class="card-footer text-center bg-white">
						<a href="#" class="card-link">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Cash on Hand</h5>
					<div class="card-body">
						<div class="metric-value d-inline-block">
							<h1 class="mb-1">$79,000</h1>
						</div>
						<div class="metric-label d-inline-block float-right text-success font-weight-bold">
							<span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">25%</span>
						</div>
					</div>
					<div class="card-body bg-light p-t-40 p-b-40">
						<div id="sparkline-revenue3"></div>
					</div>
					<div class="card-footer text-center bg-white">
						<a href="#" class="card-link">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Net Profit Margin</h5>
					<div class="card-body">
						<div class="metric-value d-inline-block">
							<h1 class="mb-1">$92,000</h1>
						</div>
						<div class="metric-label d-inline-block float-right text-success font-weight-bold">
							<span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span> <span class="ml-1">25%</span>
						</div>
					</div>
					<div class="card-body bg-light p-b-40 p-t-40">
						<div id="sparkline-revenue4"></div>
					</div>
					<div class="card-footer text-center bg-white">
						<a href="#" class="card-link">View Details</a>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end revenue year  -->
		<!-- ============================================================== -->
		<div class="row">
			<!-- ============================================================== -->
			<!-- ap and ar balance  -->
			<!-- ============================================================== -->
			<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">AP and AR Balance
					</h5>
					<div class="card-body">
						<canvas id="chartjs_balance_bar"></canvas>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end ap and ar balance  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- gross profit  -->
			<!-- ============================================================== -->
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">% of Income Budget</h5>
					<div class="card-body">
						<div id="morris_gross" style="height: 272px;"></div>
					</div>
					<div class="card-footer bg-white">
						<p>Budget <span class="float-right text-dark">12,000.00</span></p>
						<p>Balance<span class="float-right text-dark">-2300.00 <span class="ml-2 text-secondary"><i class="fas fa-caret-up mr-1"></i>25%</span></span>
						</p>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end gross profit  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- profit margin  -->
			<!-- ============================================================== -->
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">% of Expenses Budget</h5>
					<div class="card-body">
						<div id="morris_profit" style="height: 272px;"></div>
					</div>
					<div class="card-footer bg-white">
						<p>Budget <span class="float-right text-dark">3500.00</span></p>
						<p>Balance <span class="float-right text-dark">230.00 <span class="ml-2 text-secondary"><i class="fas fa-caret-up mr-1"></i>25%</span></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end profit margin -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- earnings before interest tax  -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">EBIT (Earnings Before Interest & Tax)</h5>
					<div class="card-body">
						<div id="ebit_morris"></div>
						<div class="text-center">
							<span class="legend-item mr-3">
								<span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">EBIT (Earnings Before Interest & Tax)</span>
							</span>
							<p></p>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end earnings before interest tax  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- cost of goods  -->
			<!-- ============================================================== -->
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Cost of goods / Services <span class="float-right">1 Jan 2018 to 31 Dec 2018</span></h5>
					<div class="card-body">
						<div id="goodservice"></div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end cost of goods  -->
			<!-- ============================================================== -->
		</div>
		<div class="row">
			<!-- ============================================================== -->
			<!-- overdue invoices  -->
			<!-- ============================================================== -->
			<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Disputed vs Overdue Invoices</h5>
					<div class="card-body">
						<div class="ct-chart-invoice ct-golden-section"></div>
						<div class="text-center m-t-40">
							<span class="legend-item mr-3">
								<span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full "></i></span><span class="legend-text">Disputed Invoices</span>
							</span>
							<span class="legend-item mr-3">
								<span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full "></i></span><span class="legend-text">Overdue Invoices</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end overdue invoices  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- disputed invoices  -->
			<!-- ============================================================== -->
			<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Disputed Invoices</h5>
					<div class="card-body">
						<div class="ct-chart-line-invoice ct-golden-section"></div>
						<div class="text-center m-t-10">
							<span class="legend-item mr-3">
								<span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Disputed Invoices</span>
							</span>
							<span class="legend-item mr-3">
								<span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Avarage</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end disputed invoices  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- account payable age  -->
			<!-- ============================================================== -->
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Accounts Payable Age</h5>
					<div class="card-body">
						<div id="account" style="height: 300px;"></div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end account payable age  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- working capital  -->
			<!-- ============================================================== -->
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Working Capital <span class="float-right">1 Jan 2018 to 31 Dec 2018</span></h5>
					<div class="card-body">
						<div id="capital"></div>
						<div class="text-center m-t-10">
							<span class="legend-item mr-3">
								<span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Working Capital</span>
							</span>
							<p></p>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end working capital  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- inventory turnover  -->
			<!-- ============================================================== -->
			<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">Inventory Turnover</h5>
					<div class="card-body">
						<div class="ct-chart-inventory ct-golden-section"></div>
						<div class="text-center m-t-10">
							<span class="legend-item mr-3">
								<span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Turnover</span>
							</span>
							<span class="legend-item mr-3">
								<span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Target</span>
							</span>
							<span class="legend-item mr-3">
								<span class="fa-xs text-info mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
								<span class="legend-text">Acheived</span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end inventory turnover -->
		<!-- ============================================================== -->
	</div>
</div>
@endsection

@section('js')
<!-- jquery 3.3.1  -->
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<!-- bootstap bundle js -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- chart chartist js -->
<script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/chartist-bundle/Chartistjs.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist-plugin-threshold.js') }}"></script>
<!-- chart C3 js -->
<script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
<!-- chartjs js -->
<script src="{{ asset('assets/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/charts-bundle/chartjs.js') }}"></script>
<!-- sparkline js -->
<script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
<!-- dashboard finance js -->
<script src="{{ asset('assets/libs/js/dashboard-finance.js') }}"></script>
<!-- main js -->
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<!-- gauge js -->
<script src="{{ asset('assets/vendor/gauge/gauge.min.js') }}"></script>
<!-- morris js -->
<script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
<script src="{{ asset('assets/vendor/charts/morris-bundle/morrisjs.html') }}"></script>
<!-- daterangepicker js -->
<script src="{{ asset('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js') }}"></script>
@endsection