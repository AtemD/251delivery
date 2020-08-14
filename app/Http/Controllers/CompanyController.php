<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Shop;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops_count = Shop::count();
        $users_count = User::count();

        // pending, approved, ready, delivering, completed, cancelled

        $orders_count = DB::table('orders')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
        ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
        ->selectRaw("count(case when status = 'ready' then 1 end) as ready")
        ->selectRaw("count(case when status = 'delivering' then 1 end) as delivering")
        ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
        ->selectRaw("count(case when status = 'cancelled' then 1 end) as cancelled")
        ->first();
        
        $todays_orders = Order::whereRaw('date(created_at) = ?', [Carbon::today()])
            ->with(['products'])
            ->paginate(30);
            
        $todays_orders_count = Order::whereRaw('date(created_at) = ?', [Carbon::today()])->count();

            // dd($todays_orders->toArray());

        return view('dashboard/company/home', compact([
            'shops_count',
            'users_count',

            'orders_count',
            'todays_orders',
            'todays_orders_count'
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
