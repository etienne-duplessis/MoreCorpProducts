<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => 'Product ' . $faker->word,
        'sku' => mt_rand(000000,999999),
        'price' => mt_rand(0,1000),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
