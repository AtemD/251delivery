<?php

namespace App\Http\Controllers\Company;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountriesController extends Controller
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
        $countries = Country::paginate(3);

        return view('dashboard/company/settings/countries/index', compact(
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
            'currency_name' => 'required|max:255',
            'currency_abbreviation' => 'required|max:255',
            'status' => 'nullable'
        ]);

        Country::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'currency_name' => $request->currency_name,
            'currency_abbreviation' => $request->currency_abbreviation,
            'is_enabled' => (bool)$request->status
        ]);

        return back()->with('success', 'New Country Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('dashboard/company/settings/countries/edit', compact(
            'country',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'currency_name' => 'required|max:255',
            'currency_abbreviation' => 'required|max:255',
            'status' => 'nullable'
        ]);

        $country->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'currency_name' => $request->currency_name,
            'currency_abbreviation' => $request->currency_abbreviation,
            'is_enabled' => (bool)$request->status
        ]);

        return back()->with('success', 'Country Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return back()->with('success', 'Country Deleted Successfully');
    }
}
