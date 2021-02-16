<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserForPersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fax_number', 15)->nullable();
            $table->string('company_name', 50)->nullable();
            $table->string('company_job_title', 50)->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->integer('countries_id')->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip_code', 15)->nullable();
            $table->string('folder_encript_password', 255)->nullable();
        });


        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('countries_id')->nullable();
            $table->bigInteger('created_by')->unsigned();
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
        Schema::table('users', function ($table) {
            $table->dropColumn('fax_number');
            $table->dropColumn('company_name');
            $table->dropColumn('company_job_title');
            $table->dropColumn('address_line_1');
            $table->dropColumn('address_line_2');
            $table->dropColumn('countary_id');
            $table->dropColumn('states_id');
            $table->dropColumn('city');
            $table->dropColumn('zip_code');
        });

        Schema::dropIfExists('states');
    }
}
