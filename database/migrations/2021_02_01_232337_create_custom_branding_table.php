<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomBrandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_brandings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('template_style')->nullable()->default(0)->comment('0=>Upper Left Corner,1=>Left Banner,2=>Top Banner');
            $table->string('company_logo', 50)->nullable();
            $table->integer('users_id')->nullable();
            $table->text('signature')->nullable();
            $table->tinyInteger('is_use_email_template')->default(1)->comment('0=>Not use this template,1=>Use this tempalte');
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
        Schema::dropIfExists('custom_brandings');
    }
}
