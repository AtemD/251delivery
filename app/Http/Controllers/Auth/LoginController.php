<?php

namespace App\Http\Controllers\Auth;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->hasPermissionTo(Permission::ACCESS_RETAILER_DASHBOARD)
            && !$user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){

            // User is retailer
            return redirect()->intended(route('retailer.shops'));

        } else if($user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){

            // User is administrator
            return redirect()->intended(route('company.home'));

        } else {
            // User is normal buyer

            // Determine if the session has a shop stored in session
            //...if so the user was trying to checkout but had to login first,
            //...instead of redirecting the home page, redirect to the shop the user was on.
            if($request->session()->has('shop_slug')){
                return redirect()->route('shops.show', ['shop'=>session()->get('shop_slug')]);
            }

            return redirect()->intended(route('buyers.home'));
        }
    }
}
