<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Models\EWalletAccount;
use App\Http\Controllers\Controller;
use App\Traits\EWalletAccountSecurityTrait;

class EWalletAccountDepositsController extends Controller
{
    use EWalletAccountSecurityTrait;
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
     * @param  EWalletAccount  $e_wallet_account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EWalletAccount $e_wallet_account)
    {
        $this->authorize('update', $e_wallet_account);

        $validatedData = $request->validate([
            'deposit_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if(!$this->EWalletAccountIsActive($e_wallet_account)) {
            return back()->with('error', 'Account is not active!');
        }

        if(!$this->EWalletAccountIsVerified($e_wallet_account)) {
            return back()->with('error', 'Account status is not verified!');
        }

        // get the current wallet amount and add the new deposit amount
        $balance = $e_wallet_account->modified_balance + $validatedData['deposit_amount'];

        if(!$this->EWalletAccountBalanceIsWithinRange($balance)){
            return back()->with('error', 'Resulting amount out of range!');
        }

        // update the wallet with this new amount
        $e_wallet_account->update([
            'balance' => $balance,
        ]);

        // Notify the user about this activity.
        // the account number, the user name, the amount deposited, the time it was deposited


        return back()->with('success', 'Account Deposit Successfully');
    }

}
