<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppsController extends Controller
{
	public function inbox() {
		return view('apps.inbox');
	}

	public function emailDetails() {
		return view('apps.email-details');
	}

	public function emailCompose() {
		return view('apps.email-compose');
	}
	
	public function messageChat() {
		return view('apps.message-chat');
	}
}