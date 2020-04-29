<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{

    use GetPublicData;

    /**
     * 时间戳自动填充
     * @var bool
     */
    public $timestamps = true;

    /**
     * 表格
     */
    public $table = 'permissions';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['name', 'guard_name','alias'];

}
