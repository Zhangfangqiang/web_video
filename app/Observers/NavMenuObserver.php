<?php

namespace App\Observers;

use App\Models\NavMenu;


class NavMenuObserver
{
    /**
     * 创建更新保存后调用的事件
     * @param NavMenu $navMenu
     */
    public function saving(NavMenu $navMenu)
    {
        if ($navMenu->url_type == 1) {
            unset($navMenu->c_id);
        }

        if ($navMenu->url_type == 2) {
            $navMenu->url = route('web.contents.index', ['category' => $navMenu->c_id]);
            unset($navMenu->c_id);
        }

        if (is_null($navMenu->parent_id)) {
            $navMenu->level = 0;
            $navMenu->path  = '0';
        } else {
            $navMenu->level = $navMenu->parent->level + 1;
            $navMenu->path  = $navMenu->parent->path . ',' . $navMenu->parent_id;
        }
    }
}
