<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UsersController extends Controller
{

	public function index() {
		$users = User::orderBy('id', 'DESC')->get();
		$roles = Role::orderBy('name', 'ASC')->get();
		return view('admin.users.index', compact('users', 'roles'));
	}

	public function getOne($id) {
		$user = User::find($id);
		return $user ? $user : null;
	}

	public function store(UserStoreRequest $request) {
		User::create($request->validated());
		return response()->json(['success' => 'success'], 200);
	}

	public function edit(UserStoreRequest $request, User $user) {
		$data = $request->validated();
		$user->fill($data);
		$user->save();
		return response()->json(['success' => 'success'], 200);
	}

	public function destroy(User $user) {
		$user->delete();
		return back()->with("success", "Korisnik uspješno obrisan!");
	}

    public function deleted() {
        return view('admin.users.deleted')->withUsers(User::onlyTrashed()->get());
	}

	public function restore($id) {
		User::where('id', $id)->restore();
		return back()->with('succes', 'User restored successfully.');
	}
}
