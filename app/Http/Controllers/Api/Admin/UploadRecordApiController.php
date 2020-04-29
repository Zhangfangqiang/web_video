<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\UploadRecord;
use App\Http\Requests\Api\Admin\UploadRecordApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UploadRecordResources;


class UploadRecordApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(UploadRecordAPIRequest $request , UploadRecord $uploadRecord )
    {
        UploadRecordResources::wrap('data');
        return UploadRecordResources::collection($uploadRecord->getData($request->all()));
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(UploadRecord $uploadRecord)
    {
        globDeleteFile($uploadRecord->path);
        $uploadRecord->delete();
        return response( ['message' => '删除成功', 'status' => '200'],200);
    }
}
