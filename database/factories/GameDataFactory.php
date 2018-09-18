<?php

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(\App\Models\GameData::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'score'   => $faker->numberBetween(0, 1234),
        'game_log' => $faker->text(3000),
        'created_at' => $faker->dateTimeBetween('-1 day', '+1 day'),
    ];
});
