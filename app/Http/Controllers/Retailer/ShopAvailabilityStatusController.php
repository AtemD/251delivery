<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopAvailabilityStatusController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $this->validate($request,[
            'availability_status' => 'nullable',
        ]);

        $shop->is_available = (bool) $request->availability_status;
        $shop->save();
    
        return redirect()->route('retailer.shops.accounts.index', ['shop' => $shop])->with('success', 'Shop Availability Status Updated Successfully');
    }
}
