<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use GetPublicData;

    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'navs';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['name', 'remark', 'is_main'];
}
