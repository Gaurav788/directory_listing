<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_tags')) {
			Schema::create('company_tags', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('tag_id');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('company_tags');
    }
}
