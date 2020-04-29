<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use GetPublicData;

    /**
     * 强制数据转换 , 选择字段 然后转换类型 array object json ...
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * 定义表格
     * @var string
     */
    protected $table = 'notifications';


}
