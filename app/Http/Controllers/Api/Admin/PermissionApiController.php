<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\Api\Admin\PermissionApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PermissionResources;


class PermissionApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(PermissionAPIRequest $request , Permission $permission )
    {
        PermissionResources::wrap('data');
        return PermissionResources::collection($permission->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(PermissionAPIRequest $request)
    {
        $input               = $request->all();
        $permission = Permission::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Permission $permission , PermissionAPIRequest $request)
    {
        $input               = $request->all();
        $permission->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response(['message' => '删除成功', 'status' => '200'], 200);
    }
}
