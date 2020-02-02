<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RoomType;
use Faker\Generator as Faker;

$factory->define(RoomType::class, function (Faker $faker) {
    return [
        'name' => 'Room ' . $faker->name,
        'max_guest' => $faker->randomDigit,
        'description' => $faker->realText()
    ];
});
