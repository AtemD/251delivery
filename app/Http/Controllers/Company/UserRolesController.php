<?php

namespace App\Http\Controllers\Company;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRolesController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request,[
            'roles' => 'nullable',
        ]);

        $user->roles()->sync($request->roles);
    
        return back()->with('success', 'User Roles Updated Successfully');
    }
}
