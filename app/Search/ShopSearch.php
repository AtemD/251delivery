<?php 

namespace App\Search;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Http\Reqeust;

class ShopSearch 
{
    public static function apply($filters){
        // session()->flush();
        // Return search results
        $shop = (new Shop)->newQuery();

        if($filters->has('city') && !empty($filters->input('city'))){
            $city_id = $filters->input('city');
            session()->put('city', $city_id);
            // $request->session()->forget('city');

            $shop = $shop->whereHas('shopLocation', function($query) use($city_id){
                $query->where('city_id', $city_id);
            });
        }

        // search for shop based on their name or products
        if($filters->has('global_shop_search')  && !empty($filters->input('global_shop_search'))){
            $global_shop_search = $filters->input('global_shop_search');

            $shop = $shop->where('name', 'like',  "%$global_shop_search%")->orWhereHas('products', function($query) use($global_shop_search){
                $query->where('name', 'like', "%$global_shop_search%");
            });
        }

        if($filters->has('cuisines')  && !empty($filters->input('cuisines'))){

            // session()->forget('cuisines');
            // session()->put('cuisines', $filters->input('cuisines'));

            $shop = $shop->whereHas('cuisines', function($query) use($filters) {
                $query->whereIn('cuisines.id', $filters->input('cuisines'));
            });
        }

        if($filters->has('order_type')  && !empty($filters->input('order_type'))){
            session()->put('order_type', $filters->input('order_type'));
        }

        if($filters->has('shop_type')  && !empty($filters->input('shop_type'))){
            $shop_type_id = $filters->input('shop_type');

            $shop = $shop->whereHas('shopType', function($query) use($shop_type_id) {
                $query->where('shop_types.id', $shop_type_id);
            });
        }

        // This filter has default value based on the user type browsing
        if($filters->has('is_available')  && !empty($filters->input('is_available'))){
            $is_available = $filters->input('is_available') == "available" ? "1" : "0";

            $shop = $shop->where('is_available', (bool)$is_available);
        }

        // This filter has default value based on user type browsing
        if($filters->has('shop_account_status')  && !empty($filters->input('shop_account_status'))){
            $shop = $shop->whereHas('shopAccountStatus', function($query) use($filters) {
                $query->where('shop_account_statuses.id', $filters->input('shop_account_status'));
            });
        }
        
        return $shop;
    }
}