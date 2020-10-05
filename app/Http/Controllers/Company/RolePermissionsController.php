<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RolePermissionsController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'permissions' => 'nullable'
        ]);

        $role->syncPermissions($request->permissions);

        return back()->with('success', 'Role Permissions Updated Successfully');
    }
}
