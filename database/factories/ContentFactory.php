<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Content;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories  定义一条假用户数据的模型
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Content::class, function (Faker $faker) {


    $sentence   = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();                  #随机取一个月以内的时间]
    $created_at = $faker->dateTimeThisMonth($updated_at);       #传参为生成最大时间不超过，因为创建时间需永远比更改时间要早

    return [
        'is_comment'      => $faker->numberBetween(0, 1),
        'is_top'          => $faker->numberBetween(0, 1),
        'is_recommended'  => $faker->numberBetween(0, 1),
        'type'            => 1,
        'watch_count'     => $faker->numberBetween(0, 999),
        'favorite_count' => $faker->numberBetween(0, 999),
        'awesome_count'   => $faker->numberBetween(0, 999),
        'comment_count'   => $faker->numberBetween(0, 999),
        'title'           => $sentence,
        'seo_key'         => $sentence,
        'excerpt'         => $sentence,
        'source'          => $faker->word,
        'content'         => $faker->text(2000),
        'img'             => $faker->imageUrl(),
        'video'           => null,
        'more'            => null,
        'release_at'      => $created_at,
        'delete_at'       => null,
        'created_at'      => $created_at,
        'updated_at'      => $updated_at,
    ];
});
