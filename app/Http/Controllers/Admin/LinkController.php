<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Requests\Admin\LinkRequest;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.links.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.links.create');
    }


    /**
     * 展示编辑页
     * @param $id
     * @param Link
     */
    public function edit(LinkRequest $request ,Link $link)
    {
        return view('admin.links.edit', compact('link'));
    }

}
