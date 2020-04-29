<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\Admin\UserApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResources;
use Spatie\Permission\PermissionRegistrar;


class UserApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(UserAPIRequest $request , User $user )
    {
        UserResources::wrap('data');
        return UserResources::collection($user->getData($request->all()));
    }

    /**
     * 绑定权限的方法
     * @param User $user
     * @param RoleAPIRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bindPermissions(User $user , UserAPIRequest $request)
    {
        $permissions     = $request->input('permission', []);
        $userPermissions = $user->permissions->pluck('name')->toArray();          #获取这个用户绑定的权限

        if (!empty($userPermissions)) {
            if (count($permissions) > count($userPermissions)) {
                $diff = array_diff($permissions, $userPermissions);
            } else {
                $diff = array_diff($userPermissions, $permissions);
            }
            if (count($diff) == 1) {
                $user->revokePermissionTo($diff[0]);               #删除没有选中的
            }else{
                $user->revokePermissionTo($diff);                  #删除没有选中的
            }
        }
        $user->givePermissionTo($permissions);              #保存现有的

        app(PermissionRegistrar::class)->forgetCachedPermissions();         #清除权限缓存

        return response(['message' => '绑定权限成功', 'status' => '200'], 200);
    }

    /**
     * 绑定角色的方法
     * @param User $user
     * @param RoleAPIRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bindRoles(User $user , UserAPIRequest $request)
    {
        $roles     = $request->input('roles', []);
        $userRoles = $user->roles->pluck('name')->toArray();          #获取这个用户绑定的角色

        if (!empty($userRoles)) {
            if (count($roles) > count($userRoles)) {
                $diff = array_diff($roles, $userRoles);
            } else {
                $diff = array_diff($userRoles, $roles);
            }

            if (count($diff) == 1) {
                $user->removeRole($diff[0]);
            } else {
                $user->removeRole($diff);
            }
        }

        $user->assignRole($roles);              #保存现有的

        app(PermissionRegistrar::class)->forgetCachedPermissions();         #清除权限缓存

        return response(['message' => '绑定权限成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response( ['message' => '删除成功', 'status' => '200'],204);
    }
}
