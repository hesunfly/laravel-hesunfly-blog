<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_size', 10)->default('15');
            $table->string('admin_page_size', 10)->default('15');
            $table->string('icp_record', 30)->default('');
            $table->string('reward_code_img', 200)->default('');
            $table->string('email', 50)->default('');
            $table->string('github', 30)->default('');
            $table->string('gitee', 30)->default('');
            $table->string('logo_img', 200)->default('');
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
        Schema::dropIfExists('settings');
    }
}
