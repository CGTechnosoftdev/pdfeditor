<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('email_templates', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('title', 255);
    		$table->string('slug', 255);
    		$table->string('subject', 255);
    		$table->text('place_holders')->nullable();
    		$table->text('content')->nullable();
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
    	Schema::dropIfExists('email_templates');
    }
}
