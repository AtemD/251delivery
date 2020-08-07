<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\City;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$this->validate($request, array(
			'city_name' => 'required|exists:cities,name',
		));

		$city_name = $request->input('city_name');
        $city_id = City::where('name', '=', $city_name)->pluck('id')->first();

        $shops = Shop::whereHas('location', function($query) use($city_id){
                    $query->where('city_id', '=', $city_id);
                })->with([
                    'cuisines',
                    'shopType'
                ]);

        $shops = $shops->paginate(15)->appends([
            'city_name' => $request->input('city_name'),
        ]);

		return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $shop = $shop->load([
            'shopType',
            'location',
            'cuisines',
            'sections.products',
            'location.city.region.country',
        ]);

        // dd($shop->toArray());
        return view('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
