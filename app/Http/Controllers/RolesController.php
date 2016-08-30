<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description'  => 'required'
        ]);

        Role::create($request->all());
        return redirect()->route('role_index');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $role->update($request->only('description'));
        return back();
    }

    public function destroy(Role $role)
    {
        if (!Auth::user()->can('delete_roles')) {
            return back()->withError("You don't have permission for this action.");
        }

        // Force Delete
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]); // Delete relationship data

        $role->forceDelete();
        return redirect()->route('role_index');
    }
}
