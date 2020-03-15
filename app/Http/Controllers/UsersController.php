<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Function for displaying View Users Admin Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index() {
		$users = User::orderBy('id', 'DESC')->get();
		return view('admin.users.index', compact('users'));
	}


    /**
     * Function for displaying View for User Crete
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function create() {
		$roles = Role::orderBy('name', 'ASC')->get();
		return view('admin.users.create', compact('roles'));
	}


    /**
     * Function for creating new User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(Request $request) {
		$data = request()->validate([
			'role_id'    => 'required',
			'first_name' => 'required|min:2',
			'last_name'  => 'required|min:2',
			'username'   => 'required|min:2',
			'email'      => 'required|email|unique:users',
			'password'   => 'required|min:6|confirmed'
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
		dd($user);return;
		$user->save();

		return redirect(route('users.index'))->with('success', 'User added successfully.');
	}


    /**
     * Function for displaying View for User Edit
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function edit(User $user) {
		$roles = Role::all();
		return view('admin.users.edit', compact('user', 'roles'));
	}


    /**
     * Function for Updating a User
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function update(Request $request, User $user) {
		$data = $request->validate([
			'role_id'    => 'required',
			'first_name' => 'required|min:2',
			'last_name'  => 'required|min:2',
			'username'   => 'required|min:2',
			'email'      => 'required|email'
		]);

		if(!empty($request['password'])) {
			$data['password'] = $request['password'];
			$request->validate([
				'password' => ['required', 'min:6' , 'confirmed']
			]);
			$data['password'] = Hash::make($data['password'], ['rounds' => 12]);
		}

		$usersEmail = User::where('email', '=', $request->email)->where('id', '!=', $request->id)->first();

		if($usersEmail){
            return back()->withErrors(['email' => 'Email belongs to another user.']);
        }else{
            $user->update($data);
            $role = Role::find($data['role_id']);
            $user->role()->associate($role);
            $user->save();

            return redirect(route('users.index'))->with('success', 'User updated successfully.');
        }
	}


    /**
     * Empty function
     */
	public function show() {
		
	}


    /**
     * Function for deleting a User
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
	public function destroy(User $user) {
		$user->delete();
		return redirect(route('users.index'))->with('success', 'User deleted successfully.');
	}


    /**
     * Function for displaying View with Soft Deleted Users
     * @return mixed
     */
    public function deleted() {
        return view('admin.users.deleted')->withUsers(User::onlyTrashed()->get());
	}


    /**
     * Function for restoring destroyed User
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
	public function restore($id) {
		User::where('id', $id)->restore();
		return back()->with('succes', 'User restored successfully.');
	}
}
