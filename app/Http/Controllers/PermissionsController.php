<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
	// Get perms assigned
	// Get perms not assign

	public function permsAssigned(Request $request)
	{
		$role = Role::findOrFail($request->role_id);
		$perms = $role->perms;		
		$notAssigned = $this->permsNotAssigned($perms);
		return response()->json([
			'assign' => $perms,
			'notAssigned' => $notAssigned
		]);
	}

	public function permsNotAssigned($perms)
	{
		$permissions = Permission::all();
		$notAssigned = $permissions->diff($perms);
		return $notAssigned->all();
	}
}
