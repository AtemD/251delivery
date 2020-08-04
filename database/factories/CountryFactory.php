<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'abbreviation' => $faker->stateAbbr,
        'currency_name' => 'Ethiopian Birr',
        'currency_abbreviation' => 'ETB',
    ];
});
