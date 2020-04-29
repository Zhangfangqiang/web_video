<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class OperationgLog extends Model
{

    use GetPublicData;

    /**
     * 表格
     */
    public $table = 'operating_logs';


    /**
     * 可填充字段
     */
    public $fillable = [
        'user_id',
        'uri',
        'methods',
        'data'
    ];

    /**
     * 获取用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
