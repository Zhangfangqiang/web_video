<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use GetPublicData;

    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'categories';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['name', 'description', 'parent_id', 'level', 'path'];

    /**
     * 初始化方法
     */
    protected static function boot()
    {
        parent::boot();

        static::saving (function (Category $category) {         #一个小的保存事件
            if (is_null($category->parent_id)) {
                $category->level = 0;
                $category->path  = '0';
            } else {
                $category->level = $category->parent->level + 1;
                $category->path  = $category->parent->path . ',' . $category->parent_id;
            }
        });
    }

    /**
     * 数据关联一对一,找父类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 数据关联一对多,找子类
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * 该分类下的文章
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function content()
    {
        /**
         * 第一个参数：要关联的表对应的类
         * 第二个参数：中间表的表名
         * 第三个参数：当前表跟中间表对应的外键
         * 第四个参数：要关联的表跟中间表对应的外键
         */
        return $this->belongsToMany('App\Models\Content','category_has_contents','category_id','content_id');
    }


    /**
     * 获取路径上的值
     * @return array
     */
    public function pathValue()
    {
        if (is_null($this->parent_id) && $this->path == 0 && $this->level == 0) {
            return [];
        }else{
            return $this->whereIn('id', explode(',', $this->path . ',' . $this->id))->get();
        }
    }

}
