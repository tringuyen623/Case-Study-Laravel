<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bed;
use Faker\Generator as Faker;

$factory->define(Bed::class, function (Faker $faker) {
    return [
        'type' => $faker->word
    ];
});
