<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);       #获取 Faker(伪造者) 实例

        #头像假数据
        $avatars = [
            asset('/web/img/1.jpg'),
            asset('/web/img/2.jpg'),
            asset('/web/img/3.jpg'),
            asset('/web/img/4.jpg'),
            asset('/web/img/5.jpg'),
        ];

        #生成数据集合 工厂设计模式
        $users = factory(User::class)->times(20)->make()->each(
            function ($user, $index) use ($faker, $avatars) {
                #从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            }
        );

        /**
         * 让隐藏字段可见，并将数据集合转换为数组,是 Eloquent 对象提供的方法，可以显示
         * User 模型 $hidden 属性里指定隐藏的字段，此操作确保入库时数据库不会报错
         */
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        User::insert($user_array);
        User::where('id', 1)->update(['email'=>'zf18600004319@aliyun.com', 'name' => '张舫1'  , 'password' => Hash::make('admin123123')]);
        User::where('id', 2)->update(['email'=>'1069303772@qq.com'       , 'name' => '张舫2'  , 'password' => Hash::make('admin123123')]);
        User::where('id', 2)->update(['email'=>'admin@admin.com'         , 'name' => 'admin' , 'password' => Hash::make('admin123123')]);
    }
}
