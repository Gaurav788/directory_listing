<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_locations')) {
			Schema::create('company_locations', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->string('address');
				$table->string('city');
				$table->unsignedBigInteger('state_id');
				$table->unsignedBigInteger('country_id');
				$table->string('zipcode');
				$table->string('status');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('state_id')->references('id')->on('states');
				$table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('company_locations');
    }
}
