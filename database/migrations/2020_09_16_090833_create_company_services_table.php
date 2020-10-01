<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_services')) {
			Schema::create('company_services', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('service_id');
				$table->string('platform');
				$table->text('details');
				$table->float('price', 8, 2);
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('company_services');
    }
}
