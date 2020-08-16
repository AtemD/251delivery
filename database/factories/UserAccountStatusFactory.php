<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserAccountStatus;
use Faker\Generator as Faker;

$factory->define(UserAccountStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'color' => $faker->word
    ];
});
