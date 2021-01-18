<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUspsRequestDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usps_request_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('usps_request_id')->unsigned()->nullable();
            $table->bigInteger('user_document_id')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
            $table->foreign('usps_request_id')->references('id')->on('usps_requests')->onDelete('cascade');
            $table->foreign('user_document_id')->references('id')->on('user_documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usps_request_documents');
    }
}
