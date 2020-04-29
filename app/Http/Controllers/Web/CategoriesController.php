<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * 弹出分类选项页面
     * @param CategoriesRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function popupList(CategoriesRequest $request ,Category $category)
    {
        $categories = $category->getData();
        $ids        = explode(',', $request->input('ids'));

        return view(env('VIEWLAYER').'.categories.popup_list', compact('categories','ids'));
    }
}
