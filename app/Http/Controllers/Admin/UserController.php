<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * 展示编辑页
     * @param $id
     * @param User
     */
    public function edit(UserRequest $request, User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * 权限绑定页
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindPermissions(UserRequest $request, User $user)
    {
        $permission      = Permission::all();                                     #所有权限
        $bindPermissions = $user->permissions->pluck('name')->toArray();          #绑定的权限

        return view('admin.users.bind_permissions', compact('permission','bindPermissions'));
    }

    /**
     * 角色绑定页
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindRoles(UserRequest $request, User $user)
    {
        $roles     = Role::all();                               #获取所有角色
        $bindRoles = $user->roles->pluck('name')->toArray();     #获取绑定的角色

        return view('admin.users.bind_roles', compact('roles', 'bindRoles'));
    }
}
