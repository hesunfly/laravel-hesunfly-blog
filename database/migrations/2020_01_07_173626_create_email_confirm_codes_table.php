<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailConfirmCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_confirm_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('key');
            $table->string('code');
            $table->tinyInteger('status', false)->default(-1)->comment('是否已激活 @-1：未激活 @2：已激活');
            $table->timestamps();
            $table->softDeletes();
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_confirm_codes');
    }
}
