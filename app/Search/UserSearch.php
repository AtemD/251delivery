<?php 

namespace App\Search;

use App\User;

class UserSearch 
{
    public static function apply($filters){

        $user = (new User)->newQuery();

        // search for user based on their name or products
        if($filters->has('global_user_search')  && !empty($filters->input('global_user_search'))){
            $global_user_search = $filters->input('global_user_search');

            // if you are searching by user name, 
            // there usually is a space between the first and last name...
            // separate the two names for more accurate search results.
            $user_full_name_in_array = explode(" ", $global_user_search);
            $user_name_count = count($user_full_name_in_array);

            if($user_name_count>1){

                $user = $user->where('first_name', 'like',  '%'.$user_full_name_in_array[0].'%')
                        ->orWhere('last_name', 'like', '%'.$user_full_name_in_array[1].'%')
                        ->orWhere('phone_number', 'like', '%'.$global_user_search.'%')
                        ->orWhere('email', 'like', '%'.$global_user_search.'%');
            } else {

                $user = $user->where('first_name', 'like',  '%'.$global_user_search.'%')
                        ->orWhere('last_name', 'like', '%'.$global_user_search.'%')
                        ->orWhere('phone_number', 'like', '%'.$global_user_search.'%')
                        ->orWhere('email', 'like', '%'.$global_user_search.'%');
            }

        }

        if($filters->has('user_account_status')  && !empty($filters->input('user_account_status'))){
            $user = $user->whereHas('userAccountStatus', function($query) use($filters) {
                $query->where('user_account_statuses.id', $filters->input('user_account_status'));
            });
        }
        
        if($filters->has('role')  && !empty($filters->input('role'))){
            $user = $user->whereHas('roles', function($query) use($filters) {
                $query->where('roles.id', $filters->input('role'));
            });
        }

        if($filters->has('city') && !empty($filters->input('city'))){

            $city_id = $filters->input('city');

            $user = $user->whereHas('userLocation', function($query) use($city_id){
                $query->where('city_id', $city_id);
            });
        }

        // Date from - Date to
        if(!empty($filters->input('from_date')) && !empty($filters->input('to_date'))){
            $from_date = $filters->input('from_date'); // start date
            $to_date = $filters->input('to_date'); // end date

            $from_date = Carbon::parse($from_date);
            $to_date = Carbon::parse($to_date);

            $user = $user->whereBetween('created_at', [$from_date, $to_date]);
        }

        return $user;
    }
}