<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PaymentStatus;
use Faker\Generator as Faker;

$factory->define(PaymentStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'color' => $faker->word
    ];
});
