<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHasContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_has_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')                                                                         ->comment('用户id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->unsignedBigInteger('content_id')                                                                          ->comment('上传文件id');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_has_contents');
    }
}
