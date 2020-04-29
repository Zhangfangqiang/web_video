<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryHasContent;
use App\Http\Requests\Api\Admin\CategoryHasContentApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryHasContentResources;


class CategoryHasContentApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(CategoryHasContentApiRequest $request , CategoryHasContent $categoryHasContent )
    {
        CategoryHasContentResources::wrap('data');
        return CategoryHasContentResources::collection($categoryHasContent->getData($request->all()));
    }

}
