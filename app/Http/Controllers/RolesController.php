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
		return view('roles.create');
	}

	public function store(Request $request) {
		$data = $request->validate([
			'name' => 'required|min:2|unique:roles'
		]);
		Role::create($data);
		return redirect(route('roles.index'))->with('success', 'Role deleted successfully.');
	}

	public function edit() {
		
	}

	public function update() {
		
	}

	public function show() {
		
	}

	public function destroy(Role $role) {
		if($role->users->count() > 0) {
			return back()->with('error', 'Aborted, this role has users.');
		}
		$role->delete();
		return redirect(route('roles.index'))->with('success', 'Role deleted successfully.');
	}
}
