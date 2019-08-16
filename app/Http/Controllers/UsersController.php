<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
	public function index() {
		$users = User::orderBy('id', 'DESC')->get();
		return view('users.index', compact('users'));
	}

	public function create() {
		$roles = Role::orderBy('name', 'ASC')->get();
		return view('users.create', compact('roles'));
	}

	public function store(Request $request) {
		$data = request()->validate([
			'role_id'    => ['required'],
			'first_name' => ['required', 'min:2'],
			'last_name'  => ['required', 'min:2'],
			'username'   => ['required', 'min:2'],
			'email'      => ['required', 'email'],
			'password'   => ['required', 'min:6' ,'confirmed'],
		]);
		$data['password'] = Hash::make($data['password'], ['rounds' => 12]);

		$user = new User();
		$role = Role::find($data['role_id']);
		$user->role()->associate($role);
		$user->first_name = $data['first_name'];
		$user->last_name  = $data['last_name'];
		$user->username   = $data['username'];
		$user->email      = $data['email'];
		$user->password   = $data['password'];
		$user->save();

		return redirect(route('users.index'))->with('success', 'User added successfully.');
	}

	public function edit(User $user) {
		$roles = Role::all();
		return view('users.edit', compact('user', 'roles'));
	}

	public function update(Request $request, User $user) {
		$data = $request->validate([
			'role_id'    => ['required'],
			'first_name' => ['required', 'min:2'],
			'last_name'  => ['required', 'min:2'],
			'username'   => ['required', 'min:2'],
			'email'      => ['required', 'email']
		]);

		if(!empty($request['password'])) {
			$data['password'] = $request['password'];
			$request->validate([
				'password' => ['required', 'min:6' , 'confirmed']
			]);
			$data['password'] = Hash::make($data['password'], ['rounds' => 12]);
		}
		
		$user->update($data);
		$role = Role::find($data['role_id']);
		$user->role()->associate($role);
		$user->save();

		return redirect(route('users.index'))->with('success', 'User updated successfully.');
	}

	public function show() {
		
	}

	public function destroy(User $user) {
		$user->delete();
		return redirect(route('users.index'))->with('success', 'User deleted successfully.');
	}

		public function deleted() {
		return view('users.deleted')->withUsers(User::onlyTrashed()->get());
	}

	public function restore($id) {
		User::where('id', $id)->restore();
		return back()->with('succes', 'User restored successfully.');
	}
}
