<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('states')) {
			Schema::create('states', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('country_id');
				$table->string('name');
				$table->integer('short_code');
				$table->tinyInteger('status');
				$table->timestamps();
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
        Schema::dropIfExists('states');
    }
}
