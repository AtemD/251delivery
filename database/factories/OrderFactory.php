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
        	return factory('App\OrderType')->create()->id;
        },
        'payment_method_id' => function() {
        	return factory('App\PaymentMethod')->create()->id;
        },
        'total_price' => $faker->randomElement([3000, 4500, 6500, 7500, 15000]),
        'delivery_address' => $faker->streetAddress,
        'special_requests' => $faker->sentence,
        'estimate_delivery_time' => $faker->dateTimeThisYear('now'),
        'actual_delivery_time' => $faker->dateTimeThisYear('now'),
        'status' => $faker->randomElement([
                Order::PENDING_ORDER, 
                Order::APPROVED_ORDER,
                Order::READY_ORDER,
                Order::DELIVERING_ORDER,
                Order::COMPLETED_ORDER,
                Order::CANCELLED_ORDER,
        ]),
    ];
});
