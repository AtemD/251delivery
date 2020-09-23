<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopLocation;
use Illuminate\Database\Eloquent\Relations\Relation;
use Faker\Generator as Faker;

$factory->define(ShopLocation::class, function (Faker $faker) {
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
        'shop_id' => function() {
    		return factory('App\Models\Shop')->create()->id;
    	},
    ];
});
