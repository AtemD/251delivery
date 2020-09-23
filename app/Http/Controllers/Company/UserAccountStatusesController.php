<?php

namespace App\Http\Controllers\Company;

use App\Models\UserAccountStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAccountStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_account_statuses = UserAccountStatus::paginate(10);

        return view('dashboard/company/settings/user-account-statuses/index', compact(
            'user_account_statuses'
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

        UserAccountStatus::create([
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
     * @param  \App\Models\UserAccountStatus $user_account_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAccountStatus $user_account_status)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $user_account_status->update([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccountStatus $user_account_status)
    {
        $user_account_status->delete();
        return back();
    }
}
