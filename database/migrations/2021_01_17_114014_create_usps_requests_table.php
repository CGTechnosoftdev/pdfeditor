<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUspsRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usps_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('from_name');
            $table->string('from_address_line_first');
            $table->string('from_address_line_second');
            $table->string('from_city');
            $table->string('from_state');
            $table->string('from_zip');
            $table->string('to_name');
            $table->string('to_address_line_first');
            $table->string('to_address_line_second');
            $table->string('to_city');
            $table->string('to_state');
            $table->string('to_zip');
            $table->tinyInteger('color_mode_status')->default(0)->comment('0=>No,1=>Yes');
            $table->tinyInteger('delivery_method')->comment('1=>USPS First Class Mail,2=>USPS Certified Mail');
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usps_requests');
    }
}
