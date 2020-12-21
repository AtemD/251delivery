<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\OpeningHours\OpeningHours;

class ShopOpeningHoursController extends Controller
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

        // Authorize if the user is allowed to view the opening hours
        $this->authorize('view', OpeningHours::class);

        return view('dashboard/retailer/settings/opening-hours/index', compact([
            'shop',
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
        // dd($shop->toArray());
        // Authorize if the user is allowed to view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update cuisines
        $this->authorize('update', OpeningHours::class);

        return view('dashboard/retailer/settings/opening-hours/edit', compact(
            'shop',
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
        $this->authorize('update', OpeningHours::class);

        // validate the request
        $this->validate($request,[
            'monday_from' => 'nullable|required_with:monday_to|date_format:H:i',
            'monday_to' => 'nullable|required_with:monday_from|date_format:H:i',

            'tuesday_from' => 'nullable|required_with:tuesday_to|date_format:H:i',
            'tuesday_to' => 'nullable|required_with:tuesday_from|date_format:H:i',

            'wednesday_from' => 'nullable|required_with:wednesday_to|date_format:H:i',
            'wednesday_to' => 'nullable|required_with:wednesday_from|date_format:H:i',

            'thursday_from' => 'nullable|required_with:thursday_to|date_format:H:i', 
            'thursday_to' => 'nullable|required_with:thursday_from|date_format:H:i',

            'friday_from' => 'nullable|required_with:friday_to|date_format:H:i',
            'friday_to' => 'nullable|required_with:friday_from|date_format:H:i',

            'saturday_from' => 'nullable|required_with:saturday_to|date_format:H:i',
            'saturday_to' => 'nullable|required_with:saturday_from|date_format:H:i',

            'sunday_from' => 'nullable|required_with:sunday_to|date_format:H:i',
            'sunday_to' => 'nullable|required_with:sunday_from|date_format:H:i'
        ]);

        $shop->update([
            'opening_hours' => [
                'monday' => (empty($request->monday_from) || empty($request->monday_to))? [] : [$request->monday_from . '-' . $request->monday_to],
                'tuesday' => (empty($request->tuesday_from) || empty($request->tuesday_to))? [] : [$request->tuesday_from . '-' . $request->tuesday_to],
                'wednesday' => (empty($request->wednesday_from) || empty($request->wednesday_to))? [] : [$request->wednesday_from . '-' . $request->wednesday_to],
                'thursday' => (empty($request->thursday_from) || empty($request->thursday_to))? [] : [$request->thursday_from . '-' . $request->thursday_to],
                'friday' => (empty($request->friday_from) || empty($request->friday_to))? [] : [$request->friday_from . '-' . $request->friday_to],
                'saturday' => (empty($request->saturday_from) || empty($request->saturday_to))? [] : [$request->saturday_from . '-' . $request->saturday_to],
                'sunday' => (empty($request->sunday_from) || empty($request->sunday_to))? [] : [$request->sunday_from . '-' . $request->sunday_to],
            ],
        ]);
        
        return back()->with('success', 'Opening Hours Updated Successfully');
    }

}
