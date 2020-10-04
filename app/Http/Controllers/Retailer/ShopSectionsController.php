<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopSectionsController extends Controller
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
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        // Check if the user is authorized to view this shop
        $this->authorize('view', $shop);

        
        // Authorize if the user is allowed to view sections
        $this->authorize('view', Section::class);
        
        // Gell all the sections of this shop with their products
        $sections = $shop->sections()->with([
            'products'  => function($query) {
                $query->orderBy('name', 'asc');
            },
        ])->paginate(30);

        return view('dashboard/retailer/settings/sections/index', compact([
            'shop',
            'sections'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize that the user can create sections
        $this->authorize('create', Section::class);

        // Retrieve the shop to determine if it exists
        $shop = Shop::findOrFail($request->shop);

        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'shop' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);

        Section::create([
            'name' => $request->name,
            'shop_id' => $shop->id,
            'description' => $request->description,
        ]);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'New Section Created Successfully']);
        }
        
        return back()->with('success', 'New Section Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Section $section)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update sections
        $this->authorize('update', Section::class);

        $section = $section->load('products');

        return view('dashboard/retailer/settings/sections/edit', compact(
            'shop',
            'section'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop 
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Section $section)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);
        
        // Authorize that the user can update sections
        $this->authorize('update', Section::class);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'shop' => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        $section->update([
            'name' => $request->name,
            'description' => $request->description,
            'shop_id' => $shop->id,
        ]);
        
        return redirect()->route('retailer.sections.index', ['shop' => $shop])->with('success', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param \App\Models\Shop $shop
     * @param \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Section $section)
    {
        // Authorize if the user can view the shop
        $this->authorize('view', $shop);

        // Authorize that the user can update sections
        $this->authorize('delete', Section::class);

        $section->delete();

        return back()->with('success', 'Section Deleted Successfully');
    }
}
