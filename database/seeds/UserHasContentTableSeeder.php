<?php

use App\Models\User;
use App\Models\Content;
use App\Models\UserHasContent;
use Illuminate\Database\Seeder;

class UserHasContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();                                                                      #获取用户
        $types    = UserHasContent::$TYPES;                                                                                         #数据类型分类

        for ($i = 0; $i < 10; $i++) {
            Content::all()->each(
                function ($item) use ($user_ids,$types) {
                    $user_id = $user_ids[array_rand($user_ids)];                                                                   #随机获得一个用户
                    $type    = $types[array_rand($types)];                                                                         #随机获得 点赞 或 收藏

                    if (($item->user_id != $user_id) && (UserHasContent::where('user_id', '=', $user_id)->where('content_id', '=', $item->id)->count() == 0)) {      #如果没有任何关联
                        $item->awesomeUser()->attach($user_id, ['type' => $type]);                                                 #添加关系
                    }
                }
            );
        }
    }
}
