<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tax;
use Faker\Generator as Faker;

$factory->define(Tax::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'rate' => $faker->randomElement([5, 10, 15]),
        'rate_type' => Tax::PERCENTAGE_TAX,
        'shop_id' => function () {
            return factory('App\Models\Shop')->create()->id;
        },
        'is_enabled' => rand(0,1) == 1
    ];
});
