<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('site_title', 255)->nullable();
            $table->string('date_format', 20)->nullable();
            $table->string('time_format', 20)->nullable();
            $table->string('currency',20)->nullable();
            $table->integer('paging_limit')->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->string('instagram_url', 255)->nullable();
            $table->string('linked_in_url', 255)->nullable();
            $table->string('ios_app_url', 255)->nullable();
            $table->string('android_app_url', 255)->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
