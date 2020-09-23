<?php

namespace App\Http\Controllers\Retailer;

use App\Models\City;
use App\Models\Shop;
use App\Models\ShopLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopLocationsController extends Controller
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
     * Display a listing of the resource.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);

        $this->authorize('view', ShopLocation::class);

        $shop = $shop->load('shopLocation.city');

        $cities = City::all();

        return view('dashboard/retailer/settings/locations/index', compact([
            'shop',
            'cities'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize that the user can view the shop
        // $this->authorize('view', $shop);

        // Authorize that the user can update locations
        // $this->authorize('create', ShopLocation::class);

        // city_id, postal_code, street, building, specific_information, address, latitude, longitude, shop_id 
        // 'base_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        $this->validate($request,[
            'city' => 'required|integer|exists:cities,id',
            'postal_code' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'specific_information' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'], 
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ]);

        $shop->shopLocation()->create([
            'city_id' => $request->city,
            'postal_code' => $request->postal_code,
            'street' => $request->street,
            'building' => $request->building,
            'specific_information' => $request->specific_information,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('retailer.locations.index', ['shop' => $shop])->with('success', 'Location Updated Successfully');

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Location Created']);
        }
        
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $this->authorize('view', $shop);

        $this->authorize('update', ShopLocation::class);

        $shop = $shop->load('shopLocation');

        $cities = City::all();

        return view('dashboard/retailer/settings/locations/edit', compact(
            'shop',
            'cities'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        // Authorize that the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update locations
        $this->authorize('update', ShopLocation::class);

        // city_id, postal_code, street, building, specific_information, address, latitude, longitude, shop_id 
        // 'base_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        $this->validate($request,[
            'city' => 'required|integer|exists:cities,id',
            'postal_code' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'specific_information' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'], 
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ]);

        $shop->shopLocation()->update([
            'city_id' => $request->city,
            'postal_code' => $request->postal_code,
            'street' => $request->street,
            'building' => $request->building,
            'specific_information' => $request->specific_information,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Discount Updated Successfully']);
        }

        return redirect()->route('retailer.locations.index', ['shop' => $shop])->with('success', 'Location Updated Successfully');
    }

}
