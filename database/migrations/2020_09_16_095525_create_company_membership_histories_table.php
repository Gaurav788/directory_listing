<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyMembershipHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_membership_histories')) {
			Schema::create('company_membership_histories', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->Integer('invoice_id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('membership_plan_id');
				$table->float('price', 8, 2);
				$table->string('price_currency');
				$table->string('duration');
				$table->unsignedBigInteger('payment_method_id');
				$table->string('transaction_id');
				$table->string('transaction_status');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->foreign('membership_plan_id')->references('id')->on('membership_plans');
				$table->foreign('payment_method_id')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('company_membership_histories');
    }
}
