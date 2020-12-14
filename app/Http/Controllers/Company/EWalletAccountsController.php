<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\EWalletAccount;
use App\Http\Controllers\Controller;
use App\Models\EWalletAccountStatus;
use App\Search\EWalletAccountSearch;
use Illuminate\Support\Facades\Validator;

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
    public function index(Request $request)
    {
        $this->authorize('view', EWalletAccount::class);

        // Apply the request e-wallet account filters
        $e_wallet_accounts = EWalletAccountSearch::apply($request);
        
        $e_wallet_accounts = $e_wallet_accounts->with([
            'eWalletAccountStatus', 
            'currency', 
            'user'
        ])->simplePaginate();

        $e_wallet_account_statuses = EWalletAccountStatus::all();

        return view('dashboard/company/e-wallet-accounts/index', compact(
            'e_wallet_accounts',
            'e_wallet_account_statuses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', EWalletAccount::class);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize if the user allowed to perform this action 
        $this->authorize('create', EWalletAccount::class);

        // Validate, also vital to validate if user exists in the database
        $validator = Validator::make($request->all(), [
            'user' => 'required|max:255|exists:users,slug',
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem with creating user E-Wallet account!');
        }

        $user = User::where('slug', $request->user)->with('userAccountStatus')->firstOrFail();

        // Check if the user has a verified account.
        if(empty($user->userAccountStatus)){
            return back()->with('error', 'User account is unverified!');
        } else {

            if($user->userAccountStatus->name != User::VERIFIED_USER){
                return back()->with('error', 'User account is unverified!');
            }
        }

        // Create the new E-Wallet account
        $e_wallet_account = EWalletAccount::create([
            'user_id' => $user->id,
            'number' => \Carbon\Carbon::now()->timestamp . $user->id,
            'status_by' => auth()->user()->id,
            'e_wallet_account_status_id' => EWalletAccountStatus::where('name', EWalletAccountStatus::UNVERIFIED_ACCOUNT)->firstOrFail()->id,
            'currency_id' => Currency::where('name', Currency::ETHIOPIAN_BIRR)->firstOrFail()->id,
        ]);

        // Notify the user that a new wallet account has been created
        $user->notify(new EWalletAccountCreated($e_wallet_account));
        // Nofiy the currenty authenticated user that a new wallet has been created
        auth()->user()->notify(new EWalletAccountCreated($e_wallet_account));

        return redirect()->route('company.e-wallet-accounts.edit', ['e_wallet_account'=> $e_wallet_account->number])
            ->with('success', 'E-Wallet Account Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  EWalletAccount  $e_wallet_account
     * @return \Illuminate\Http\Response
     */
    public function edit(EWalletAccount $e_wallet_account)
    {
        $this->authorize('update', $e_wallet_account);

        $e_wallet_account_statuses = EWalletAccountStatus::all();

        $e_wallet_accounts = $e_wallet_account->load(['eWalletAccountStatus', 'currency', 'user']);

        return view('dashboard/company/e-wallet-accounts/edit', compact(
            'e_wallet_account',
            'e_wallet_account_statuses'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EWalletAccount $e_wallet_account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EWalletAccount $e_wallet_account)
    {
        $this->validate($request,[
            'is_active' => 'nullable',
        ]);
     
        $this->authorize('update', $e_wallet_account);

        $e_wallet_account->update([
            'is_active' => (bool) $request->is_active,
            // 'status_by' => Auth::user()->id,
            // 'status_date' => now()
        ]);
    
        return back()->with('success', 'E-Wallet Account is_active State Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EWalletAccount $e_wallet_account)
    {
        $this->authorize('delete', $e_wallet_account);
    }
}
