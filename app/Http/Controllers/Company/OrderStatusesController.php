<?php

namespace App\Http\Controllers\Company;

use App\Models\OrderStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderStatusesController extends Controller
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
        $this->authorize('view', OrderStatus::class);

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
        $this->authorize('create', OrderStatus::class);

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

        return back()->with('success', 'Order Status Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatus  $order_status
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $order_status)
    {
        $this->authorize('update', OrderStatus::class);

        return view('dashboard/company/settings/order-statuses/edit', compact(
            'order_status',
        ));
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
        $this->authorize('update', OrderStatus::class);

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

        return back()->with('success', 'Order Status Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus $order_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $order_status)
    {
        $this->authorize('delete', OrderStatus::class);

        $order_status->delete();
        return back()->with('success', 'Order Status Deleted Successfully');
    }
}
