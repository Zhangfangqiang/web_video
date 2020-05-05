<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Nav;
use App\Http\Requests\Api\Admin\NavApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NavResources;


class NavApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(NavAPIRequest $request , Nav $nav )
    {
        NavResources::wrap('data');
        return NavResources::collection($nav->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(NavAPIRequest $request)
    {
        $input              = $request->all();
        $nav = Nav::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Nav $nav , NavAPIRequest $request)
    {
        $input = $request->all();
        $nav->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Nav $nav)
    {
        $nav->delete();
        return response(['message' => '删除成功', 'status' => '200'], 200);
    }
}
