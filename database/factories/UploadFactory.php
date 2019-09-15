<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Upload;
use Faker\Generator as Faker;

$factory->define(Upload::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'size' => $faker->numberBetween(1000, 10000),
        'is_image' => $faker->boolean,
    ];
});
