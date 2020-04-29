<?php

namespace App\Handlers;

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use TeamTNT\TNTSearch\Support\TokenizerInterface;

class TokenizerHandler implements TokenizerInterface
{
    public function tokenize($text, $stopwords = [])
    {
        Jieba::init(['dict' => 'small']);
        Finalseg::init();
        $text = strip_tags($text);                                      #获取纯文本
        $text = mb_strtolower($text);                                   #字母全部小写
        return is_numeric($text) ? [] : Jieba::cutForSearch($text);
    }
}
