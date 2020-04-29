<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nav_id')->comment('发布者');
            $table->foreign('nav_id')->references('id')->on('navs')->onDelete('CASCADE');
            $table->unsignedBigInteger('parent_id')->nullable();                                                                    #父类id
            $table->foreign('parent_id')->references('id')->on('nav_menus')->onDelete('CASCADE');           #关系连接
            $table->unsignedInteger('level');                                                                                       #级别
            $table->string('path');                                                                                                 #路径
            $table->tinyInteger('status')->comment('状态是否禁用');
            $table->unsignedBigInteger('list_order')->nullable()->default(1000)->comment('排序');
            $table->string('name')->comment('导航名称');
            $table->string('target')->nullable()->default('_blank')->comment('打开方式');
            $table->string('url')->comment('打开链接');
            $table->string('icon')->nullable()->default('')->comment('图标');
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
        Schema::dropIfExists('nav_menus');
    }
}
