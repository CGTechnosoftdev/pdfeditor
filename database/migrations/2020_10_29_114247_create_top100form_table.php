<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTop100formTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top100_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->text('relevent_keywords')->nullable();
            $table->bigInteger('lastest_version_id')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
        });


        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_type', 255)->nullable();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->string('form_file', 255);
            $table->tinyInteger('fillable_printable_status')->default(1)->comment('0=>No,1=>Yes');
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('faq_type', 255)->nullable();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->string('question', 255);
            $table->text('answer');
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
        Schema::dropIfExists('top100_forms');
        Schema::dropIfExists('forms');
        Schema::dropIfExists('faqs');
    }
}
