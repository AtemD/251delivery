<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Models\City;
use App\Search\UserSearch;
use Illuminate\Http\Request;
use App\Models\UserAccountStatus;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
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
    public function index(Request $request)
    {
        $this->authorize('view', User::class);

        $users = UserSearch::apply($request);

        $users = $users->with([
            'eWalletAccount',
            'userAccountStatus',
            'roles',
            'userLocation.city'
        ])->latest()->simplePaginate();

        // dd($users->toArray());

        $user_account_statuses = UserAccountStatus::all();
        $roles = Role::all();
        $cities = City::all();

        return view('dashboard/company/users/index', compact([
            'users',
            'roles',
            'cities',
            'user_account_statuses'
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
        $this->authorize('update', User::class);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('company.users.edit', ['user' => $user])->with('success', 'User Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        $user = $user->load(['userAccountStatus', 'roles', 'EWalletAccount.EWalletAccountStatus']);
        
        $roles = Role::all();
        $user_account_statuses = UserAccountStatus::all();
        
        return view('dashboard/company/users/edit', compact(
            'user',
            'roles',
            'user_account_statuses'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $user->id,
        ]);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
        ]);

        return back()->with('success', 'User Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return back()->with('success', 'User Deleted Successfully');
    }
}
