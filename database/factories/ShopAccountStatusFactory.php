<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ShopAccountStatus;
use Faker\Generator as Faker;

$factory->define(ShopAccountStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'color' => $faker->word
    ];
});
