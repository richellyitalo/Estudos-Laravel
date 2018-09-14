<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->sentence(),
        'price' => $faker->randomFloat(2, 100, 1000)
    ];
});
