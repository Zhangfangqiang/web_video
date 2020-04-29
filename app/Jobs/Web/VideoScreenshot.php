<?php

namespace App\Jobs\Web;

use App\Models\Content;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VideoScreenshot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 数据操作的表
     * @var string
     */
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->content->img) && !empty($this->content->video)) {
            $ffmpeg             = app('ffmpeg');
            $video              = $ffmpeg->open(public_path($this->content->video));
            $videoInfo          = pathinfo($this->content->video);
            $this->content->img = $videoInfo['dirname'].'/'.$videoInfo['filename'].'.jpg';

            $video->frame(TimeCode::fromSeconds(5))->save(public_path($this->content->img));
        }

        \DB::table($this->content->getTable())->where('id', $this->content->id)->update(['img' => $this->content->img]);
    }
}
