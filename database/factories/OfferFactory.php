<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'price' => $faker->numberBetween(1, 100),
        'photo' => $faker->sentence
    ];
});
