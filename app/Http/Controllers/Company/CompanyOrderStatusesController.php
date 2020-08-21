<?php

namespace App\Http\Controllers\Company;

use App\Models\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyOrderStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_statuses = OrderStatus::paginate(10);

        return view('dashboard/company/settings/order-statuses/index', compact(
            'order_statuses'
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

        OrderStatus::create([
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
     * @param  \App\Models\OrderStatus $order_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderStatus $order_status)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $order_status->update([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus $order_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $order_status)
    {
        $order_status->delete();
        return back();
    }
}
