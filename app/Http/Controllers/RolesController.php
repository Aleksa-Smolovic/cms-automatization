<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
	public function index() {
		return view('roles.index')->with('roles', Role::orderBy('id', 'ASC')->get());
	}

	public function create() {
		return view('roles.create');
	}

	public function store(Request $request) {
		$data = $request->validate([
			'name' => 'required|min:2|unique:roles'
		]);
		Role::create($data);
		return redirect(route('roles.index'))->with('success', 'Role created successfully.');
	}

	public function edit(Role $role) {
		return view('roles.edit', compact('role'));
	}

	public function update(Request $request, Role $role) {
		$data = $request->validate([
			'name' => 'required|min:2|unique:roles'
		]);
		$role->update($data);
		return redirect(route('roles.index'))->with('success', 'Role updated successfully.');
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

	public function deleted() {
		return view('roles.deleted')->withRoles(Role::onlyTrashed()->get());
	}

	public function restore($id) {
		Role::where('id', $id)->restore();
		return back()->with('succes', 'Role restored successfully');
	}
}
