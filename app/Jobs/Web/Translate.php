<?php

namespace App\Jobs\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Handlers\TranslateHandler;

class Translate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 数据操作的表
     * @var string
     */
    protected $model;

    /**
     * 需要翻译的字段
     * @var string
     */
    protected $translationField;

    /**
     * 需要填充的字段
     * @var string
     */
    protected $fillField;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $translationField, $fillField)
    {
        $this->model            = $model;
        $this->translationField = $translationField;
        $this->fillField        = $fillField;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $english_title = app(TranslateHandler::class)->translate($this->model->title);
        \DB::table($this->model->getTable())->where('id', $this->model->id)->update(['english_title' => $english_title]);

    }
}
