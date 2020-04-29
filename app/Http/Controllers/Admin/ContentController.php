<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Http\Requests\Admin\ContentRequest;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.contents.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contents.create');
    }


    /**
     * 展示编辑页
     * @param $id
     * @param Content
     */
    public function edit(ContentRequest $request ,Content $content)
    {
        return view('admin.contents.edit', compact('content'));
    }

}
