<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Get permissions assigned.
     * @param  Request $request
     * @return JSON
     */
    public function permsAssigned(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $perms = $role->perms;
        $notAssigned = $this->permsNotAssigned($perms);
        return response()->json([
            'assigned' => $perms
        ]);
    }

    /**
     * Get permissions not assigned.
     * @param  Collection $perms
     * @return array
     */
    public function permsNotAssigned($perms)
    {
        $permissions = Permission::all();
        $notAssigned = $permissions->diff($perms);
        return $notAssigned->all();
    }

    /**
     * Attach permission to the role.
     * @param  Request $request
     * @return JSON
     */
    public function assign(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->attachPermission($request->permission_id);
        return response()->json([
            'message' => 'Permission has been assigned'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return JSON
     */
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
