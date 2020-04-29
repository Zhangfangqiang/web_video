<?php

/**
 * 给页面添加class 名称的方法
 */
if (!function_exists('route_class')) {
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

/**
 * glob删除文件的方法
 * @param $path
 * @param string $disk
 */
if (!function_exists('globDeleteFile')) {
    function globDeleteFile($path)
    {
        if (empty($path)) {                                                 #如果路径为空直接返回
            return;
        }

        if (preg_match("#(http|https)://(.*\.)?.*\..*#i", $path)) { #如果是url直接返回
            return;
        }

        if (!file_exists(public_path($path))) {                             #如果不存在源文件
            return;
        }

        $absPath  = public_path($path);          #获取绝对路径
        $pathInfo = pathinfo($absPath);          #获取路径信息
        $fileGlob = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '*.' . $pathInfo['extension'];

        foreach (glob($fileGlob) as $item) {
            if (file_exists($item)) {
                unlink($item);
            }
        }
    }
}

/**
 * 图片裁剪的方法
 * @param $path
 * @param bool $width
 * @param bool $height
 * @return string
 */
if (!function_exists('ImgRe')) {
    function ImgRe($path, $width = false, $height = false)
    {
        if (empty($path)) {
            $path = '/uploads/default.jpg';
        }

        if (preg_match("#(http|https)://(.*\.)?.*\..*#i", $path)) {
            return $path;
        }

        $absPath  = public_path($path);          #获取绝对路径
        $pathInfo = pathinfo($absPath);          #获取路径信息
        $fileName = $pathInfo['filename'] . '-' . $width . 'x' . $height . '.' . $pathInfo['extension'];
        $savePath = $pathInfo['dirname'] . '/' . $fileName; #设置文件保存路径

        if (file_exists($savePath)) {                   #如果存在压缩文件
            return pathinfo($path)['dirname'] . '/' . $fileName;
        }

        if (!file_exists($absPath)) {                   #如果不存在原始文件
            return $path;
        }

        if (($width == false) && ($height == false)) {  #如果没有压缩需求
            return $path;
        }

        $image = Image::make($absPath);

        if (($width != false) && ($height != false)) {
            $image->fit($width, $height);
        }

        if (($width != false) && ($height == false)) {
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();          #设定宽度是 $max_width，高度等比例缩放
                $constraint->upsize();               #防止裁图时图片尺寸变大
            });
        }

        if (($width == false) && ($height != false)) {
            $image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();          #设定宽度是 $max_width，高度等比例缩放
                $constraint->upsize();               #防止裁图时图片尺寸变大
            });
        }

        $image->save($savePath);

        return pathinfo($path)['dirname'] . '/' . $fileName;
    }
}

/**
 * 分类寻找子类并加上自身
 * @param $ids
 * @return array
 */
if (!function_exists('findChildren')) {
    function findChildren($ids)
    {
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        $children_category_ids = App\Models\Category::whereIn('parent_id', $ids)->get()->pluck('id')->toArray();

        if (count($children_category_ids) > 0) {
            if (is_array($ids)) {
                return array_merge($children_category_ids, $ids);
            } else {
                return $children_category_ids[] = $ids;
            }
        } else {
            return $ids;
        }
    }
}

/**
 * 获取摘要的方法
 * @param $value
 * @param int $length
 * @return mixed
 */
if (!function_exists('makeExcerpt')) {
    function makeExcerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return Str::limit($excerpt, $length);
    }
}

/**
 * 获取所有分类标签包括子集
 * @param $categories
 */
if (!function_exists('categoryHtmlTag')) {
    function categoryHtmlTag($categories)
    {
        foreach ($categories as $k => $v) {       #循环多个分类
            $pathValue = $v->pathValue();         #根据Path 查找族谱
            if (count($pathValue) == 0) {
                echo "
                 <a class='text-secondary' href='" . route('web.contents.index', ['category' => $v->id]) . "' title='分类'>
                     <span class='text-danger'>$v->name</span>
                 </a>
                 ";
            } else {
                foreach ($pathValue as $index => $item) {
                    if ($index == count($pathValue) - 1) {
                        echo "
                         <a class='text-secondary' href='" . route('web.contents.index', ['category' => $item->id]) . "' title='分类'>
                             <span class='text-danger'>$item->name</span>
                         </a>
                         ";
                    } else {
                        echo "
                         <a class='text-secondary' href='" . route('web.contents.index', ['category' => $item->id]) . "' title='分类'>
                             $item->name
                         </a>->
                         ";
                    }
                }
            }
        }
    }
}

/**
 * 创建一个符合layui框架条件的URL
 * @param $string
 * @return string|string[]|null
 */
if (!function_exists("layuiRoute")) {
    function layuiRoute($string)
    {
        return preg_replace("/(^http(s*):)|(\?[\s\S]*$)/", "", route($string));
    }
}

/**
 * 获取用户getUserBToken
 */
if (!function_exists("getUserBToken")) {
    function getUserBToken()
    {
        $user_id = \auth()->user()->id;

        return cache()->remember('UserBToken_' . $user_id, 60 * 30, function () use ($user_id) {
            return auth()->guard('api')->login(auth()->user());         #从认证守卫api那里获取令牌
        });
    }
}

/*
 * 根据大文件上传,提交的文件信息,获取文件路径
 */
if (!function_exists("aetherUploadPath")) {
    function aetherUploadPath($string)
    {
        return '/' . config('aetherupload.root_dir') . '/' . str_replace('_', '/', $string);
    }
}

/**
 * 文件大小转换的方法
 * @param $size
 * @return string
 */
if (!function_exists("formatBytes")) {

    function formatBytes($size)
    {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2) . $units[$i];
    }
}

/**
 * 判断是否是url的方法
 * @param $value
 * @return bool
 */
if (!function_exists("is_url")) {
    function is_url($value)
    {
        $pattern = "#(http|https)://(.*\.)?.*\..*#i";
        if (preg_match($pattern, $value)) {
            return true;
        } else {
            return false;
        }
    }
}

