<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\Admin\PermissionRequest;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.permissions.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permissions.create');
    }


    /**
     * 展示编辑页
     * @param $id
     * @param Permission
     */
    public function edit(PermissionRequest $request ,Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

}
