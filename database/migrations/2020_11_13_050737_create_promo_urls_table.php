<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_plan_id')->unsigned();
            $table->string('promotion_name');
            $table->integer('trail_days')->nullable();
            $table->decimal('monthly_amount', 8, 2)->default(0.00)->nullable();            
            $table->integer('monthly_validity')->nullable();
            $table->decimal('yearly_amount', 8, 2)->default(0.00)->nullable();
            $table->integer('yearly_validity')->nullable();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('promo_urls');
    }
}
