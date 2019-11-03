<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('gender')->default(0)->comment('性别 @0：未知，@1：男，@2：女');
            $table->string('avatar')->default('');
            $table->string('description')->default('');
            $table->string('homepage')->default('');
            $table->string('realname')->default('');
            $table->string('qq')->default('');
            $table->string('wechat')->default('');
            $table->string('weibo')->default('');
            $table->timestamps();
            $table->softDeletes();
            $table->unique('user_id');
            $table->index('user_id', 'user_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userinfo');
    }
}
