<?php

namespace App\Http\Controllers\Company;

use App\Models\Region;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyRegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::with('country')->paginate(30);
        $countries = Country::all();

        return view('dashboard/company/settings/regions/index', compact(
            'regions',
            'countries'
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
            'country_id' => 'required|integer|exists:countries,id',
            'status' => 'nullable'
        ]);

        Region::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'country_id' => $request->country_id,
            'is_enabled' => (bool)$request->status
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'country_id' => 'required|integer|exists:countries,id',
            'status' => 'nullable'
        ]);

        $region->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'country_id' => $request->country_id,
            'is_enabled' => (bool)$request->status
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return back();
    }
}
