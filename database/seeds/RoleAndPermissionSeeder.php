<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        #需清除缓存，否则有可能会报错
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        #创建权限
        Permission::create(['name' => 'admin.ueditor.upload'        , 'guard_name' => 'web', 'alias' => '百度编辑器主控文件']);
        Permission::create(['name' => 'admin.layouts.index'         , 'guard_name' => 'web', 'alias' => '后台框架页']);
        Permission::create(['name' => 'admin.operationg_logs.index' , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.users.index'           , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.users.create'          , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.users.bind_permissions', 'guard_name' => 'web', 'alias' => '绑定权限页']);
        Permission::create(['name' => 'admin.users.bind_roles'      , 'guard_name' => 'web', 'alias' => '绑定权限页']);
        Permission::create(['name' => 'admin.categories.index'      , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.categories.create'     , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.categories.edit'       , 'guard_name' => 'web', 'alias' => '编辑页']);
        Permission::create(['name' => 'admin.upload_records.index'  , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.links.index'           , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.links.create'          , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.links.edit'            , 'guard_name' => 'web', 'alias' => '编辑页']);
        Permission::create(['name' => 'admin.contents.index'        , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.contents.create'       , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.contents.edit'         , 'guard_name' => 'web', 'alias' => '编辑页']);
        Permission::create(['name' => 'admin.permissions.index'     , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.permissions.create'    , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.permissions.edit'      , 'guard_name' => 'web', 'alias' => '编辑页']);
        Permission::create(['name' => 'admin.roles.index'           , 'guard_name' => 'web', 'alias' => '数据展示页']);
        Permission::create(['name' => 'admin.roles.create'          , 'guard_name' => 'web', 'alias' => '创建页']);
        Permission::create(['name' => 'admin.roles.edit'            , 'guard_name' => 'web', 'alias' => '编辑页']);
        Permission::create(['name' => 'admin.roles.bind_permissions', 'guard_name' => 'web', 'alias' => '绑定权限页']);

        #创建角色
        Role::create(['name' => '总管理员', 'guard_name' => 'web']);

        #给角色绑定权限
        Role::find(1)->givePermissionTo([
            'admin.ueditor.upload'        ,
            'admin.layouts.index'         ,
            'admin.operationg_logs.index' ,
            'admin.users.index'           ,
            'admin.users.create'          ,
            'admin.users.bind_permissions',
            'admin.users.bind_roles'      ,
            'admin.categories.index'      ,
            'admin.categories.create'     ,
            'admin.categories.edit'       ,
            'admin.upload_records.index'  ,
            'admin.links.index'           ,
            'admin.links.create'          ,
            'admin.links.edit'            ,
            'admin.contents.index'        ,
            'admin.contents.create'       ,
            'admin.contents.edit'         ,
            'admin.permissions.index'     ,
            'admin.permissions.create'    ,
            'admin.permissions.edit'      ,
            'admin.roles.index'           ,
            'admin.roles.create'          ,
            'admin.roles.edit'            ,
            'admin.roles.bind_permissions',
        ]);

        #给用户绑定权限
        User::find(1)->givePermissionTo([
            'admin.ueditor.upload'        ,
            'admin.layouts.index'         ,
            'admin.operationg_logs.index' ,
            'admin.users.index'           ,
            'admin.users.create'          ,
            'admin.users.bind_permissions',
            'admin.users.bind_roles'      ,
            'admin.categories.index'      ,
            'admin.categories.create'     ,
            'admin.categories.edit'       ,
            'admin.upload_records.index'  ,
            'admin.links.index'           ,
            'admin.links.create'          ,
            'admin.links.edit'            ,
            'admin.contents.index'        ,
            'admin.contents.create'       ,
            'admin.contents.edit'         ,
            'admin.permissions.index'     ,
            'admin.permissions.create'    ,
            'admin.permissions.edit'      ,
            'admin.roles.index'           ,
            'admin.roles.create'          ,
            'admin.roles.edit'            ,
            'admin.roles.bind_permissions',
        ]);

        #给用户绑定角色
        User::find(1)->assignRole([
            '总管理员'
        ]);
    }
}
