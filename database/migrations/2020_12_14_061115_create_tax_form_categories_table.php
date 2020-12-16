<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxFormCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_form_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked');
            $table->foreign('type_id')->references('id')->on('tax_form_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_form_categories');
    }
}
