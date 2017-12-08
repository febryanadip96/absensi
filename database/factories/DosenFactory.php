<?php

use Faker\Generator as Faker;

$factory->define(App\Dosen::class, function (Faker $faker) {
    return [
        'nik' => $faker->unique()->randomNumber($nbDigits = 7, $strict = true),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
