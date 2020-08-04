<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
	$name = $faker->company . " Shop";

    return [
		'name' => $name,
		'slug' => Str::slug($name, '-'),
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
		'average_preparation_time' => $faker->randomElement(['15-20', '20-30', '30-40', '40-50']),
		'account_status' => $faker->randomElement([Shop::VERIFIED_SHOP, Shop::UNVERIFIED_SHOP, Shop::DEACTIVATED_SHOP]),
		'availability_status' => $faker->randomElement([Shop::AVAILABLE_SHOP, Shop::UNAVAILABLE_SHOP])
    ];
});
