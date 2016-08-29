<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function permsAssigned(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $perms = $role->perms;
        $notAssigned = $this->permsNotAssigned($perms);
        return response()->json([
            'assigned' => $perms,
            'notAssigned' => $notAssigned
        ]);
    }

    public function permsNotAssigned($perms)
    {
        $permissions = Permission::all();
        $notAssigned = $permissions->diff($perms);
        return $notAssigned->all();
    }

    public function assign(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->attachPermission($request->permission_id);
        return response()->json([
            'message' => 'Permission has been assigned'
        ]);
    }

    public function remove(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);
        $role->detachPermission($permission);

        return response()->json([
            'message' => 'Permission has been removed'
        ]);
    }
}
