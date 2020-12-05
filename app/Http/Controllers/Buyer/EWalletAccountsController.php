<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EWalletAccountsController extends Controller
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
        $e_wallet_account = auth()->user()->eWalletAccount()->with(['eWalletAccountStatus', 'currency'])->firstOrFail();
// dd($e_wallet_account->toArray());
        return view('dashboard/buyer/e-wallet-account/index', compact(
            'e_wallet_account'
        ));
    }
}
