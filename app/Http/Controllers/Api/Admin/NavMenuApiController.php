<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\NavMenu;
use App\Http\Requests\Api\Admin\NavMenuApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NavMenuResources;


class NavMenuApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(NavMenuAPIRequest $request , NavMenu $navMenu )
    {
        NavMenuResources::wrap('data');
        return NavMenuResources::collection($navMenu->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(NavMenuAPIRequest $request)
    {
        $input   = $request->all();
        $navMenu = NavMenu::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(NavMenu $navMenu , NavMenuAPIRequest $request)
    {
        $input = $request->all();
        $navMenu->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(NavMenu $navMenu)
    {
        $navMenu->delete();
        return response(['message' => '删除成功', 'status' => '200'], 200);
    }
}
