<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('标题');
            $table->longText('body')->comment('内容');
            $table->string('image')->comment('文章封面图');
            $table->boolean('visible')->default(true);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->integer('view_count')->unsigned()->default(0)->comment('阅读数');
            $table->integer('reply_count')->unsigned()->default(0)->comment('评论数');
            $table->text('excerpt')->nullable()->comment('文章摘要，SEO 优化时使用');
            $table->string('slug')->nullable()->comment('SEO 友好的 URI');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
