<?php

namespace App\Listeners\Vendor;

use App\Events\Vendor\AetherUploadBefore;
use App\Models\UploadRecord;

class UploadRecordsWrite
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AetherUploadBefore $event)
    {
        $urlPath      = '/' . $event->resource->path;              #url路径
        $absolutePath = public_path($event->resource->path);       #绝对路径
        $size         = filesize($absolutePath);                   #获取文件大小
        $md5          = md5_file($absolutePath);                   #获取文件md5

        if (empty(UploadRecord::where(['md5' => $md5])->first()) ) {
            UploadRecord::create(['path' => $urlPath, 'size' => $size, 'md5' => $md5]);
        }
    }
}
