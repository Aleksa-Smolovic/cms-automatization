<?php

Route::view('/', 'welcome')->name('pocetna');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth', 'admin']], function () {
	// Users
	Route::post('/users/{role}/restore', 'UsersController@restore')->name('users.restore');
	Route::get('/users/deleted', 'UsersController@deleted')->name('users.deleted');
	Route::resource('users', 'UsersController');

	// Roles
	Route::post('/roles/{role}/restore', 'RolesController@restore')->name('roles.restore');
	Route::get('/roles/deleted', 'RolesController@deleted')->name('roles.deleted');
	Route::resource('roles', 'RolesController');

	// Admin
	Route::get('/admin', 'AdminController@index')->name('admin.index');

	  /////////////////////////////
	 // Concept Template Routes //
	/////////////////////////////

	// Dashboard
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
	Route::get('/products', 'DashboardController@products')->name('dashboard.products');
	Route::get('/product-single', 'DashboardController@productSingle')->name('dashboard.product-single');
	Route::get('/product-checkout', 'DashboardController@productCheckout')->name('dashboard.product-checkout');
	Route::get('/finance', 'DashboardController@finance')->name('dashboard.finance');
	Route::get('/sales', 'DashboardController@sales')->name('dashboard.sales');
	Route::get('/influencer', 'DashboardController@influencer')->name('dashboard.influencer');
	Route::get('/influencer-finder', 'DashboardController@influencerFinder')->name('dashboard.influencer-finder');
	Route::get('/influencer-profile', 'DashboardController@influencerProfile')->name('dashboard.influencer-profile');

	// UI Elements
	Route::get('/cards', 'UielementsController@cards')->name('uielements.cards');
	Route::get('/general', 'UielementsController@general')->name('uielements.general');
	Route::get('/carousel', 'UielementsController@carousel')->name('uielements.carousel');
	Route::get('/list-group', 'UielementsController@listGroup')->name('uielements.list-group');
	Route::get('/typography', 'UielementsController@typography')->name('uielements.typography');
	Route::get('/accordions', 'UielementsController@accordions')->name('uielements.accordions');
	Route::get('/tabs', 'UielementsController@tabs')->name('uielements.tabs');

	// Chart
	Route::get('/c3-charts', 'ChartController@c3charts')->name('chart.c3-charts');
	Route::get('/chartist-charts', 'ChartController@chartistCharts')->name('chart.chartist-charts');
	Route::get('/chart', 'ChartController@chart')->name('chart.chart');
	Route::get('/morris', 'ChartController@morris')->name('chart.morris');
	Route::get('/sparkline', 'ChartController@sparkline')->name('chart.sparkline');
	Route::get('/guage', 'ChartController@guage')->name('chart.guage');

	// Forms
	Route::get('/form-elements', 'FormsController@formElements')->name('forms.form-elements');
	Route::get('/form-validation', 'FormsController@formValidation')->name('forms.form-validation');
	Route::get('/multiselect', 'FormsController@multiselect')->name('forms.multiselect');
	Route::get('/datepicker', 'FormsController@datepicker')->name('forms.datepicker');
	Route::get('/bootstrap-select', 'FormsController@bootstrapSelect')->name('forms.bootstrap-select');

	// Tables
	Route::get('/general-tables', 'TablesController@generalTables')->name('tables.general-tables');
	Route::get('/data-tables', 'TablesController@dataTables')->name('tables.data-tables');

	// Pages
	Route::get('/blank-page', 'PagesController@blankPage')->name('pages.blank-page');
	Route::get('/blank-page-header', 'PagesController@blankPageHeader')->name('pages.blank-page-header');
	Route::get('/login-forma', 'PagesController@loginForma')->name('pages.login-forma');
	Route::get('/page-404', 'PagesController@page404')->name('pages.page-404');
	Route::get('/sign-up', 'PagesController@signUp')->name('pages.sign-up');
	Route::get('/forgot-password', 'PagesController@forgotPassword')->name('pages.forgot-password');
	Route::get('/pricing', 'PagesController@pricing')->name('pages.pricing');
	Route::get('/timeline', 'PagesController@timeline')->name('pages.timeline');
	Route::get('/calendar', 'PagesController@calendar')->name('pages.calendar');
	Route::get('/sortable-nestable-lists', 'PagesController@sortableNestableLists')->name('pages.sortable-nestable-lists');
	Route::get('/widgets', 'PagesController@widgets')->name('pages.widgets');
	Route::get('/media-object', 'PagesController@mediaObject')->name('pages.media-object');
	Route::get('/cropper-image', 'PagesController@cropperImage')->name('pages.cropper-image');
	Route::get('/color-picker', 'PagesController@colorPicker')->name('pages.color-picker');

	// Apps
	Route::get('/inbox', 'AppsController@inbox')->name('apps.inbox');
	Route::get('/email-details', 'AppsController@emailDetails')->name('apps.email-details');
	Route::get('/email-compose', 'AppsController@emailCompose')->name('apps.email-compose');
	Route::get('/message-chat', 'AppsController@messageChat')->name('apps.message-chat');

	// Icons
	Route::get('/icon-fontawesome', 'IconsController@iconFontawesome')->name('icons.icon-fontawesome');
	Route::get('/icon-material', 'IconsController@iconMaterial')->name('icons.icon-material');
	Route::get('/icon-simple-lineicon', 'IconsController@iconSimpleLineicon')->name('icons.icon-simple-lineicon');
	Route::get('/icon-themify', 'IconsController@iconThemify')->name('icons.icon-themify');
	Route::get('/icon-flag', 'IconsController@iconFlag')->name('icons.icon-flag');
	Route::get('/icon-weather', 'IconsController@iconWeather')->name('icons.icon-weather');

	// Maps
	Route::get('/map-google', 'MapsController@mapGoogle')->name('maps.map-google');
	Route::get('/map-vector', 'MapsController@mapVector')->name('maps.map-vector');
});