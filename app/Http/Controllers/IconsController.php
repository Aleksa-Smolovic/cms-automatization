<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IconsController extends Controller
{
	public function iconFontawesome() {
		return view('icons.icon-fontawesome');
	}
	
	public function iconMaterial() {
		return view('icons.icon-material');
	}

	public function iconSimpleLineicon() {
		return view('icons.icon-simple-lineicon');
	}
	
	public function iconThemify() {
		return view('icons.icon-themify');
	}

	public function iconFlag() {
		return view('icons.icon-flag');
	}
	
	public function iconWeather() {
		return view('icons.icon-weather');
	}
}






