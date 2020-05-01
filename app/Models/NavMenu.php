<?php

namespace App\Models;

use TypiCMS\NestableTrait;
use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use GetPublicData,NestableTrait;

    /**
     * 将这个模型绑定到指定的表中
     * @var string
     */
    protected $table = 'nav_menus';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['name', 'target','c_id', 'list_order', 'url_type','parent_id', 'level', 'path', 'icon', 'status', 'url', 'nav_id'];

    /**
     * 数据关联一对一,找父类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(NavMenu::class);
    }

    /**
     * 数据关联一对多,找子类
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(NavMenu::class, 'parent_id');
    }

    /**
     * 返回面包屑的方法
     * @return array
     */
    public function bread()
    {
        $bread = [];
        $path  = $this->path;

        foreach (explode(',', $path) as $key => $value) {
            if($value == 0){
                $bread[] = ['name'=>'首页' , 'url' => route('web.index.index') ];
                continue;
            }

            $NavMenuFind = $this->find($value);

            if(!is_url($NavMenuFind->url)){
                $url      = json_decode($NavMenuFind->url);             #拆分数据
                $bread[]  = ['name'=>$NavMenuFind->name , 'url' => route('web.list.article-list', ['nav_menu' => $url->category]) ];
            }else{
                $bread[]  = ['name'=>$NavMenuFind->name ,'url' => $NavMenuFind->url];
            }
        }

        if (!is_url($this->url)) {
            $url = route('web.list.article-list', ['nav_menu' => json_decode($this->url)->category]);
        } else {
            $url = $this->url;
        }

        $bread[]  = ['name'=>$this->name ,'url' => route('web.list.article-list', ['nav_menu' => $url])];
        return $bread;
    }

    /**
     * 返回url中的c_id
     * @return mixed|string
     */
    public function getCidAttribute()
    {
        if ($this->url_type == 2) {
            $paresUrl = parse_url($this->url);
            return explode('/', $paresUrl['path'])[4];
        }
    }

}
