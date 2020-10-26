<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('users', function (Blueprint $table) {
    		$table->bigInteger('parent_id')->unsigned()->nullable()->after('name');
    		$table->string('first_name',50)->after('parent_id');
    		$table->string('last_name',50)->after('first_name');
    		$table->string('profile_picture',255)->nullable()->after('last_name');
    		$table->tinyInteger('gender')->default(1)->comment('1=>Male,2=>Female,3=>Other')->after('profile_picture');
    		$table->integer('country_id')->unsigned()->nullable()->after('gender');
    		$table->string('contact_number',15)->nullable()->after('country_id');
    		$table->string('password',255)->nullable()->change();
            $table->bigInteger('created_by')->unsigned()->after('remember_token');
            $table->bigInteger('updated_by')->unsigned()->nullable()->after('created_by');
            $table->tinyInteger('status')->default(1)->comment('0=>Pending,1=>Active,2=>Inactive,3=>Blocked')->after('updated_at');
            $table->softDeletes()->after('updated_at');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
    		$table->dropColumn('name');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('parent_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('profile_picture');
            $table->dropColumn('gender');
            $table->dropColumn('country_id');
            $table->dropColumn('contact_number');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
}
