<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopProductAvailabilityController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop 
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Product $product)
    {
        $this->authorize('view', $shop);
        $this->authorize('update', $product);
        
        $this->validate($request,[
            'availability' => 'nullable',
        ]);

        // Since the vue form submits the opposite of the actual value, 
        // make sure to get the opposite of the availability
        // ...until you solve the vuejs bug, make sure to use the 'not operator' on availability request value
        $product->update([
            'is_available' => !(bool)$request->availability,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Product Availability Updated Successfully']);
        }
        
        return redirect()->route('retailer.products.index', ['shop' => $shop, 'product' => $product])->with('success', 'Product Availability Updated Successfully');
    }
}
