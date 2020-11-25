<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopProductDiscountsController extends Controller
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
        $this->authorize('update', $product);

        $this->authorize('view', $shop);

        $this->validate($request,[
            'discounts' =>'nullable',
        ]);

        $product->discounts()->sync($request->discounts);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Product Discounts Updated']);
        }
        
        return redirect()->back()->with('success', 'Product Discounts Updated Successfully');
    }

    
}
