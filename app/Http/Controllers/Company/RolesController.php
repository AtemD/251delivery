<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with([
            'permissions' => function ($query) {
                $query->orderBy('name', 'asc');
            }
        ])->orderBy('name', 'asc')->paginate(10);
        
        $permissions = Permission::orderBy('name', 'asc')->get();
        
        return view('dashboard/company/settings/roles/index', compact(
            'roles',
            'permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->toArray());

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'guard_name' => 'required|max:255',
            'permissions' => 'nullable'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        $role->syncPermissions($request->permissions);

        return back();
    }

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
            'name' => 'required|max:255',
            'guard_name' => 'required|max:255',
            'permissions' => 'nullable'
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        $role->syncPermissions($request->permissions);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
