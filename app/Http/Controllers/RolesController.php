<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
	public function index()
	{
		$roles = Role::all();
        $permissions = Permission::all();
		return view('roles.index', compact('roles', 'permissions'));
	}

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        Role::create($request->all());        
        return redirect()->route('role_index');
    }
}
