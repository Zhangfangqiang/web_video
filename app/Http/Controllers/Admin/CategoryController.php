<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.categories.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    /**
     * 展示编辑页
     * @param $id
     * @param Category
     */
    public function edit(CategoryRequest $request ,Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

}
