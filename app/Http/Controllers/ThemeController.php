<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Dashboard
     */
    public function index() {
        return view('theme.dashboard.index');
    }

    public function finance() {
        return view('theme.dashboard.finance');
    }

    public function sales() {
        return view('theme.dashboard.sales');
    }

    public function products() {
        return view('theme.dashboard.products');
    }

    public function productSingle() {
        return view('theme.dashboard.product-single');
    }

    public function productCheckout() {
        return view('theme.dashboard.product-checkout');
    }

    public function influencer() {
        return view('theme.dashboard.influencer');
    }

    public function influencerFinder() {
        return view('theme.dashboard.influencer-finder');
    }

    public function influencerProfile() {
        return view('theme.dashboard.influencer-profile');
    }


    /**
     * UI Elements
     */
    public function cards() {
        return view('theme.uielements.cards');
    }

    public function general() {
        return view('theme.uielements.general');
    }

    public function carousel() {
        return view('theme.uielements.carousel');
    }

    public function listGroup() {
        return view('theme.uielements.list-group');
    }

    public function typography() {
        return view('theme.uielements.typography');
    }

    public function accordions() {
        return view('theme.uielements.accordions');
    }

    public function tabs() {
        return view('theme.uielements.tabs');
    }


    /**
     * Charts
     */
    public function c3Charts() {
        return view('theme.chart.c3-charts');
    }

    public function chartistCharts() {
        return view('theme.chart.chartist-charts');
    }

    public function chart() {
        return view('theme.chart.chart');
    }

    public function morris() {
        return view('theme.chart.morris');
    }

    public function sparkline() {
        return view('theme.chart.sparkline');
    }

    public function guage() {
        return view('theme.chart.guage');
    }


    /**
     * Forms
     */
    public function formElements() {
        return view('theme.forms.form-elements');
    }

    public function formValidation() {
        return view('theme.forms.form-validation');
    }

    public function multiselect() {
        return view('theme.forms.multiselect');
    }

    public function datepicker() {
        return view('theme.forms.datepicker');
    }

    public function bootstrapSelect() {
        return view('theme.forms.bootstrap-select');
    }


    /**
     * Tables
     */
    public function dataTables() {
        return view('theme.tables.data-tables');
    }

    public function generalTables() {
        return view('theme.tables.general-tables');
    }


    /**
     * Pages
     */
    public function blankPage() {
        return view('theme.pages.blank-page');
    }

    public function blankPageHeader() {
        return view('theme.pages.blank-page-header');
    }

    public function loginForma() {
        return view('theme.pages.login-forma');
    }

    public function page404() {
        return view('theme.pages.page-404');
    }

    public function signUp() {
        return view('theme.pages.sign-up');
    }

    public function forgotPassword() {
        return view('theme.pages.forgot-password');
    }

    public function pricing() {
        return view('theme.pages.pricing');
    }

    public function timeline() {
        return view('theme.pages.timeline');
    }

    public function calendar() {
        return view('theme.pages.calendar');
    }

    public function sortableNestableLists() {
        return view('theme.pages.sortable-nestable-lists');
    }

    public function widgets() {
        return view('theme.pages.widgets');
    }

    public function mediaObject() {
        return view('theme.pages.media-object');
    }

    public function cropperImage() {
        return view('theme.pages.cropper-image');
    }

    public function colorPicker() {
        return view('theme.pages.color-picker');
    }



    /**
     * Apps
     */
    public function inbox() {
        return view('theme.apps.inbox');
    }

    public function emailDetails() {
        return view('theme.apps.email-details');
    }

    public function emailCompose() {
        return view('theme.apps.email-compose');
    }

    public function messageChat() {
        return view('theme.apps.message-chat');
    }


    /**
     * Icons
     */
    public function iconFontawesome() {
        return view('theme.icons.icon-fontawesome');
    }

    public function iconMaterial() {
        return view('theme.icons.icon-material');
    }

    public function iconSimpleLineicon() {
        return view('theme.icons.icon-simple-lineicon');
    }

    public function iconThemify() {
        return view('theme.icons.icon-themify');
    }

    public function iconFlag() {
        return view('theme.icons.icon-flag');
    }

    public function iconWeather() {
        return view('theme.icons.icon-weather');
    }


    /**
     * Maps
     */
    public function mapGoogle() {
        return view('theme.maps.map-google');
    }

    public function mapVector() {
        return view('theme.maps.map-vector');
    }
}
