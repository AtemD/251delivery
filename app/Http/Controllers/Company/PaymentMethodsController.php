<?php

namespace App\Http\Controllers\Company;

use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::paginate(10);

        return view('dashboard/company/settings/payment-methods/index', compact([
            'payment_methods',
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'nullable',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status,
        ]);

        return back()->with('success', 'Payment Method Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $payment_method)
    {
        return view('dashboard/company/settings/payment-methods/edit', compact(
            'payment_method'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $payment_method)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'nullable',
        ]);
  
        $payment_method->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => (bool)$request->status
        ]);

        return back()->with('success', 'Payment Method Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $payment_method->delete();
        return back()->with('success', 'Payment Method Deleted Successfully');
    }
}
