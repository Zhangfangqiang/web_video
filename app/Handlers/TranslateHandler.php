<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class TranslateHandler
{
    /**
     * 翻译
     * @param $text
     * @return mixed
     */
    public function translate($text)
    {
        $result = $this->baiduTranslate($text);            #调用百度翻译的方法

        #尝试获取获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            return \Str::slug($result['trans_result'][0]['dst']);
        } else {
            #如果百度翻译没有结果，使用拼音作为后备计划。
            return $this->pinyin($text);
        }
    }

    /**
     * 百度翻译调用
     * baiduTranslate
     * @param $text
     * @return mixed
     */
    public function baiduTranslate($text)
    {
        #实例化 HTTP 客户端
        $http = new Client;

        #初始化配置信息
        $api   = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('translate.baidu.appid');
        $key   = config('translate.baidu.key');
        $salt  = time();

        #如果没有配置百度翻译，自动使用兼容的拼音方案
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        #根据文档，生成 sign 签名
        $sign = md5($appid. $text . $salt . $key);

        #构建请求参数
        $query = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);

        #发送 HTTP Get 请求
        $response = $http->get($api.$query);
        return json_decode($response->getBody(), true);
    }

    /**
     * 中文转换拼音
     * @param $text
     * @return mixed
     */
    public function pinyin($text)
    {
        return \Str::slug(app(Pinyin::class)->permalink($text));
    }
}
