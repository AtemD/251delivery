<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\ShopType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopAccountsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);

        $shop_types = ShopType::all();

        $shop = $shop->load(['shopType', 'shopAccountStatus']);

        return view('dashboard/retailer/settings/accounts/index', compact([
            'shop',
            'shop_types'
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
        $this->authorize('create', Shop::class);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|string|email|max:191',
            'phone_number' => 'required',
            'shop_type' => 'required|integer',
            'banner_image' => 'required|string',
            'logo_image' => 'required|string',
            'average_preparation_time' => 'required|string',
        ]);

        $shop = Shop::class;

        DB::transaction(function() use(&$shop, $request){
           $shop = Shop::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'shop_type_id' => $request['shop_type'],
                'banner_image' => $request['banner_image'],
                'logo_image' => $request['logo_image'],
                'average_preparation_time' => $request['average_preparation_time'],
            ]);
            
            Auth::user()->shops()->attach($shop);
        }, 3);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Shop Created']);
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
        $this->authorize('update', $shop);

        $shop_types = ShopType::all();

        $shop = $shop->load(['shopType', 'shopAccountStatus']);

        return view('dashboard/retailer/settings/accounts/edit', compact([
            'shop',
            'shop_types'
        ]));
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
        // dd($request->all());
        $this->authorize('update', $shop);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2040',
            'email' => 'required|string|email|max:191',
            'phone_number' => 'required',
            'shop_type' => 'required|integer',
            'max_food_preparation_time' => 'required|integer|between:1,60',
            'min_food_preparation_time' => 'required|integer|between:1,60',
        ]);

        $shop->update([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'shop_type_id' => $request->shop_type,
            'average_preparation_time' => $request->min_food_preparation_time . '-' . $request->max_food_preparation_time,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Shop Account Updated']);
        }
        
        return redirect()->route('retailer.shops.accounts.index', ['shop' => $shop])->with('success', 'Shop Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        // $this->authorize('update', $reply);

        $shop->delete();

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Shop Deleted']);
        }

        return back();
    }

}
