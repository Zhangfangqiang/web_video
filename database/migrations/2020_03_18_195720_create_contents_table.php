<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')                                                                 ->comment('发布者');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('parent_id')         ->nullable()                                          ->comment('父类id');
            $table->foreign('parent_id')->references('id')->on('contents')->onDelete('CASCADE');

            $table->tinyInteger('is_comment')               ->nullable()->default(0)                        ->comment('是否评论  1允许   0不允许');
            $table->tinyInteger('is_top')                   ->nullable()->default(0)                        ->comment('是否置顶  1置顶   0不置顶');
            $table->tinyInteger('is_recommended')           ->nullable()->default(0)                        ->comment('是否推荐  1推荐   0不推荐');
            $table->tinyInteger('type')                     ->nullable()->default(1)                        ->comment('定义这条数据类型 1文章 ... 后面按照所需定义');

            $table->unsignedBigInteger('watch_count')       ->nullable()->default(0)                        ->comment('查看数');
            $table->unsignedBigInteger('favorite_count')    ->nullable()->default(0)                        ->comment('收藏数');
            $table->unsignedBigInteger('awesome_count')     ->nullable()->default(0)                        ->comment('点赞数');
            $table->unsignedBigInteger('comment_count')     ->nullable()->default(0)                        ->comment('评论数');

            $table->string('title')                                                                               ->comment('标题');
            $table->string('english_title')                 ->nullable()                                          ->comment('标题');
            $table->string('seo_key')                       ->nullable()                                          ->comment('seo 关键词');
            $table->string('excerpt')                       ->nullable()                                          ->comment('摘要');
            $table->string('source')                        ->nullable()                                          ->comment('文章来源');
            $table->text('content')                         ->nullable()                                          ->comment('内容');
            $table->text('video')                           ->nullable()                                          ->comment('视频路径');
            $table->string('img')                           ->nullable()                                          ->comment('图片 可以是内容图片 可以是视频图片 也可以单独作为一个图片看你如何使用');

            $table->json('more')                            ->nullable()                                          ->comment('跟多关于这条数据的内容...');
            $table->timestamp('release_at')                 ->nullable()                                          ->comment('发布时间');
            $table->timestamp('delete_at')                  ->nullable()                                          ->comment('删除时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
