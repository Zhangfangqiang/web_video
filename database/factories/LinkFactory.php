<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(3,true),
        'description' => $faker->sentence(8, true),
        'link'        => $faker->url,
    ];
});
