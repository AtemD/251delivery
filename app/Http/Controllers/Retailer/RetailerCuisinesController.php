<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailerCuisinesController extends Controller
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
     * Displays all of the cuisines choosen by the specific shop
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        // Authorize if the user is allowed to view the shop
        $this->authorize('view', $shop);

        // Authorize if the user is allowed to view cuisines
        $this->authorize('view', Cuisine::class);

        $shop = $shop->load('cuisines');

        return view('dashboard/retailer/settings/cuisines/index', compact([
            'shop'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        // Authorize that the user can update cuisines
        $this->authorize('update', Cuisine::class);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        $shop = $shop->load('cuisines');

        $cuisines = Cuisine::all();

        return view('dashboard/retailer/settings/cuisines/edit', compact(
            'shop',
            'cuisines'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update the cuisine
        $this->authorize('update', Cuisine::class);

        // validate the request
        $this->validate($request,[
            'cuisines' => 'nullable',
        ]);

        // Make sure to validate that these cuisine ids exist in the database
        $cuisines = Cuisine::all();
        $filtered = $cuisines->whereIn('id', $request->cuisines);

        $shop->cuisines()->sync($filtered->pluck('id'));
        
        return redirect()->route('retailer.cuisines.index', ['shop' => $shop])->with('success', 'Cuisines Updated Successfully');
    }

}
