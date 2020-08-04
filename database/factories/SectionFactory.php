<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'shop_id' => function () {
            return factory('App\Models\Shop')->create()->id;
        },
        'description' => $faker->sentence,
    ];
});
