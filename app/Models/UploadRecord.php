<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class UploadRecord extends Model
{
    use GetPublicData;

    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'upload_records';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['md5', 'path', 'size'];

    /**
     * 该文件是哪个用户上传的
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        /**
         * 第一个参数：要关联的表对应的类
         * 第二个参数：中间表的表名
         * 第三个参数：当前表跟中间表对应的外键
         * 第四个参数：要关联的表跟中间表对应的外键
         */
        return $this->belongsToMany('App\Models\UploadRecord','user_has_upload_records','upload_record_id','user_id');
    }
}
