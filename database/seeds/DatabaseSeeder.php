<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);               #创建用户
        $this->call(CategoriesTableSeeder::class);          #创建分类
        $this->call(ContentsTableSeeder::class);            #创建内容
        $this->call(CategoryHasContentsTableSeeder::class); #关联内容
        $this->call(LinksTableSeeder::class);               #创建友情链接
        $this->call(UserHasUsersTableSeeder::class);        #创建用户与用户之间的 粉丝 , 关注关系
        $this->call(UserHasContentTableSeeder::class);      #创建用户和内容之间的 我给你点赞 我给文章点赞的关系
        $this->call(RoleAndPermissionSeeder::class);        #添加权限管理 添加角色
    }
}
