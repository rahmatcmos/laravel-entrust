<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
    		'role'  => 'required',
    		'password' => 'required'
		]);
		
    	$user = User::create($request->only('name', 'email', 'password'));
        $user->attachRole($request->role);

        return back();
    }
}
