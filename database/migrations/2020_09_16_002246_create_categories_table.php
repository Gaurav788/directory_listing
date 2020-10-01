<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('categories')) {
			Schema::create('categories', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('parent_id');
				$table->string('name');
				$table->text('description');
				$table->tinyInteger('sort_order');
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
        Schema::dropIfExists('categories');
    }
}
