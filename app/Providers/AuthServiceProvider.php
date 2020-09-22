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
        'App\Models\Shop' => 'App\Policies\ShopPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Tax' => 'App\Policies\TaxPolicy',
        'App\Models\Discount' => 'App\Policies\DiscountPolicy',
        'App\Models\Cuisine' => 'App\Policies\CuisinePolicy',
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
