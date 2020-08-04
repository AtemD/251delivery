<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderType;
use Faker\Generator as Faker;

$factory->define(OrderType::class, function (Faker $faker) {
    return [
        'name' => $faker->word, 
        'description' => $faker->sentence,
    ];
});
