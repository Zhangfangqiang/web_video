<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {

    $date_time = $faker->date . ' ' . $faker->time;         #随机日期 加 随机时间 组成随机时间

    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'remember_token'    => Str::random(10),
        'email_verified_at' => now(),
        'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'introduction'      => $faker->sentence(),
        'awesome_count'     => $faker->numberBetween(0, 999),
        'created_at'        => $date_time,
        'updated_at'        => $date_time,
    ];
});
