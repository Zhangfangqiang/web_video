<?php

use App\Models\User;
use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();            #获取用户数据
        $faker    = app(Faker\Generator::class);                  #获取 Faker 实例

        $contents = factory(Content::class)->times(500)->make()->each(
            function ($content, $index) use ($user_ids, $faker) {
                $content->user_id = $faker->randomElement($user_ids);         #从用户 ID 数组中随机取出一个并赋值
            }
        );

        Content::insert($contents->toArray());
    }
}
