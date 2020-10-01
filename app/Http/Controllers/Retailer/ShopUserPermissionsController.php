<?php

namespace App\Http\Controllers\Retailer;

use App\User;
use App\Models\Role;
use App\Models\Shop;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopUserPermissionsController extends Controller
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
     * @param  \App\Models\Shop $shop 
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, User $user)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update the user permissions
        $this->authorize('update', $user);

        // Make sure to validate that these cuisine ids exist in the database
        $retailer_permission_ids = Role::where('name', Role::RETAILER)
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->unique('id')
            ->values()
            ->first()
            ->pluck('id')
            ->toArray();

        $this->validate($request, [
            'permissions' => 'required|in:' . implode(',', $retailer_permission_ids),
        ]);

        // dd($request->permissions);

        

        // $filtered = $cuisines->whereIn('id', $request->cuisines);

        $shop->cuisines()->sync($filtered->pluck('id'));

        $user->permissions()->syncWithoutDetaching($request->permissions);
        
        
        return redirect()->route('retailer.users.index', ['shop' => $shop, 'user' => $user])->with('success', 'User Account Updated Successfully');
    }

}
