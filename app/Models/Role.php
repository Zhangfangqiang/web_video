<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    use GetPublicData;

    /**
     * 表格
     */
    public $table = 'roles';


    /**
     * 可填充字段
     */
    public $fillable = [
        'name',
        'guard_name'
    ];
}
