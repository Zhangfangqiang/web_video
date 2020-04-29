<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\RoleResources;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Requests\Api\Admin\RoleApiRequest;

class RoleApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(RoleAPIRequest $request , Role $role )
    {
        RoleResources::wrap('data');
        return RoleResources::collection($role->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(RoleAPIRequest $request)
    {
        $input              = $request->all();
        $role = Role::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Role $role , RoleAPIRequest $request)
    {
        $input = $request->all();
        $role->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 绑定权限的方法
     * @param Role $role
     * @param RoleApiRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bindPermissions(Role $role , RoleAPIRequest $request)
    {
        $permissions     = $request->input('permission', []);
        $rolePermissions = $role->permissions->pluck('name')->toArray();          #获取这个角色绑定的权限

        if (!empty($rolePermissions)) {
            if (count($permissions) > count($rolePermissions)) {
                $diff = array_diff($permissions, $rolePermissions);
            } else {
                $diff = array_diff($rolePermissions, $permissions);
            }

            $role->revokePermissionTo($diff);               #删除没有选中的
        }

        $role->givePermissionTo($permissions);              #保存现有的

        app(PermissionRegistrar::class)->forgetCachedPermissions();         #清除权限缓存

        return response(['message' => '绑定权限成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response(['message' => '删除成功', 'status' => '200'], 200);
    }
}
