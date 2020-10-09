<?php

namespace App\Http\Controllers\Company;

use App\Models\ShopType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopTypesController extends Controller
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
        $this->authorize('view', ShopType::class);

        $shop_types = ShopType::paginate(10);

        return view('dashboard/company/settings/shop-types/index', compact('shop_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', ShopType::class);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'nullable',
        ]);

        ShopType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status,
        ]);

        return back()->with('success', 'New Shop Type Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopType  $shop_type
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopType $shop_type)
    {
        $this->authorize('update', ShopType::class);

        return view('dashboard/company/settings/shop-types/edit', compact(
            'shop_type'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopType  $shop_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopType $shop_type)
    {
        $this->authorize('update', ShopType::class);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'nullable',
        ]);
  
        $shop_type->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status
        ]);

        return back()->with('success', 'Shop Type Udpated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopType  $shop_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopType  $shop_type)
    {
        $this->authorize('delete', ShopType::class);

        $shop_type->delete();
        return back()->with('success', 'Shop Type Deleted Successfully');
    }
}
