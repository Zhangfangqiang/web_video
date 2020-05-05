<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NavMenu;
use Faker\Generator as Faker;

$factory->define(NavMenu::class, function (Faker $faker) {

    return [
        'nav_id' => $faker->word,
        'parent_id' => $faker->word,
        'level' => $faker->randomDigitNotNull,
        'path' => $faker->word,
        'status' => $faker->word,
        'list_order' => $faker->word,
        'name' => $faker->word,
        'target' => $faker->word,
        'url' => $faker->word,
        'icon' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
