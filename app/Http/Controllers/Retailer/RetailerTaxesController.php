<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Tax;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailerTaxesController extends Controller
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

        $taxes = $shop->taxes()->orderBy('name', 'asc')->paginate(15);

        return view('dashboard/retailer/settings/taxes/index', compact([
            'shop',
            'taxes',
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
        // Authorize that the user can create taxes
        $this->authorize('create', Tax::class);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // regex:/^\d+(\.\d{1,2})?$/
        // name, rate, rate_type, shop_id, is_enabled, 
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'rate' => 'required|regex:/^\d+(?:\.\d{0,2})?$/',
            'rate_type' => 'required|string|in:' . Tax::PERCENTAGE_TAX,
            'shop' => 'required|integer',
            'status' => 'required|integer|in:' . Tax::ENABLED_TAX . ',' . TAX::DISABLED_TAX,
        ]);

        Tax::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'shop_id' => $shop->id,
            'is_enabled' => (bool) $request->status,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Tax Created']);
        }
        
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop
     * @param \App\Models\Tax $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Tax $tax)
    {
        // Authorize that the user can create taxes
        $this->authorize('update', Tax::class);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // name, rate, rate_type, shop_id, is_enabled, 
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'rate' => 'required|regex:/^\d+(?:\.\d{0,2})?$/',
            'rate_type' => 'required|string|in:' . Tax::PERCENTAGE_TAX,
            'shop' => 'required|integer',
            'status' => 'required|integer|in:' . Tax::ENABLED_TAX . ',' . TAX::DISABLED_TAX,
        ]);

        $tax->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'shop_id' => $shop->id,
            'is_enabled' => (bool) $request->status,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Tax Updated Successfully']);
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop $shop
     * @param \App\Models\Tax $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Tax $tax)
    {
        // Authorize that the user can update products
        $this->authorize('delete', Tax::class);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        $tax->delete();

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Tax Deleted Successfully']);
        }

        return back();
    }
}
