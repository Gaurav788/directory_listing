<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_coupons')) {
			Schema::create('company_coupons', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->string('name');
				$table->integer('code');
				$table->string('url_to_buy');
				$table->date('expiry_date');
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('company_coupons');
    }
}
