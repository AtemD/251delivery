<?php

namespace App\Http\Controllers\Company;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAccountStatusController extends Controller
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
            'user_account_status' => 'nullable|exists:user_account_statuses,id',
        ]);

        $user->update([
            'user_account_status_id' => $request->user_account_status,
            'status_by' => Auth::user()->id,
            'status_date' => now()
        ]);
    
        return back()->with('success', 'User Account Status Updated Successfully');
    }
}
