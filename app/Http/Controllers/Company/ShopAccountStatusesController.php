<?php

namespace App\Http\Controllers\Company;

use App\Models\ShopAccountStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopAccountStatusesController extends Controller
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
        $shop_account_statuses = ShopAccountStatus::paginate(10);

        return view('dashboard/company/settings/shop-account-statuses/index', compact(
            'shop_account_statuses'
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
            'description' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        ShopAccountStatus::create([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color,
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopAccountStatus $shop_account_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopAccountStatus $shop_account_status)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $shop_account_status->update([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopAccountStatus $shop_account_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopAccountStatus $shop_account_status)
    {
        $shop_account_status->delete();
        return back();
    }
}
