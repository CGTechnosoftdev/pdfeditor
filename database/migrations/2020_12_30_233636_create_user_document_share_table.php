<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDocumentShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->tinyInteger('share_method')->comment('1=>Share,2=>LinkToFill,3=>SendForReview');
            $table->tinyInteger('share_type')->comment('1=>Email,2=>Link');
            $table->text('link')->nullable();
            $table->text('security_method')->nullable();
            $table->text('authentication_method')->nullable();
            $table->text('access_privileges')->nullable();
            $table->text('personalize_invitation_data')->nullable();
            $table->text('business_card_data')->nullable();
            $table->text('document_notification')->nullable();
            $table->integer('reminder_duration')->nullable();
            $table->integer('reminder_repeat')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shared_user_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_document_id');
            $table->integer('shared_documents_id');
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('shared_document_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shared_documents_id');
            $table->string('name', 50);
            $table->string('email', 50);
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shared_documents');
        Schema::dropIfExists('shared_user_documents');
        Schema::dropIfExists('shared_document_users');
    }
}
