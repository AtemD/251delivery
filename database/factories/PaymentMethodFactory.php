<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PaymentMethod;
use Faker\Generator as Faker;

$factory->define(PaymentMethod::class, function (Faker $faker) {
    return [
        'name' => $faker->word, 
        'description' => $faker->sentence,
    ];
});
