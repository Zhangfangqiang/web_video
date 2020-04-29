<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Api\Admin\CategoryApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResources;


class CategoryApiController extends Controller
{

    /**
     * 数据
     * @param $MODEL_NAME
     */
    public function index(CategoryAPIRequest $request , Category $category )
    {
        CategoryResources::wrap('data');
        return CategoryResources::collection($category->getData($request->all()));
    }

    /**
     * 创建
     * @param $MODEL_NAME
     */
    public function store(CategoryAPIRequest $request)
    {
        $input    = $request->all();
        $category = Category::create($input);
        return response(['message' => '创建成功', 'status' => '200'], 200);
    }

    /**
     * 更新
     * @param $MODEL_NAME
     */
    public function update(Category $category , CategoryAPIRequest $request)
    {
        $input = $request->all();

        if ($input['parent_id'] != $category->parent_id && $category->children->isNotEmpty()) {
            return response(['message' => '该分类下有子分类，请先删除子分类', 'status' => '200'], 200);
        }

        $category->update($input);
        return response(['message' => '修改成功', 'status' => '200'], 200);
    }

    /**
     * 删除
     * @param $MODEL_NAME
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response( ['message' => '删除成功', 'status' => '200'],204);
    }
}
