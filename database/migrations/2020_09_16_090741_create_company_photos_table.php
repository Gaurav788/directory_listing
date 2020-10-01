<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_photos')) {
			Schema::create('company_photos', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->binary('photo');
				$table->string('photo_type');
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
        Schema::dropIfExists('company_photos');
    }
}
