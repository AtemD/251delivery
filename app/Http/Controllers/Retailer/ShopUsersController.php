<?php

namespace App\Http\Controllers\Retailer;

use Image;
use App\User;
use App\Models\Role;
use App\Models\Shop;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ShopUsersController extends Controller
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
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);

        $this->authorize('view', User::class);

        $shop = $shop->load('users.roles.permissions');

        // *shop  users who are admin or have permission to access admin dashboard should be removed

        $retailer_role = Role::where('name', Role::RETAILER)->firstOrFail();
        $retailer_role = $retailer_role->load('permissions');

        return view('dashboard/retailer/users/index', compact([
            'shop',
            'retailer_role'
        ]));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can create user
        // $this->authorize('create', User::class);

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            // 'shops' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function() use($request, $shop){
            // Create user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Give the user permission to access retailer dashboard
            $user->givePermissionTo(Permission::ACCESS_RETAILER_DASHBOARD);

            // Assign that user to this shop, or all shops in the request
            $user->shops()->sync([$shop->id]);
        }, 3);

        // upon success
        // return redirect()->rout('retailer.users.edit', ['shop' => $shop, 'user' => $user])
        //     ->with('info', 'User Created Successfuly, Please give the user some permissions from a list of options below');

        // upon failure
        // return redirect()->route('retailer.users.index', ['shop' => $shop])
        //     ->with('error', 'There was a problem with inserting the new user to database');
        
        
        // Note: The user should be verified, email and phone number should be verified before the user can login
        // This can be done in various ways once the user signsup, a verification link is sent by text or email
        return redirect()->route('retailer.users.index', ['shop' => $shop])->with('success', 'User Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, User $user)
    {
        // Check if the user is authorized to view the shop
        $this->authorize('view', $shop);

        // Check if the user is authorized to update the user
        $this->authorize('update', $user);

        // Get all the permissions given to the specified user
        $user_permissions = $user->getAllPermissions();

        // Get the retailer role
        $retailer_role = Role::where('name', Role::RETAILER)->with([
                'permissions' => function($query) {
                    $query->orderBy('name', 'asc');
                }
        ])->firstOrFail();

        return view('dashboard/retailer/users/edit', compact(
            'shop',
            'retailer_role',
            'user',
            'user_permissions'
        ));
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

        // Authorize that the user can update profile
        // $this->authorize('update', $user);

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id . ',id'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        
        
        return redirect()->route('retailer.users.index', ['shop' => $shop, 'user' => $user])->with('success', 'User Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Shop $shop
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, User $user)
    {
        // dd('hit delete shop user');
        
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update products
        $this->authorize('delete', $user);

        $user->delete();

        return back()->with('success', 'User Deleted Successfully');
    }
}
