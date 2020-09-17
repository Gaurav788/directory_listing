<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_reviews')) {
			Schema::create('company_reviews', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('company_id');
				$table->unsignedBigInteger('user_id');
				$table->string('rate_point');
				$table->mediumText('review');
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('company_id')->references('id')->on('users');
				$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('company_reviews');
    }
}
