<?php 

namespace App\Search;

use Carbon\Carbon;
use App\Models\EWalletAccount;

class EWalletAccountSearch 
{
    public static function apply($filters){

        $e_wallet_account = (new EWalletAccount)->newQuery();
        
        // search for and e-wallet account based on its number
        if($filters->has('global_e_wallet_search')  && !empty($filters->input('global_e_wallet_search'))){
            $global_e_wallet_search = $filters->input('global_e_wallet_search');
            $e_wallet_account = $e_wallet_account->where('number', $global_e_wallet_search);
        }

        // E-wallet Account Status
        if($filters->has('account_status')  && !empty($filters->input('account_status'))){
            $e_wallet_account = $e_wallet_account->whereHas('eWalletAccountStatus', function($query) use($filters) {
                $query->where('e_wallet_account_statuses.id', $filters->input('account_status'));
            });
        }

        if($filters->has('is_active')  && !empty($filters->input('is_active'))){
            $is_active = $filters->input('is_active') == "active" ? "1" : "0";

            $e_wallet_account = $e_wallet_account->where('is_active', (bool)$is_active);
        }
        
        // Date from - Date to
        if(!empty($filters->input('from_date')) && !empty($filters->input('to_date'))){
            $from_date = $filters->input('from_date'); // start date
            $to_date = $filters->input('to_date'); // end date

            $from_date = Carbon::parse($from_date);
            $to_date = Carbon::parse($to_date);

            $e_wallet_account = $e_wallet_account->whereBetween('created_at', [$from_date, $to_date]);
        }

        return $e_wallet_account;
    }
}