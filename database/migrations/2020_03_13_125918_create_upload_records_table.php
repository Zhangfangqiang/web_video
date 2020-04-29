<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('md5','32')->unique()->comment('文件唯一md5');
            $table->string('path')->unique()         ->comment('文件路径');
            $table->unsignedBigInteger('size')       ->comment('文件大小');
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
        Schema::dropIfExists('upload_records');
    }
}
