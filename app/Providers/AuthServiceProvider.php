<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\City' => 'App\Policies\CityPolicy',
        'App\Models\Country' => 'App\Policies\CountryPolicy',
        'App\Models\Region' => 'App\Policies\RegionPolicy',
        'App\Models\OrderStatus' => 'App\Policies\OrderStatusPolicy',
        'App\Models\ShopAccountStatus' => 'App\Policies\ShopAccountStatusPolicy',
        'App\Models\UserAccountStatus' => 'App\Policies\UserAccountStatusPolicy',
        'App\Models\OrderType' => 'App\Policies\OrderTypePolicy',
        'App\Models\ShopType' => 'App\Policies\ShopTypePolicy',
        'App\Models\PaymentMethod' => 'App\Policies\PaymentMethodPolicy',
        'App\Models\Shop' => 'App\Policies\ShopPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Tax' => 'App\Policies\TaxPolicy',
        'App\Models\Discount' => 'App\Policies\DiscountPolicy',
        'App\Models\Cuisine' => 'App\Policies\CuisinePolicy',
        'App\Models\ShopLocation' => 'App\Policies\ShopLocationPolicy',
        'App\Models\Section' => 'App\Policies\SectionPolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
