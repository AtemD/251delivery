<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Discount;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'rate' => $faker->randomElement([5, 10, 15]),
        'rate_type' => $faker->randomElement([Discount::PERCENTAGE_DISCOUNT, Discount::CURRENCY_DISCOUNT]),
        'shop_id' => function () {
            return factory('App\Models\Shop')->create()->id;
        },
    ];
});
