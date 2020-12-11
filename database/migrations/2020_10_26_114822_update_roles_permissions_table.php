<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->tinyInteger('is_deletable')->default(1)->comment('0=>No,1=>Yes')->after('guard_name');
            $table->bigInteger('created_by')->unsigned()->after('is_deletable');
            $table->bigInteger('updated_by')->unsigned()->nullable()->after('created_by');
            $table->tinyInteger('status')->default(1)->comment('0=>inactive,1=>active')->after('updated_at');          
            $table->softDeletes()->after('updated_at');                  
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('module',100)->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('is_deletable');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('module');
        });
    }
}
