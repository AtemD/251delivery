<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Discount;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailerDiscountsController extends Controller
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

        $discounts = $shop->discounts()->orderBy('name', 'asc')->paginate(15);

        return view('dashboard/retailer/settings/discounts/index', compact([
            'shop',
            'discounts',
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
        // Authorize that the user can create discounts
        $this->authorize('create', Discount::class);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // regex:/^\d+(\.\d{1,2})?$/
        // name, rate, rate_type, shop_id, is_enabled, 
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'rate' => 'required|regex:/^\d+(?:\.\d{0,2})?$/',
            'rate_type' => 'required|string|in:' . Discount::PERCENTAGE_DISCOUNT . ',' . Discount::CURRENCY_DISCOUNT,
            'shop' => 'required|integer',
            'status' => 'required|integer',
        ]);

        Discount::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'shop_id' => $shop->id,
            'is_enabled' => (bool) $request->status,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Discount Created']);
        }
        
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @param  \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Discount $discount)
    {
        return view('dashboard/retailer/settings/discounts/edit', compact(
            'shop',
            'discount'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Discount $discount)
    {
        // Authorize that the user can create discounts
        $this->authorize('update', Discount::class);

        // Retrieve the shop to determine if it exists
        // $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // name, rate, rate_type, shop_id, is_enabled, 
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'rate' => 'required|regex:/^\d+(?:\.\d{0,2})?$/',
            'rate_type' => 'required|string|in:' . Discount::PERCENTAGE_DISCOUNT . ',' . Discount::CURRENCY_DISCOUNT,
            'shop' => 'required|string',
            'status' => 'nullable',
        ]);

        $discount->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'shop_id' => $shop->id,
            'is_enabled' => (bool) $request->status,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Discount Updated Successfully']);
        }

        return redirect()->route('retailer.discounts.index', ['shop' => $shop, 'discount' => $discount])->with('success', 'Discount Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop $shop
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Discount $discount)
    {
        // Authorize that the user can update products
        $this->authorize('delete', Discount::class);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        $discount->delete();

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Discount Deleted Successfully']);
        }

        return back()->with('success', 'Discount Deleted Successfully');
    }
}
