<?php

namespace App\Models;

use App\Models\Traits\GetPublicData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use GetPublicData;

    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'links';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = ['title', 'description', 'link'];

    /**
     * 缓存key
     * @var string
     */
    public $cache_key = 'bbs_links';

    /**
     * 缓存过期时间
     * @var float|int
     */
    protected $cache_expire_in_seconds = 1440 * 60;

    /**
     * 获得所有友情链接数据
     * @return mixed
     */
    public function getAllDate()
    {
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function(){
            return $this->all();
        });
    }
}
