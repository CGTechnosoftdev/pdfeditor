<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUspsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usps_mail_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('usps_requests_id')->nullable();
            $table->tinyInteger('mail_status')->nullable()->comment('0=>Dispatched,1=>On the way,2=>Delivered');;
            $table->text('description')->nullable();
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
        Schema::dropIfExists('usps_mail_status');
    }
}
