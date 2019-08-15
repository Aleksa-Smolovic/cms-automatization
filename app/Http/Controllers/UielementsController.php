<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UielementsController extends Controller
{
	public function cards() {
		return view('uielements.cards');
	}
	
	public function general() {
		return view('uielements.general');
	}
	
	public function carousel() {
		return view('uielements.carousel');
	}
	
	public function listGroup() {
		return view('uielements.list-group');
	}
	
	public function typography() {
		return view('uielements.typography');
	}
	
	public function accordions() {
		return view('uielements.accordions');
	}
	
	public function tabs() {
		return view('uielements.tabs');
	}
}
