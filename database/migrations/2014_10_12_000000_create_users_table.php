<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')                                         ->comment('主键id');
            $table->string('name')                                              ->comment('用户名');
            $table->string('email')->unique()                                   ->comment('登录邮箱');
            $table->timestamp('email_verified_at')->nullable()                  ->comment('邮箱激活');
            $table->string('avatar')->nullable()                                ->comment('存储头像图片路径');
            $table->string('introduction')->nullable()                          ->comment('个人简介');
            $table->string('password')                                          ->comment('登录密码')  ;
            $table->rememberToken()                                                     ->comment('和重置密码有关的Token');
            $table->unsignedBigInteger('notification_count')->default(0)  ->comment('通知数量');
            $table->unsignedBigInteger('be_follow_count')->default(0)     ->comment('我被别人关注的数量');
            $table->unsignedBigInteger('follow_count')->default(0)        ->comment('我关注的数量');
            $table->unsignedBigInteger('be_awesome_count')->default(0)    ->comment('我被别人赞的数量');
            $table->unsignedBigInteger('awesome_count')->default(0)       ->comment('我赞的数量');
            $table->unsignedBigInteger('be_favorite_count')->default(0)   ->comment('我被别人收藏的数量');
            $table->unsignedBigInteger('favorite_count')->default(0)      ->comment('我收藏的数量');
            $table->timestamp('last_login_at')->nullable()                      ->comment('最后登录时间');
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
        Schema::dropIfExists('users');
    }
}
