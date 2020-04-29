<?php

namespace App\Models;

use TypiCMS\NestableTrait;                      #三级分类
use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use NestableTrait;
    use GetPublicData;


    /**
     * 设置可以使用的表
     * @var string
     */
    protected $table = 'comments';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['content','commentable_type','commentable_id','status','user_id','parent_id','to_user_id','level','path'];

    /**
     * 初始化方法
     */
    protected static function boot()
    {
        parent::boot();

        static::saving (function (Comment $comment) {
            if (is_null($comment->parent_id)) {
                $comment->level = 0;
                $comment->path  = '0';
            } else {
                $comment->level = $comment->parent->level + 1;
                $comment->path  = $comment->parent->path . ',' . $comment->parent_id;
            }
        });
    }

    /**
     * 多态 一对多 获取内容
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * 数据关联一对一,找父类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * 获取评论人
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 数据关联一对多,找子类
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
