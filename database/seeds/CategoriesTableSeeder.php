<?php

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nowTime    = Carbon::now();
        $categories = [
            [
                'name'        => '分享',
                'description' => '分享创造，分享发现',
                'parent_id'   => null,
                'level'       => '0',
                'path'        => '0',
                'created_at'  => $nowTime,
                'updated_at'  => $nowTime,
            ],
            [
                'name'        => '教程',
                'description' => '开发技巧、推荐扩展包等',
                'parent_id'   => null,
                'level'       => '0',
                'path'        => '0',
                'created_at'  => $nowTime,
                'updated_at'  => $nowTime,
            ],
            [
                'name'        => '问答',
                'description' => '请保持友善，互帮互助',
                'parent_id'   => null,
                'level'       => '0',
                'path'        => '0',
                'created_at'  => $nowTime,
                'updated_at'  => $nowTime,
            ],
            [
                'name'        => '公告',
                'description' => '站点公告',
                'parent_id'   => null,
                'level'       => '0',
                'path'        => '0',
                'created_at'  => $nowTime,
                'updated_at'  => $nowTime,
            ],
        ];

        Category::insert($categories);
    }
}
