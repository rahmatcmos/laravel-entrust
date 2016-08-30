<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->lists('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email',
            'roles'  => 'required',
            'password' => 'required'
        ]);

        $user = User::create($request->only('name', 'email', 'password'));
        $user->attachRoles($request->roles);

        return back();
    }

    public function edit(User $user)
    {
        $roles = Role::all()->lists('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $roles = $user->roles;
        $user->detachRoles($roles);

        if ($request->roles) {
            foreach ($request->roles as $role_id) {
                $role = Role::findOrFail($role_id);
                $user->attachRole($role);
            }
        }

        return back();
    }

    public function destroy(User $user)
    {        
        if (Auth::user()->can('delete_users')) {
            $user->delete();
            return redirect()->route('user_index');
        }

        return back();
    }
}
