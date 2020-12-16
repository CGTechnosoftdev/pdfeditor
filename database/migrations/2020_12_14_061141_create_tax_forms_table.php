<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->bigInteger('category_id')->unsigned();
            $table->text('keywords')->nullable();
            $table->bigInteger('latest_version_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
            $table->foreign('category_id')->references('id')->on('tax_form_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_forms');
    }
}
