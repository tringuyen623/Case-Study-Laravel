<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'hotel_id' => 1,
        'room_type_id' => factory(App\RoomType::class),
        'amount' => $faker->randomDigit,
        'view' => $faker->word,
        'size' => $faker->buildingNumber,
        'bed_id' => factory(App\Bed::class)
    ];
});
