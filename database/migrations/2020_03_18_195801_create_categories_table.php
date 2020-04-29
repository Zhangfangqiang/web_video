<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')                              ->comment('分类名称');
            $table->string('description')                       ->comment('分类简介');
            $table->unsignedBigInteger('parent_id')->nullable() ->comment('父类id');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->unsignedBigInteger('level')                 ->comment('定义级别');
            $table->string('path')                              ->comment('路径');
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
        Schema::dropIfExists('categories');
    }
}
