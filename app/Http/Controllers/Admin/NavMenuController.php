<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\NavMenu;
use App\Http\Requests\Admin\NavMenuRequest;
use App\Http\Controllers\Controller;

class NavMenuController extends Controller
{

    /**
     * 展示数据页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(NavMenuRequest $request)
    {
        return view('admin.nav_menus.index' );
    }

    /**
     * 展示创建页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(NavMenuRequest $request)
    {
        return view('admin.nav_menus.create');
    }

    /**
     * 展示编辑页
     * @param $id
     * @param NavMenu
     */
    public function edit(NavMenuRequest $request ,NavMenu $navMenu)
    {
        return view('admin.nav_menus.edit', compact('navMenu'));
    }

}
