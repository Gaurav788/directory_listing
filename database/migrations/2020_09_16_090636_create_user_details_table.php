<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('user_details')) {
			Schema::create('user_details', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->string('address');
				$table->string('mobile');
				$table->string('city');
				$table->unsignedBigInteger('state_id');
				$table->unsignedBigInteger('country_id');
				$table->string('zipcode');
				$table->binary('profile_picture');
				$table->tinyInteger('status');
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
        Schema::dropIfExists('user_details');
    }
}
