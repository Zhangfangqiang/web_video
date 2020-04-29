<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.roles.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * 展示编辑页
     * @param $id
     * @param Role
     */
    public function edit(RoleRequest $request ,Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * 权限绑定页
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindPermissions(RoleRequest $request, Role $role)
    {
        $permission      = Permission::all();           #所有权限
        $bindPermissions = $role->permissions->pluck('name')->toArray();          #绑定的权限

        return view('admin.roles.bind_permissions', compact('bindPermissions', 'permission'));
    }
}
