<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\Relation;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    $locationable = $faker->randomElement([
        App\Models\User::class,
        App\Models\Shop::class,
    ]);

    return [
        'city_id' => function() {
    		return factory('App\Models\City')->create()->id;
        },
        'postal_code' => $faker->postcode,
        'street' => $faker->streetName,
        'building' => $faker->buildingNumber,
        'specific_information' => $faker->sentence,
        'address' => $faker->streetAddress,
        'latitude' => $faker->latitude(-90, 90),
        'longitude' => $faker->longitude(-180, 180),
        'locationable_id' => factory($locationable),
        'locationable_type' => array_search(
                $locationable, 
                Relation::morphMap([
                    'users' => 'App\Models\User',
                    'shops' => 'App\Models\Shop',
                ])
        ),
    ];
});
