<?php

use Faker\Generator as Faker;

$factory->define(\App\School::class, function (Faker $faker) {
    return [
        'name'  => $faker->streetName . ' University',
        'city'  => $faker->city,
        'state' => $faker->state,
        'zip'   => substr($faker->postcode,0,5),
        'circulation' => random_int(1000, 100000),
    ];
});
