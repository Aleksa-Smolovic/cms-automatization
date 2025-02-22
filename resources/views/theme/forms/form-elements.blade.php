@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/inputmask/css/inputmask.css') }}"/>
@endsection

@section('content')
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="col-xl-10">
			<!-- ============================================================== -->
			<!-- pageheader  -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="page-header" id="top">
						<h2 class="pageheader-title">Form Elememnts </h2>
						<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
						<div class="page-breadcrumb">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
									<li class="breadcrumb-item active" aria-current="page">Form Elements</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end pageheader  -->
			<!-- ============================================================== -->
			<div class="page-section" id="overview">
				<!-- ============================================================== -->
				<!-- overview  -->
				<!-- ============================================================== -->
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<h2>Overview</h2>
						<p class="lead">Nam pulvinar interdum turpis a mattis. Etiam augue leo, mollis a massa sagittis, egestas pretium risus. Aliquam auctor nibh mauris, at fringilla elit lobortis sodales. Praesent volutpat felis et placerat elementum. </p>
						<ul class="list-unstyled arrow">
							<li> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
							<li>Mauris bibendum massa ut porttitor congue.</li>
							<li>Morbi condimentum magna eget facilisis accumsan.</li>
							<li>Proin euismod eros nec libero efficitur, a dapibus mauris condimentum. </li>
						</ul>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- end overview  -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- basic form  -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block" id="basicform">
						<h3 class="section-title">Basic Form Elements</h3>
						<p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
					</div>
					<div class="card">
						<h5 class="card-header">Basic Form</h5>
						<div class="card-body">
							<form>
								<div class="form-group">
									<label for="inputText3" class="col-form-label">Input Text</label>
									<input id="inputText3" type="text" class="form-control">
								</div>
								<div class="form-group">
									<label for="inputEmail">Email address</label>
									<input id="inputEmail" type="email" placeholder="name@example.com" class="form-control">
									<p>We'll never share your email with anyone else.</p>
								</div>
								<div class="form-group">
									<label for="inputText4" class="col-form-label">Number Input</label>
									<input id="inputText4" type="number" class="form-control" placeholder="Numbers">
								</div>
								<div class="form-group">
									<label for="inputPassword">Password</label>
									<input id="inputPassword" type="password" placeholder="Password" class="form-control">
								</div>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile">
									<label class="custom-file-label" for="customFile">File Input</label>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Example textarea</label>
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
								</div>
							</form>
						</div>
						<div class="card-body border-top">
							<h3>Sizing</h3>
							<form>
								<div class="form-group">
									<label for="inputSmall" class="col-form-label">Small</label>
									<input id="inputSmall" type="text" value=".form-control-sm" class="form-control form-control-sm">
								</div>
								<div class="form-group">
									<label for="inputDefault" class="col-form-label">Default</label>
									<input id="inputDefault" type="text" value="Default input" class="form-control">
								</div>
								<div class="form-group">
									<label for="inputLarge" class="col-form-label">Large</label>
									<input id="inputLarge" type="text" value=".form-control-lg" class="form-control form-control-lg">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end basic form  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- select options  -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block" id="select">
						<h3 class="section-title">Select</h3>
						<p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
					</div>
					<div class="card">
						<h5 class="card-header">Select Example</h5>
						<div class="card-body">
							<form>
								<div class="form-group">
									<label for="input-select">Example Select</label>
									<select class="form-control" id="input-select">
										<option>Choose Example</option>
									</select>
								</div>
							</form>
						</div>
						<div class="card-body border-top">
							<h3>Sizing</h3>
							<form>
								<div class="form-group">
									<select class="form-control form-control-sm">
										<option>Large select</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control">
										<option>Default select</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control form-control-lg">
										<option>Large select</option>
									</select>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end select options  -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- checkboxes and radio -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="checkboxradio">
					<div class="section-block">
						<h3 class="section-title">Checkboxes and Radios</h3>
						<p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
					</div>
					<div class="card">
						<h5 class="card-header">Checkboxes and Radios</h5>
						<div class="card-body">
							<h4>Default (stacked)</h4>
							<form>
								<label class="custom-control custom-checkbox">
									<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Default Checkbox</span>
								</label>
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" disabled><span class="custom-control-label">Default Checkbox </span>
								</label>
								<h4>Inline Checkbox</h4>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" checked="" class="custom-control-input"><span class="custom-control-label">Option 1</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Option 2</span>
								</label>
								<label class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" class="custom-control-input"><span class="custom-control-label">Option 3</span>
								</label>
							</form>
						</div>
						<div class="card-body border-top">
							<h4>Radio (Stacked)</h4>
							<form>
								<label class="custom-control custom-radio">
									<input type="radio" name="radio-stacked" checked="" class="custom-control-input"><span class="custom-control-label">Default Radio</span>
								</label>
								<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="radio-inline" class="custom-control-input" disabled><span class="custom-control-label">Default Radio</span>
								</label>
								<h5>Inline Radio</h5>
								<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="radio-inline" checked="" class="custom-control-input"><span class="custom-control-label">Option 1</span>
								</label>
								<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="radio-inline" class="custom-control-input"><span class="custom-control-label">Option 2</span>
								</label>
								<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" name="radio-inline" class="custom-control-input"><span class="custom-control-label">Option 3</span>
								</label>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end checkboxes and radio -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- validation state -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block" id="validation">
						<h3 class="section-title">Validation States</h3>
						<p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more.</p>
					</div>
					<div class="card">
						<h5 class="card-header">Validation States</h5>
						<div class="card-body">
							<form>
								<label for="validationServer01">First name</label>
								<input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="First name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
								<label class="col-form-label" for="validationCustom02">Error</label>
								<input type="text" required="" class="form-control is-invalid" id="validationCustom02">
								<div class="invalid-feedback">
									Please provide a valid text.
								</div>
							</form>
						</div>
						<div class="card-body border-top">
							<form>
								<h5>Checkbox</h5>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input is-valid" id="customControlValidation1" required>
									<label class="custom-control-label" for="customControlValidation1">Success</label>
								</div>
								<div class="custom-control custom-checkbox was-validated">
									<input type="checkbox" class="custom-control-input is-invalid" id="customControlValidation2" required>
									<label class="custom-control-label" for="customControlValidation2">Error</label>
								</div>
								<h5>Radio</h5>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input is-valid" id="customControlValidation3" name="radio-stacked" required>
									<label class="custom-control-label" for="customControlValidation3">Success</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input is-invalid" id="customControlValidation4" name="radio-stacked" required>
									<label class="custom-control-label" for="customControlValidation4">Error</label>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end validation state -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- input groups -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block" id="inputgroup">
						<h3 class="section-title">Input Groups</h3>
						<p>Easily extend form controls by adding text, buttons, or button groups on either side of textual inputs, custom selects, and custom file inputs.</p>
					</div>
					<div class="card">
						<h5 class="card-header">Input Groups</h5>
						<div class="card-body">
							<h4>Input Text</h4>
							<div class="form-group">
								<div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">@</span></span>
									<input type="text" placeholder="Username" class="form-control">
								</div>
								<div class="input-group mb-3">
									<input type="text" class="form-control">
									<div class="input-group-append"><span class="input-group-text">.00</span></div>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend"><span class="input-group-text">$</span></div>
									<input type="text" class="form-control">
									<div class="input-group-append"><span class="input-group-text">.00</span></div>
								</div>
							</div>
						</div>
						<div class="card-body border-top">
							<h4>Input Sizes</h4>
							<div class="form-group">
								<h5>Small </h5>
								<div class="input-group input-group-sm mb-3">
									<div class="input-group-prepend"><span class="input-group-text">@</span></div>
									<input type="text" placeholder="Username" class="form-control">
								</div>
								<h5>Default</h5>
								<div class="input-group mb-3">
									<div class="input-group-prepend"><span class="input-group-text">@</span></div>
									<input type="text" placeholder="Username" class="form-control">
								</div>
								<h5>Large</h5>
								<div class="input-group input-group-lg mb-3">
									<div class="input-group-prepend"><span class="input-group-text">@</span></div>
									<input type="text" placeholder="Username" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-body border-top">
							<h4>Checkboxes and radios</h4>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
											</label>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="custom-control custom-radio">
												<input type="radio" class="custom-control-input"><span class="custom-control-label"></span>
											</label>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label class="col-form-label">Button Addons</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control">
									<div class="input-group-append">
										<button type="button" class="btn btn-primary">Go!</button>
									</div>
								</div>
								<div class="input-group mb-3">
									<input type="text" class="form-control">
									<div class="input-group-append be-addon">
										<button type="button" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle">Dropdown</button>
										<div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
											<div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
										</div>
									</div>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend be-addon">
										<button tabindex="-1" type="button" class="btn btn-secondary">Dropdown</button>
										<button tabindex="-1" data-toggle="dropdown" type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"><span class="sr-only">Toggle Dropdown</span></button>
										<div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
											<div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end input groups -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- inputmask -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block" id="inputmask">
						<h3 class="section-title">Input Mask</h3>
						<p>Easily extend form controls by adding text, buttons, or button groups on either side of textual inputs, custom selects, and custom file inputs.</p>
					</div>
					<div class="card">
						<div class="card-body">
							<h4>Input Text</h4>
							<div class="form-group">
								<label>Date Mask <small class="text-muted">dd/mm/yyyy</small></label>
								<input type="text" class="form-control date-inputmask" id="date-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Phone <small class="text-muted">(999) 999-9999</small></label>
								<input type="text" class="form-control phone-inputmask" id="phone-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>International Number <small class="text-muted">+19 999 999 999</small></label>
								<input type="text" class="form-control international-inputmask" id="international-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Phone / xEx <small class="text-muted">(999) 999-9999 / x999999</small></label>
								<input type="text" class="form-control xphone-inputmask" id="xphone-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Purchase Order <small class="text-muted">aaaa 9999-****</small></label>
								<input type="text" class="form-control purchase-inputmask" id="purchase-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Credit Card Number <small class="text-muted">9999 9999 9999 9999</small></label>
								<input type="text" class="form-control cc-inputmask" id="cc-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>SSN <small class="text-muted">999-99-9999</small></label>
								<input type="text" class="form-control ssn-inputmask" id="ssn-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>ISBN <small class="text-muted">999-99-999-9999-9</small></label>
								<input type="text" class="form-control isbn-inputmask" id="isbn-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Percentage <small class="text-muted">99%</small></label>
								<input type="text" class="form-control percentage-inputmask" id="percentage-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Currency<small class="text-muted">$9999</small>
								</label>
								<input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Decimal using RadixPoint<small class="text-muted">123.654658</small>
								</label>
								<input type="text" class="form-control decimal-inputmask" id="decimal-mask" placeholder="" style="text-align: right;">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Email<small class="text-muted">xxx@xxx.xxx</small>
								</label>
								<input type="text" class="form-control email-inputmask" id="email-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>Optional masks<small class="text-muted">(99) 9999[9]-9999</small>
								</label>
								<input type="text" class="form-control optional-inputmask" id="optional-mask" placeholder="">
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label>RTL attribute<small class="text-muted">dd/mm/yyyy</small>
								</label>
								<input type="text" class="form-control date-inputmask" id="date-mask-rtl" placeholder="Enter Date" style="text-align: right;">
							</div>
						</div>
						<div class="card-body border-top">
							<h4>Checkboxes and radios</h4>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input"><span class="custom-control-label"></span>
											</label>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="custom-control custom-radio">
												<input type="radio" class="custom-control-input"><span class="custom-control-label"></span>
											</label>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-body border-top">
							<div class="form-group">
								<label class="col-form-label">Button Addons</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control">
									<div class="input-group-append">
										<button type="button" class="btn btn-primary">Go!</button>
									</div>
								</div>
								<div class="input-group mb-3">
									<input type="text" class="form-control">
									<div class="input-group-append be-addon">
										<button type="button" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle">Dropdown</button>
										<div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
											<div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
										</div>
									</div>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend be-addon">
										<button tabindex="-1" type="button" class="btn btn-secondary">Dropdown</button>
										<button tabindex="-1" data-toggle="dropdown" type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"><span class="sr-only">Toggle Dropdown</span></button>
										<div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
											<div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
										</div>
									</div>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end  inputmask -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- switch component -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="section-block">
						<h3 class="section-title">Switch Component</h3>
						<p>Easily extend form controls by adding text, buttons, or button groups on either side of textual inputs, custom selects, and custom file inputs.</p>
					</div>
					<div class="card" id="switchcontent">
						<h5 class="card-header">Switch Component</h5>
						<div class="card-body">
							<form action="#" style="border-radius: 0px;">
								<div class="form-group row">
									<label class="col-12 col-sm-3 col-form-label text-sm-right">Sizes</label>
									<div class="col-12 col-sm-8 col-lg-6 pt-1">
										<div class="switch-button switch-button-xs">
											<input type="checkbox" checked="" name="switch12" id="switch12"><span>
												<label for="switch12"></label></span>
											</div>
											<div class="switch-button switch-button-sm">
												<input type="checkbox" checked="" name="switch13" id="switch13"><span>
													<label for="switch13"></label></span>
												</div>
												<div class="switch-button">
													<input type="checkbox" checked="" name="switch14" id="switch14"><span>
														<label for="switch14"></label></span>
													</div>
													<div class="switch-button switch-button-lg">
														<input type="checkbox" checked="" name="switch15" id="switch15"><span>
															<label for="switch15"></label></span>
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-form-label text-sm-right">Success</label>
													<div class="col-12 col-sm-8 col-lg-6 pt-1">
														<div class="switch-button switch-button-success">
															<input type="checkbox" checked="" name="switch16" id="switch16"><span>
																<label for="switch16"></label></span>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-12 col-sm-3 col-form-label text-sm-right">Warning</label>
														<div class="col-12 col-sm-8 col-lg-6 pt-1">
															<div class="switch-button switch-button-warning">
																<input type="checkbox" checked="" name="switch17" id="switch17"><span>
																	<label for="switch17"></label></span>
																</div>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-12 col-sm-3 col-form-label text-sm-right">Danger</label>
															<div class="col-12 col-sm-8 col-lg-6 pt-1">
																<div class="switch-button switch-button-danger">
																	<input type="checkbox" checked="" name="switch18" id="switch18"><span>
																		<label for="switch18"></label></span>
																	</div>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-12 col-sm-3 col-form-label text-sm-right">Yes/No Labels</label>
																<div class="col-12 col-sm-8 col-lg-6 pt-1">
																	<div class="switch-button switch-button-yesno">
																		<input type="checkbox" checked="" name="switch19" id="switch19"><span>
																			<label for="switch19"></label></span>
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
											<!-- ============================================================== -->
											<!-- end switch component -->
											<!-- ============================================================== -->
										</div>
										<!-- ============================================================== -->
										<!-- sidenavbar -->
										<!-- ============================================================== -->
										<div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
											<div class="sidebar-nav-fixed">
												<ul class="list-unstyled">
													<li><a href="#overview" class="active">Overview</a></li>
													<li><a href="#basicform">Basic Form</a></li>
													<li><a href="#select">Select</a></li>
													<li><a href="#checkboxradio">Checkbox & Radio</a></li>
													<li><a href="#validation">Validation state</a></li>
													<li><a href="#inputgroup">Input Groups</a></li>
													<li><a href="#inputmask">Inputmask</a></li>
													<li><a href="#switchcontent">Switch Content</a></li>
													<li><a href="#top">Back to Top</a></li>
												</ul>
											</div>
										</div>
										<!-- ============================================================== -->
										<!-- end sidenavbar -->
										<!-- ============================================================== -->
									</div>
								</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="{{ asset('assets/vendor/inputmask/js/jquery.inputmask.bundle.js') }}"></script>
<script>
	$(function(e) {
		"use strict";
		$(".date-inputmask").inputmask("dd/mm/yyyy"),
		$(".phone-inputmask").inputmask("(999) 999-9999"),
		$(".international-inputmask").inputmask("+9(999)999-9999"),
		$(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
		$(".purchase-inputmask").inputmask("aaaa 9999-****"),
		$(".cc-inputmask").inputmask("9999 9999 9999 9999"),
		$(".ssn-inputmask").inputmask("999-99-9999"),
		$(".isbn-inputmask").inputmask("999-99-999-9999-9"),
		$(".currency-inputmask").inputmask("$9999"),
		$(".percentage-inputmask").inputmask("99%"),
		$(".decimal-inputmask").inputmask({
			alias: "decimal",
			radixPoint: "."
		}),

		$(".email-inputmask").inputmask({
			mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
			greedy: !1,
			onBeforePaste: function(n, a) {
				return (e = e.toLowerCase()).replace("mailto:", "")
			},
			definitions: {
				"*": {
					validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
					cardinality: 1,
					casing: "lower"
				}
			}
		})
	});
</script>
@endsection