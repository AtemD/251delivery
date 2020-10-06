<?php

namespace App\Http\Controllers\Company;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PermissionRolesController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // Only users with access to admin dashboard can perform this action
        if(!Auth::user()->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)) return;

        // Authorize if the user has permission to update permissions
        $this->authorize('update', Permission::class);
        
        $validatedData = $request->validate([
            'roles' => 'nullable'
        ]);

        $permission->syncRoles($request->roles);

        return back()->with('success', 'Permission Roles Updated Successfully');
    }
}
