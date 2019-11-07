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
            $table->unsignedInteger('category_id');
            $table->string('title')->default('');
            $table->string('description')->default('');
            $table->string('slug')->default('');
            $table->longText('html_content');
            $table->mediumInteger('sort')->default(0);
            $table->longText('content');
            $table->string('cover_img')->default('');
            $table->tinyInteger('status')->default(-1)->comment('是否发布 @-1:未发布，@1：已发布');
            $table->tinyInteger('comment_status')->default(-1)->comment('是否允许评论 @-1:否，@1：是');
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamp('publish_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('title');
            $table->index('publish_at');
            $table->index('slug');
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
