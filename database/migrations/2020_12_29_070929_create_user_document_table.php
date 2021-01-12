<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('file', 255);
            $table->string('file_thumbnail', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('user_id');
            $table->text('data')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=>File,2=>Template,3=>Folder');
            $table->tinyInteger('encrypted')->default(0)->comment('0=No,1=>Yes');
            $table->tinyInteger('trash')->default(1)->comment('1=>Not Trashed,2=>Trashed');
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
        Schema::dropIfExists('user_documents');
    }
}
