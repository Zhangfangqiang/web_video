<?php

namespace App\Observers;

use App\Models\Content;
use App\Jobs\Web\VideoScreenshot;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use FFMpeg\Coordinate\TimeCode;

class ContentObserver
{
    /**
     * 模型观察器在 Topic 模型保存时触发的 saving 事件中，对 excerpt 字段进行赋值：
     * 保存前操作的方法
     * @param Content $content
     */
    public function saving(Content $content)
    {
        $content->content    = clean($content->content);                                     #防止xss攻击
        $content->user_id    = \Auth::user()->id;                                            #获取用户id
        $content->release_at = now();                                                        #让他现在发布

        if (empty($content->excerpt)) {
            $content->excerpt = makeExcerpt($content->content);                              #摘要截取
        }

        if(empty($content->source)){
            $content->source  = '网站用户:'.\Auth::user()->name;                              #添加来源
        }

        if(empty($content->seo_key)){
            Jieba::init(['dict' => 'small']);
            Finalseg::init();
            $content->seo_key = implode(Jieba::cutForSearch(mb_strtolower(strip_tags($content->title))), ',');                                             #添加seo_key
        }
    }

    /**
     * 保存后操作的方法
     * @param Content $content
     */
    public function saved(Content $content)
    {
        #如果英语标题为空
        if (!$content->english_title) {
            dispatch(new \App\Jobs\Web\Translate($content, 'title', 'english_title'));
        }

        #如果添加了视频没有添加图片的话
        if (empty($content->img) && !empty($content->video)) {
            dispatch(new VideoScreenshot($content));
        }
    }
}
