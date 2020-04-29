<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\OperationgLog;
use App\Http\Requests\Api\Admin\OperationgLogApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OperationgLogResources;


class OperationgLogApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(OperationgLogAPIRequest $request , OperationgLog $operationgLog )
    {
        OperationgLogResources::wrap('data');
        return OperationgLogResources::collection($operationgLog->getData($request->all()));
    }
}
