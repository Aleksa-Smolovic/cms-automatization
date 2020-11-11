<?php

/**
 * Web Site routes
 */
Route::get('/', 'WebsiteController@index');

/**
 * Admin Panel routes
 */
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin/'], function () {

    // Users
    Route::get('/users/deleted', 'UsersController@deleted')->name('users.deleted');
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/{id}', 'UsersController@getOne')->name('users/fetch');
    Route::post('/users/{user}/edit', 'UsersController@edit')->name('users/edit');
    Route::post('/users/store', 'UsersController@store')->name('users/store');
    Route::delete('/users/delete/{user}', 'UsersController@destroy')->name('users/delete');
    Route::put('/users/restore/{id}', 'UsersController@restore')->name('users/restore');

    // Admin
    Route::get('', 'AdminPanelController@index')->name('admin.index');

    // </needle>

    Route::post('/summernote/image-upload', 'SummernoteUploadController@save');
});

/**
 * Auth routes
 */
Auth::routes();


/**
 * Concept Template Theme routes
 */
Route::group(['middleware' => ['auth', 'admin']], function () {

    // Dashboard
    Route::get('/dashboard', 'ThemeController@index')->name('dashboard.index');
    Route::get('/products', 'ThemeController@products')->name('dashboard.products');
    Route::get('/product-single', 'ThemeController@productSingle')->name('dashboard.product-single');
    Route::get('/product-checkout', 'ThemeController@productCheckout')->name('dashboard.product-checkout');
    Route::get('/finance', 'ThemeController@finance')->name('dashboard.finance');
    Route::get('/sales', 'ThemeController@sales')->name('dashboard.sales');
    Route::get('/influencer', 'ThemeController@influencer')->name('dashboard.influencer');
    Route::get('/influencer-finder', 'ThemeController@influencerFinder')->name('dashboard.influencer-finder');
    Route::get('/influencer-profile', 'ThemeController@influencerProfile')->name('dashboard.influencer-profile');

    // UI Elements
    Route::get('/cards', 'ThemeController@cards')->name('uielements.cards');
    Route::get('/general', 'ThemeController@general')->name('uielements.general');
    Route::get('/carousel', 'ThemeController@carousel')->name('uielements.carousel');
    Route::get('/list-group', 'ThemeController@listGroup')->name('uielements.list-group');
    Route::get('/typography', 'ThemeController@typography')->name('uielements.typography');
    Route::get('/accordions', 'ThemeController@accordions')->name('uielements.accordions');
    Route::get('/tabs', 'ThemeController@tabs')->name('uielements.tabs');

    // Chart
    Route::get('/c3-charts', 'ThemeController@c3charts')->name('chart.c3-charts');
    Route::get('/chartist-charts', 'ThemeController@chartistCharts')->name('chart.chartist-charts');
    Route::get('/chart', 'ThemeController@chart')->name('chart.chart');
    Route::get('/morris', 'ThemeController@morris')->name('chart.morris');
    Route::get('/sparkline', 'ThemeController@sparkline')->name('chart.sparkline');
    Route::get('/guage', 'ThemeController@guage')->name('chart.guage');

    // Forms
    Route::get('/form-elements', 'ThemeController@formElements')->name('forms.form-elements');
    Route::get('/form-validation', 'ThemeController@formValidation')->name('forms.form-validation');
    Route::get('/multiselect', 'ThemeController@multiselect')->name('forms.multiselect');
    Route::get('/datepicker', 'ThemeController@datepicker')->name('forms.datepicker');
    Route::get('/bootstrap-select', 'ThemeController@bootstrapSelect')->name('forms.bootstrap-select');

    // Tables
    Route::get('/general-tables', 'ThemeController@generalTables')->name('tables.general-tables');
    Route::get('/data-tables', 'ThemeController@dataTables')->name('tables.data-tables');

    // Pages
    Route::get('/blank-page', 'ThemeController@blankPage')->name('pages.blank-page');
    Route::get('/blank-page-header', 'ThemeController@blankPageHeader')->name('pages.blank-page-header');
    Route::get('/login-forma', 'ThemeController@loginForma')->name('pages.login-forma');
    Route::get('/page-404', 'ThemeController@page404')->name('pages.page-404');
    Route::get('/sign-up', 'ThemeController@signUp')->name('pages.sign-up');
    Route::get('/forgot-password', 'ThemeController@forgotPassword')->name('pages.forgot-password');
    Route::get('/pricing', 'ThemeController@pricing')->name('pages.pricing');
    Route::get('/timeline', 'ThemeController@timeline')->name('pages.timeline');
    Route::get('/calendar', 'ThemeController@calendar')->name('pages.calendar');
    Route::get('/sortable-nestable-lists', 'ThemeController@sortableNestableLists')->name('pages.sortable-nestable-lists');
    Route::get('/widgets', 'ThemeController@widgets')->name('pages.widgets');
    Route::get('/media-object', 'ThemeController@mediaObject')->name('pages.media-object');
    Route::get('/cropper-image', 'ThemeController@cropperImage')->name('pages.cropper-image');
    Route::get('/color-picker', 'ThemeController@colorPicker')->name('pages.color-picker');

    // Apps
    Route::get('/inbox', 'ThemeController@inbox')->name('apps.inbox');
    Route::get('/email-details', 'ThemeController@emailDetails')->name('apps.email-details');
    Route::get('/email-compose', 'ThemeController@emailCompose')->name('apps.email-compose');
    Route::get('/message-chat', 'ThemeController@messageChat')->name('apps.message-chat');

    // Icons
    Route::get('/icon-fontawesome', 'ThemeController@iconFontawesome')->name('icons.icon-fontawesome');
    Route::get('/icon-material', 'ThemeController@iconMaterial')->name('icons.icon-material');
    Route::get('/icon-simple-lineicon', 'ThemeController@iconSimpleLineicon')->name('icons.icon-simple-lineicon');
    Route::get('/icon-themify', 'ThemeController@iconThemify')->name('icons.icon-themify');
    Route::get('/icon-flag', 'ThemeController@iconFlag')->name('icons.icon-flag');
    Route::get('/icon-weather', 'ThemeController@iconWeather')->name('icons.icon-weather');

    // Maps
    Route::get('/map-google', 'ThemeController@mapGoogle')->name('maps.map-google');
    Route::get('/map-vector', 'ThemeController@mapVector')->name('maps.map-vector');
});
