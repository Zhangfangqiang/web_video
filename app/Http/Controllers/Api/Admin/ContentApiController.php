<?php

namespace App\Http\Controllers\Api\Admin;

use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Http\Requests\Api\Admin\ContentApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContentResources;


class ContentApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(ContentAPIRequest $request , Content $content )
    {
        ContentResources::wrap('data');
        return ContentResources::collection($content->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(ContentAPIRequest $request)
    {
        $data = $request->only('title', 'c_id', 'content', 'type', 'video', 'excerpt', 'source', 'seo_key');

        if ($data['type']  = 2){
            $data['video'] = aetherUploadPath($data['video']);
        }

        $content         = Content::create($data);
        $content->category()->attach(explode(',',$data['c_id']));                                              #进行关系关联

        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Content $content , ContentAPIRequest $request)
    {
        $data = $request->only('title', 'c_id', 'content', 'type', 'video', 'excerpt', 'source', 'seo_key');
        $content->category()->detach();                                                                                 #先删除关系
        $content->category()->attach(explode(',',$data['c_id']));                                               #进行关系关联
        $content->update($data);                                                                                        #更新数据

        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return response( ['message' => '删除成功', 'status' => '200'],204);
    }
}
