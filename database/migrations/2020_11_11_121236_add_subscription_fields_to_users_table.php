<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('subscription_status')->default(0)->comment('0=>Inactive,1=>Active,2=>Expired,3=>Trail')->after('password');
            $table->bigInteger('subscription_plan_id')->unsigned()->nullable()->after('subscription_status');
            $table->decimal('subscription_plan_amount', 8, 2)->default(0.00)->nullable()->after('subscription_plan_id');
            $table->tinyInteger('subscription_plan_type')->nullable()->comment('1=>Monthly,2=>Yearly')->after('subscription_plan_amount');
            $table->string('stripe_customer_id', 50)->nullable()->after('subscription_plan_type');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
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
            $table->dropColumn('subscription_status');
            $table->dropColumn('subscription_plan_id');
            $table->dropColumn('subscription_plan_amount');
            $table->dropColumn('subscription_plan_type');
            $table->dropColumn('stripe_customer_id');
        });
    }
}
