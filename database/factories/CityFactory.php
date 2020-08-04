<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'abbreviation' => $faker->stateAbbr,
        'description' => $faker->sentence,
        'region_id' => function() {
        	return factory('App\Models\Region')->create()->id;
        }
    ];
});
