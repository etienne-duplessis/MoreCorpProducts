<?php

use Faker\Generator as Faker;

$factory->define(App\Bid::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'product_id' => mt_rand(1,10),
        'amount' => mt_rand(0,1000),
    ];
});
