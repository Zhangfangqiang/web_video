<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasUser extends Model
{
    /**
     * 定义表
     * @var string
     */
    protected $table = 'user_has_users';

    /**
     * 定义可以填充的字段
     * @var array
     */
    protected $fillable = ['user_id' , 'follow_user_id'];
}
