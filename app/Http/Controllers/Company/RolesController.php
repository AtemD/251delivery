<?php

namespace App\Http\Controllers\Company;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'guard_name' => 'required|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return back()->with('success', 'Role Created Successfully, got to edit to assign it permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = $role->load('permissions');

        $permissions = Permission::orderBy('name', 'asc')->get();
        
        return view('dashboard/company/settings/roles/edit', compact(
            'role',
            'permissions'
        ));
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
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return back()->with('success', 'Role Updated Successfully');
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
        return back()->with('success', 'Role Deleted Successfully');;
    }
}
