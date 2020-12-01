<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'abbreviation' => $faker->word,
        'is_enabled' => rand(0,1) == 1
    ];
});
