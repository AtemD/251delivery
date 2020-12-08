<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use App\Models\Cuisine;
use App\Models\OrderType;
use App\Search\ShopSearch;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($request->city) || empty($request->order_type)) {
            return redirect()->route('pages.welcome');
        }
        // You can validate the request, to display any errors in the front end to the user.
        // $reqeust->validate([

        // ]);

        // Get all shops for the specific city.
        // Shop account status should be verified and is_available should be true.
        // $shops = Shop::whereHas('shopLocation', function($query) use($city_id){
        //             $query->where('city_id', '=', $city_id);
        //         })->with([
        //             'cuisines',
        //             'shopType'
        //         ]);

        /**
         * city_name, order_type, shop_type, shop_name, 
         * DEFAULT FILTERS for this page: is_available=>true, shop_account_status=>verified
         */
        // if you hit this controller then you are a normal user,
        // store default filters in the session,
        // apply_normal_user_default_filters => true or false
        // apply_retailer_user_default_filters
        // apply_driver_user_filters

        // Apply shop local scope (e.g retrieve verified shops based on the given filters) here or with the filters
        $shops = ShopSearch::apply($request);
        $shops = $shops->status(Shop::VERIFIED_SHOP)->with([
            'cuisines',
            'shopType'
        ])->simplePaginate(35);

        // dd($shops->toArray());

        $cuisines = Cuisine::all();
        $cities = City::all();
        $order_types = OrderType::all();

		return view('shops.index', compact([
            'shops',
            'cuisines',
            'cities',
            'order_types'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $shop = $shop->load([
            'shopLocation',
            'shopType',
            'cuisines',
            'sections.products',
            'shopLocation.city.region.country',
        ]);
// dd($shop->toArray());
        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
