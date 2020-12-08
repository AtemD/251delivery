<?php

namespace App\Http\Controllers\Company;

use App\Models\Shop;
use App\Models\ShopType;
use Illuminate\Http\Request;
use App\Models\ShopAccountStatus;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
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
        $this->authorize('viewAny', Shop::class);

        $shops = Shop::with([
            'shopType',
            'shopAccountStatus',
        ])->paginate(45);

        return view('dashboard/company/shops/index', compact([
            'shops',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Shop::class);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop  $shop)
    {
        // Here we show all the details of the shop
        // Summary of all shop products, orders, statuses, sections, users, etc
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop);

        $shop = $shop->load([
            'shopType',
            'shopAccountStatus'
        ]);

        $shop_account_statuses = ShopAccountStatus::all();

        return view('dashboard/company/shops/edit', compact([
            'shop',
            'shop_account_statuses'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop  $shop)
    {
        // here we update the account status of the shop
        $this->authorize('update', $shop);
        
        $this->validate($request,[
            'shop_account_status' => 'required|integer|exists:shop_account_statuses,id',
        ]);

        $shop->update([
            'shop_account_status_id' => $request->shop_account_status,
        ]);

        return back()->with('success', 'Shop Account Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop  $shop)
    {
        $this->authorize('delete', Shop::class);
    }
}
