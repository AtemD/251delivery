<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use App\Models\EWalletAccount;
use Faker\Generator as Faker;

$factory->define(EWalletAccount::class, function (Faker $faker) {
    // 'number', 'user_id', 'balance', 'is_active', 'e_wallet_account_status_id', 'status_by', 'currency_id',

    return [
        'number' => Carbon::now()->timestamp,
        'user_id' => function() {
        	return factory('App\User')->create()->id;
        },
        'balance' => $faker->randomElement([mt_rand(1, 100), mt_rand(200, 1000), mt_rand(60, 1000)]),
        'is_active' => rand(0,1) == 1, 
        'e_wallet_account_status_id' => function() {
        	return factory('App\Models\EWalletAccountStatus')->create()->id;
        },
        'status_by' => function() {
        	return factory('App\User')->create()->id;
        },
        'currency_id' => function() {
        	return factory('App\Models\Currency')->create()->id;
        },
        // 'status_date' => now()
    ];
});
