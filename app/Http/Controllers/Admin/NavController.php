<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Nav;
use App\Http\Requests\Admin\NavRequest;
use App\Http\Controllers\Controller;

class NavController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.navs.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.navs.create');
    }


    /**
     * 展示编辑页
     * @param $id
     * @param Nav
     */
    public function edit(NavRequest $request ,Nav $nav)
    {
        return view('admin.navs.edit', compact('nav'));
    }

}
