<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function blankPage() {
		return view('pages.blank-page');
	}

	public function blankPageHeader() {
		return view('pages.blank-page-header');
	}
	
	public function loginForma() {
		return view('pages.login-forma');
	}
	
	public function page404() {
		return view('pages.page-404');
	}
	
	public function signUp() {
		return view('pages.sign-up');
	}
	
	public function forgotPassword() {
		return view('pages.forgot-password');
	}
	
	public function pricing() {
		return view('pages.pricing');
	}
	
	public function timeline() {
		return view('pages.timeline');
	}
	
	public function calendar() {
		return view('pages.calendar');
	}
	
	public function sortableNestableLists() {
		return view('pages.sortable-nestable-lists');
	}
	
	public function widgets() {
		return view('pages.widgets');
	}
	
	public function mediaObject() {
		return view('pages.media-object');
	}
	
	public function cropperImage() {
		return view('pages.cropper-image');
	}
	
	public function colorPicker() {
		return view('pages.color-picker');
	}

}
