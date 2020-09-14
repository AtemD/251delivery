<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RetailerProductsController extends Controller
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
    public function index(Shop $shop)
    {
        // A list of all products of that specific shop
        // $user = Auth::user();

        // if(!$user->shops()->exists()) return;

        // $shop_types = ShopType::all();

        // $shops = $user->shops()->with(['products'])->orderBy('name', 'asc')->paginate(10);

        // return view('dashboard/retailer/products/index', compact([
        //     'shops'
        // ]));

        // Determine if the user is authorized to perform view the products of this shops
        // $this->authorize('view', $shop);

        // Get all the products of this shop
        $products = $shop->products()->with('section')->orderBy('name', 'asc')->paginate(10);
        
        // dd($products->toArray());
        // Authorize if the user is allowed to view products
        $this->authorize('view', $products->first());

        return view('dashboard/retailer/products/index', compact([
            'shop',
            'products'
        ]));
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
    public function show($id)
    {
        //
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
