<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'shop_id' => function() {
        	return factory('App\Models\Shop')->create()->id;
        },
        'section_id' => function() {
        	return factory('App\Models\Section')->create()->id;
        },
        'image' => $faker->randomElement([
			'food_1.jpg',
			'food_2.jpg',
			'food_3.jpg',
			'food_4.jpg',
			'food_5.jpg',
			'food_6.jpg',
			'food_7.jpg',
			'food_8.jpg',
			'food_9.jpg',
			'food_10.jpg',
		]),
        'description' => $faker->sentence,
        'base_price' => $faker->randomElement([200, 250, 300, 400, 550, 30, 25, 150]),
        'is_available' => rand(0,1) == 1
    ];
});

