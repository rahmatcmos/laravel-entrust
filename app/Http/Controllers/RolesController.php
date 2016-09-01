<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the Roles.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new Role.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in the storage.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description'  => 'required'
        ]);

        Role::create($request->all());
        return redirect()->route('role_index')->withSuccess('The Role has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Role    $role
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $role->update($request->only('description'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  Role   $role
     * @return \Illuminate\Http\Response
     */
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
