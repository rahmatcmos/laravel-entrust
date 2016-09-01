<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the Users.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new User.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->lists('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()
            ->route('user_index')
            ->withSuccess('The user has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->lists('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in the storage.
     * @param  Request $request
     * @param  User    $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email',
            'roles'  => 'required',
        ]);

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

    /**
     * Remove the specified resource from storage.
     * @param  User   $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->can('delete_users')) {
            $user->delete();
            return redirect()->route('user_index');
        }
        $role->delete();
        return redirect()->route('role_index');
    }
}
