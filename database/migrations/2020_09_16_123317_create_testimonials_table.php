<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('testimonials')) {
			Schema::create('testimonials', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->string('name');
				$table->string('email');
				$table->binary('avtar');
				$table->mediumText('feedback');
				$table->string('url');
				$table->tinyInteger('status');
				$table->timestamps();
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
        Schema::dropIfExists('testimonials');
    }
}
