<?php

use Faker\Generator as Faker;

$factory->define(App\Mahasiswa::class, function (Faker $faker) {
    return [
        'nrp' => $faker->unique()->randomNumber($nbDigits = 9, $strict = false),
        'nama' => $faker->name,
    ];
});
