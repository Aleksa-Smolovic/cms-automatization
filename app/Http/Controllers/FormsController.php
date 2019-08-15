<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{
	public function formElements() {
		return view('forms.form-elements');
	}

	public function formValidation() {
		return view('forms.form-validation');
	}

	public function multiselect() {
		return view('forms.multiselect');
	}

	public function datepicker() {
		return view('forms.datepicker');
	}

	public function bootstrapSelect() {
		return view('forms.bootstrap-select');
	}

}
