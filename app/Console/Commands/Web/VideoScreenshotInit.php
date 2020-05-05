<?php

namespace App\Console\Commands\Web;

use App\Models\Content;
use App\Jobs\Web\VideoScreenshot;
use Illuminate\Console\Command;

class VideoScreenshotInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:vsi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成视频图片 需要启队列';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Content::whereNull('img')->get()->each(function ($item) {
            dispatch(new VideoScreenshot($item));
        });
    }
}
