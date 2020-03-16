<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\blog;
use Faker\Generator as Faker;

$factory->define(blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->text(100),
        'complited' => false,
    ];
});
