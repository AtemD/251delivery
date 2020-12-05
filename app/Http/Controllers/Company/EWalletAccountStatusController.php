<?php

namespace App\Http\Controllers\Company;

use App\User;
use Illuminate\Http\Request;
use App\Models\EWalletAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EWalletAccountStatusController extends Controller
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
    public function update(Request $request, EWalletAccount $e_wallet_account)
    {
        $this->authorize('update', $e_wallet_account);

        $this->validate($request,[
            'e_wallet_account_status' => 'nullable|exists:e_wallet_account_statuses,id',
        ]);
        
        // Do e-wallet security checks here, before proceeding to update the account

        $e_wallet_account->update([
            'e_wallet_account_status_id' => $request->e_wallet_account_status,
            'status_by' => Auth::user()->id,
            // 'status_date' => now()
        ]);
    
        return back()->with('success', 'E-Wallet Account Status Updated Successfully');
    }
}
