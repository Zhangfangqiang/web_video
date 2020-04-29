<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasContent extends Model
{
    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'user_has_contents';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['content_id', 'user_id'];

    /**
     * 定义字段的数据类型
     * @var array
     */
    public static $TYPES = ['FAVORITE','AWESOME'];
}
