<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyActivePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_active_plans')) {
			Schema::create('company_active_plans', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('membership_plan_id');
				$table->tinyInteger('status');
				$table->date('expiry_date');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('membership_plan_id')->references('id')->on('membership_plans');
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
        Schema::dropIfExists('company_active_plans');
    }
}
