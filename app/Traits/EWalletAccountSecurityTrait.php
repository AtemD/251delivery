<?php

namespace App\Traits;

use App\Models\EWalletAccount;
use App\Models\EWalletAccountStatus;

trait EWalletAccountSecurityTrait
{
     /*
        Some Vital Security Checks:
        1. *Before this action, user should be requested for the password
        1. # balance should not be more than MAX_ALLOWED_AMOUNT in ETB at any given time
        2. # balance should not be less than MIN_ALLOWED_AMOUNT in ETB
        3. check for time frames between deposits and withdrawals
        4. # Account should be activated first,
        5. # Account should be verified first,
        
        others:
        No user should update their own wallet account,
        account update should only happen in 12 hr time frame blocks as a security measure
        No more than one deposit is allowed with a certain time frame
        Do more research on bank account security measures
    */
    
    
    /**
     * Check if the E-Wallets account is active.
     *
     * @return bool
     */
    protected function EWalletAccountIsActive($e_wallet_account)
    {
        if(!$e_wallet_account->is_active){
            return false;
        }

        return true;
    }

    /**
     * Check if the E-Wallets account is verified
     *
     * @return bool
     */
    protected function EWalletAccountIsVerified($e_wallet_account)
    {
        $e_wallet_account = $e_wallet_account->load('eWalletAccountStatus');

        if($e_wallet_account->eWalletAccountStatus->name == EWalletAccountStatus::VERIFIED_ACCOUNT){
            return true;
        }

        return false;
    }

    /**
     * Check if the E-Wallets account balance is out of range
     *
     * @return bool
     */
    protected function EWalletAccountBalanceIsWithinRange($balance)
    {
        // covert the balance to cents
        $balance = $balance * 100;

        if($balance > EWalletAccount::MAX_E_WALLET_ACCOUNT_BALANCE){
            return false;
        }

        if($balance < EWalletAccount::MIN_E_WALLET_ACCOUNT_BALANCE){
            return false;
        }

        return true;
    }

}
