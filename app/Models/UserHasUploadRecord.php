<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasUploadRecord extends Model
{
    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'user_has_upload_records';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['user_id', 'upload_record_id'];

}
