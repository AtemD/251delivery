<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopType;
use Faker\Generator as Faker;

$factory->define(ShopType::class, function (Faker $faker) {
    return [
        'name' => $faker->word, 
        'description' => $faker->sentence,
        'is_enabled' => rand(0,1) == 1
    ];
});
