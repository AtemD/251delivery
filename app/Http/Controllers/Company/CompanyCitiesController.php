<?php

namespace App\Http\Controllers\Company;

use App\Models\City;
use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('region.country')->paginate(30);
        $regions = Region::all();

        return view('dashboard/company/settings/cities/index', compact(
            'cities',
            'regions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'description' => 'required|max:255',
            'region_id' => 'required|integer|exists:regions,id',
            'status' => 'nullable'
        ]);

        City::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'description' => $request->description,
            'region_id' => $request->region_id,
            'is_enabled' => (bool)$request->status
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'description' => 'required|max:255',
            'region_id' => 'required|integer|exists:regions,id',
            'status' => 'nullable'
        ]);

        $city->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'description' => $request->description,
            'region_id' => $request->region_id,
            'is_enabled' => (bool)$request->status
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return back();
    }
}
