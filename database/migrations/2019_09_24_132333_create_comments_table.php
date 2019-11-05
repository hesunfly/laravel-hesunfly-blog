<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('comment_user_id');
            $table->text('comment_content');
            $table->text('comment_html_content');
            $table->tinyInteger('status')->default(-1)->comment('状态 @-1 未审核, @1 已审核');
            $table->string('ip_address');
            $table->unsignedInteger('replay_id')->default(0);
            $table->timestamps();
            $table->index('article_id');
            $table->index('comment_user_id');
            $table->index('replay_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
