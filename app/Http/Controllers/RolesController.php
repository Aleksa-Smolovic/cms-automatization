<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
	public function index() {
		return view('roles.index')->with('roles', Role::all());
	}

	public function create() {
		
	}

	public function store() {
		
	}

	public function edit() {
		
	}

	public function update() {
		
	}

	public function show() {
		
	}

	public function destroy() {
		
	}
}
