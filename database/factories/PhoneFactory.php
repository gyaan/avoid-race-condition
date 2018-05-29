<?php

use Faker\Generator as Faker;

$factory->define(\App\Phone::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Samsung',"Apple","Google","Red Mi"]),
        'iemi' => $faker->randomNumber(7).$faker->randomNumber(8),
    ];
});
