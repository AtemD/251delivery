<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Models\UserAccountStatus;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RetailersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailers = Retailer::with([
            'shops',
            'userAccountStatus',
            'roles',
            'permissions'
        ])->latest()->paginate(20);

        $roles = Role::all();
        $permissions = Permission::all();
        $user_account_statuses = UserAccountStatus::all();

        return view('dashboard/company/retailers/index', compact([
            'retailers', 
            'user_account_statuses',
            'roles',
            'permisssions'
        ]));
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_account_status_id' => 'nullable|exists:user_account_statuses,id',
            'roles' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // dd($validatedData);

        $retailer = Retailer::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'user_account_status_id' => $validatedData['user_account_status_id'],
            'status_by' => 2, //Auth::user()->id,
            'status_date' => now(),
        ]);

        $retailer->assignRole($validatedData['roles']);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retailer $retailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $retailer->id,
            'user_account_status_id' => 'nullable|exists:user_account_statuses,id',
            'roles' => 'required',
        ]);

        // WARNING, note that status date will update even if you did not intend to update it
        // find another method to update it if necessary,
        // e.g isDirty(), isClean()
        // try the above methods to update appropriately
        $retailer->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'user_account_status_id' => $validatedData['user_account_status_id'],
            'status_by' => 2, //Auth::user()->id,
            'status_date' => now(),
        ]);

        $retailer->syncRoles($validatedData['roles']);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retailer $retailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer)
    {
        $retailer->delete();
        return back();
    }
}
