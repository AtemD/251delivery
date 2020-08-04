<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cuisine;
use Faker\Generator as Faker;

$factory->define(Cuisine::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
