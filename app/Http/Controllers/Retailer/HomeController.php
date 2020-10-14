<?php

namespace App\Http\Controllers\Retailer;

use App\Models\ShopType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $shops = Auth::user()->shops()->paginate(25);
        $shops_count = $shops->count();

        // A user with more than one shop, has to choose which shop to manage.
        // A user with no shops has to first register one.
        // if($shops_count > 1 || $shops_count==0){
            
            $shop_types = ShopType::all();
            
            return view('dashboard/retailer/switch-shops', compact([
                'shops',
                'shop_types'
            ]));
        // }

        // else if a user has only one shop redirect to that specific shops route
        // if($shops_count == 1){
        //     $shop = $shops->first();
        //     return redirect()->route('retailer.shops.index', ['shop' => $shop]);
        // }
        
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
