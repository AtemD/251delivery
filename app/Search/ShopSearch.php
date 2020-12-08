<?php 

namespace App\Search;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Http\Reqeust;

class ShopSearch 
{
    /**
     * @var int
     */
    // private static $pageSizeLimit = 30;

    public static function apply($filters){
        // session()->flush();
        // Return search results
        $shop = (new Shop)->newQuery();

        if($filters->has('city')){
            $city_id = $filters->input('city');
            session()->put('city', $city_id);
            // $request->session()->forget('city');

            $shop = $shop->whereHas('shopLocation', function($query) use($city_id){
                $query->where('city_id', (int)$city_id);
            });
        }

        // search for shop based on their name or products
        if($filters->has('global_shop_search')){
            $global_shop_search = $filters->input('global_shop_search');

            $shop = $shop->where('name', 'like',  "%$global_shop_search%")->orWhereHas('products', function($query) use($global_shop_search){
                $query->where('name', 'like', "%$global_shop_search%");
            });
        }

        if($filters->has('cuisines')){

            // session()->forget('cuisines');
            // session()->put('cuisines', $filters->input('cuisines'));

            $shop = $shop->whereHas('cuisines', function($query) use($filters) {
                $query->whereIn('cuisines.id', $filters->input('cuisines'));
            });
        }

        if($filters->has('order_type')){
            session()->put('order_type', $filters->input('order_type'));
        }

        if($filters->has('shop_type')){
            // session()->put('shop_types', $filters->input('shop_type'));

            $shop = $shop->whereHas('shopType', function($query) use($filters) {
                $query->whereIn('shop_type.id', $filters->input('shop_type'));
            });
        }

        // This filter has default value based on the user type browsing
        if($filters->has('is_available')){
            $shop = $shop->where('is_available', (bool) $filters->input('is_available'));
        }

        // This filter has default value based on user type browsing
        if($filters->has('shop_account_status')){
            $shop = $shop->whereHas('shopAccountStatus', function($query) use($filters) {
                $query->whereIn('shop_account_status_id', $filters->input('shop_account_status'));
            });
        }

        // if($filters->has('page_size')){
        //     $pageSize = $filters->has('page_size');
        //     $pageSize =  min($pageSize, self::$pageSizeLimit);
        // } else {
        //     $pageSize = self::$pageSizeLimit;
        // }

        
        return $shop; //->simplePaginate($pageSize); 
        // ->appends([
        //     'city_name' => $filters->input('city_name'),
        //     'cuisines' => $filters->input('cuisines'),
        //     'shop_name' => $filters->input('shop_name'),
        //     'cuisines' => $filters->input('cuisines') ,
        //     'page_size' => $filters->input('page_size')
        // ]);
    }
}