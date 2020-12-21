<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
	$name = $faker->company . " Shop";

    return [
		'name' => $name,
		// 'slug' => Str::slug($name, '-'),
        'shop_type_id' => function() {
    		return factory('App\Models\ShopType')->create()->id;
    	},
		'description' => collect($faker->paragraphs(3, false))->implode(''),
		'email' => $faker->safeEmail,
		'phone_number' => $faker->phoneNumber,
		'logo_image' => 'default_logo.jpg',
    	'banner_image' => $faker->randomElement([
			'banner_image_1.jpg',
			'banner_image_2.jpg',
			'banner_image_3.jpg',
			'banner_image_4.jpg',
			'banner_image_5.jpg',
			'banner_image_6.jpg',
			'banner_image_7.jpg',
			'banner_image_8.jpg',
			'banner_image_9.jpg',
			'banner_image_10.jpg',
			'banner_image_11.jpg',
			'banner_image_12.jpg',
			'banner_image_13.jpg',
		]),
		'min_product_preparation_time' => $faker->randomElement([15, 20, 30]),
		'max_product_preparation_time' => $faker->randomElement([40, 50, 60, 80]),
		'shop_account_status_id' => function() {
    		return factory('App\Models\ShopAccountStatus')->create()->id;
    	},
		'is_available' => rand(0,1) == 1,
		'opening_hours' => [
			'monday' => ['09:00-12:00', '13:00-18:00'],
			'tuesday' => ['09:00-12:00', '13:00-18:00'],
			'wednesday' => ['09:00-12:00'],
			'thursday' => ['09:00-12:00', '13:00-18:00'],
			'friday' => ['09:00-12:00', '13:00-18:00'],
			'saturday' => ['09:00-12:00', '13:00-18:00'],
			'sunday' => [],
        ],
    ];
});
