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
            $table->tinyInteger('monthly_amount_type')->default(0)->comment('0=>Default,1=>Custom');
            $table->decimal('monthly_amount', 8, 2)->default(0.00)->nullable();            
            $table->integer('valid_for_months')->nullable();
            $table->tinyInteger('yearly_amount_type')->default(0)->comment('0=>Default,1=>Custom');
            $table->decimal('yearly_amount', 8, 2)->default(0.00)->nullable();
            $table->integer('valid_for_years')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('campaign_source')->nullable();
            $table->string('campaign_medium')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('campaign_term')->nullable();
            $table->string('campaign_content')->nullable();
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
