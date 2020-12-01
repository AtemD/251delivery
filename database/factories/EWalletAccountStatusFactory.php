<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EWalletAccountStatus;
use Faker\Generator as Faker;

$factory->define(EWalletAccountStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'color' => $faker->word
    ];
});
