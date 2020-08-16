<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => function() {
        	return factory('App\User')->create()->id;
        },
        'order_type_id' => function() {
        	return factory('App\Models\OrderType')->create()->id;
        },
        'payment_method_id' => function() {
        	return factory('App\Models\PaymentMethod')->create()->id;
        },
        'delivery_address' => $faker->streetAddress,
        'special_requests' => $faker->sentence,
        'estimate_delivery_time' => $faker->dateTimeThisYear('now'),
        'actual_delivery_time' => $faker->dateTimeThisYear('now'),
        'order_status_id' => function() {
        	return factory('App\Models\OrderStatus')->create()->id;
        },
        'status_by' => function() {
        	return factory('App\User')->create()->id;
        },
        'status_date' => now()
    ];
});
