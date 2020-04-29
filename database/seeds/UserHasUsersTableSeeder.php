<?php

use App\Models\User;
use App\Models\UserHasUser;
use Illuminate\Database\Seeder;

class UserHasUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();                                                                                                   #获取用户

        for ($i = 0; $i < 10; $i++) {
            User::all()->each(
                function ($item) use ($user_ids) {
                    $user_id = $user_ids[array_rand($user_ids)];                                                                                                 #随机获得一个用户
                    if (($user_id != $item->id) && (UserHasUser::where('user_id', '=', $item->id)->where('follow_user_id', '=', $user_id)->count() == 0)) {      #如果没有任何关联,并且关注的不是自己
                        $item->followUser()->attach($user_id);                                                                                                   #添加关系
                    }
                }
            );
        }
    }
}
