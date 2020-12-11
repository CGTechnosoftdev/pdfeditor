<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_plan_id')->unsigned();
            $table->tinyInteger('subscription_plan_type')->nullable()->comment('1=>Monthly,2=>Yearly');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(0)->comment('0=>Inactive,1=>Active,2=>Expired,3=>Trail,4=>Cancelled');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
}
