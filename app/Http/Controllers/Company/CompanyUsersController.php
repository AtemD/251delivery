<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Models\UserAccountStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with([
            'userAccountStatus'
        ])->paginate(20);

        $user_account_statuses = UserAccountStatus::all();

        return view('dashboard/company/users/index', compact('users', 'user_account_statuses'));
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_account_status_id' => 'nullable|integer|exists:user_account_statuses,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'user_account_status_id' => $validatedData['user_account_status_id'],
            'status_by' => 1, // Auth::user()->id,
            'status_date' => now(),
        ]);

        return back();
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
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $user->id,
            'user_account_status_id' => 'nullable|integer|exists:user_account_statuses,id',
        ]);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'user_account_status_id' => $validatedData['user_account_status_id'],
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
