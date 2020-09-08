<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\ShopType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RetailerShopsController extends Controller
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
    public function index()
    {
        // $this->authorize('view', Shop::class);

        
        $user = Auth::user();

        if(!$user->shops()->exists()) return;

        $shop_types = ShopType::all();

        $shops = $user->shops()->with(['shopAccountStatus', 'shopType'])->orderBy('name', 'asc')->paginate(10);

        return view('dashboard/retailer/shops/index', compact([
            'shops',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

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


        $shop->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'shop_type_id' => $request['shop_type'],
            'banner_image' => $request['banner_image'],
            'logo_image' => $request['logo_image'],
            'average_preparation_time' => $request['average_preparation_time'],
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Shop Updated']);
        }
        
        return back();
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
