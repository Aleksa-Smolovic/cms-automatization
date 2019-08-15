<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
	public function mapGoogle() {
		return view('maps.map-google');
	}

	public function mapVector() {
		return view('maps.map-vector');
	}
}
