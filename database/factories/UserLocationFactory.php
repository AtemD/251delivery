<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserLocation;
use Illuminate\Database\Eloquent\Relations\Relation;
use Faker\Generator as Faker;

$factory->define(UserLocation::class, function (Faker $faker) {
    return [
        'city_id' => function() {
    		return factory('App\Models\City')->create()->id;
        },
        'postal_code' => $faker->postcode,
        'street' => $faker->streetName,
        'building' => $faker->buildingNumber,
        'specific_information' => $faker->sentence,
        'address' => $faker->streetAddress,
        'delivery_addresses' => json_encode([
            'Hawassa University Main Campus',
            'Hawassa University Techno Campus',
            'Hawassa Uni Medical Campus',
        ]),
        'user_id' => function() {
    		return factory('App\User')->create()->id;
    	},
    ];
});
