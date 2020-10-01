<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('coupon_services')) {
			Schema::create('coupon_services', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('company_coupon_id');
				$table->unsignedBigInteger('service_id');
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('company_coupon_id')->references('id')->on('company_coupons')->onDelete('cascade');
				$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_services');
    }
}
