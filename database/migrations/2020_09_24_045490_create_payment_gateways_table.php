<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('payment_gateways')) {
			Schema::create('payment_gateways', function (Blueprint $table) {
					$table->bigIncrements('id');
					$table->string('name');
					$table->text('description');
					$table->text('api_key');
					$table->text('secret_key');
					$table->text('sandbox_url');
					$table->text('live_url');
					$table->string('email');
					$table->string('payment_mode');
					$table->tinyInteger('status');
					$table->timestamps();
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
        Schema::dropIfExists('payment_gateways');
    }
}
