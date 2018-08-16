<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('article_id')->comment('文章ID');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->text('content')->comment('评论内容');
            $table->text('reply_content')->nullable()->comment('作者回复内容');
            $table->boolean('is_deleted')->default(false)->comment('用户是否删除');
            $table->boolean('visible')->default(true)->comment('管理员控制是否可见');
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
        Schema::dropIfExists('replies');
    }
}
