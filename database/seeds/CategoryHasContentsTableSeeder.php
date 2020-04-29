<?php

use Carbon\Carbon;
use App\Models\Content;
use App\Models\Category;
use App\Models\CategoryHasContent;
use Illuminate\Database\Seeder;

class CategoryHasContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category_ids = Category::all()->pluck('id')->toArray();                                                                  #获取分类

        Content::all()->each(
            function ($item) use ($category_ids) {
                $category_id = $category_ids[array_rand($category_ids)];                                                                #随机获得一个分类
                if (CategoryHasContent::where('category_id', '=', $item->id)->where('content_id', '=', $category_id)->count() == 0) {   #没有任何关联
                    $item->category()->attach($category_id);
                }
            }
        );
    }
}
