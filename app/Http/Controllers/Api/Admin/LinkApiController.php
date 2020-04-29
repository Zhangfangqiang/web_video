<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Requests\Api\Admin\LinkApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LinkResources;


class LinkApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(LinkAPIRequest $request , Link $link )
    {
        LinkResources::wrap('data');
        return LinkResources::collection($link->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(LinkAPIRequest $request)
    {
        $input = $request->all();
        $link  = Link::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Link $link , LinkAPIRequest $request)
    {
        $input = $request->all();
        $link->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return response( ['message' => '删除成功', 'status' => '200'],204);
    }
}
