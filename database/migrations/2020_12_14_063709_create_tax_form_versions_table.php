<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxFormVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_form_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tax_form_id')->unsigned();
            $table->string('name', 255);
            $table->string('form', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('fillable_printable_status')->default(1)->comment('0=>No,1=>Yes');
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
        Schema::dropIfExists('tax_form_versions');
    }
}
