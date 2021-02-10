<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->tinyInteger('timezone')->nullable()->default(1);
            $table->tinyInteger('grant_access')->nullable()->default(0);
            $table->tinyInteger('e_signature_method')->nullable()->default(0);
            $table->tinyInteger('hipaa_compliance')->nullable()->default(0);
            $table->tinyInteger('notification_preference')->nullable()->default(0);
        });
        Schema::create('email_phone_resets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_phone', 50)->nullable();
            $table->integer('users_id')->nullable();
            $table->string('token', 255)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_settings', function ($table) {
            $table->dropColumn('timezone');
            $table->dropColumn('grant_access');
            $table->dropColumn('is_receive_promotions_discount');
            $table->dropColumn('e_signature_method');
        });
        Schema::dropIfExists('email_phone_resets');
    }
}
