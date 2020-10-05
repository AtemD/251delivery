<?php

namespace App\Http\Controllers\Company;

use App\Models\OrderType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_types = OrderType::paginate(10);

        return view('dashboard/company/settings/order-types/index', compact(
            'order_types'
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
            'status' => 'nullable',
        ]);

        OrderType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status,
        ]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderType  $order_type
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderType $order_type)
    {
        return view('dashboard/company/settings/order-types/edit', compact(
            'order_type'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderType  $order_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderType $order_type)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'nullable',
        ]);
  
        $order_type->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status
        ]);

        return back()->with('success', 'Order Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderType  $order_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderType $order_type)
    {
        $order_type->delete();
        return back()->with('success', 'Order Type Deleted Successfully');
    }
}
