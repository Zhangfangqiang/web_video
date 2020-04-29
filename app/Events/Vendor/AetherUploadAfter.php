<?php

namespace App\Events\Vendor;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AetherUploadAfter
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var 存储后的数据
     */
    public $resource;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }
    
}
