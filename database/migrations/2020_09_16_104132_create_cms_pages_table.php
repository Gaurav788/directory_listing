<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('cms_pages')) {
			Schema::create('cms_pages', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('title');
				$table->string('slug');
				$table->mediumText('short_description');
				$table->longText('description');
				$table->text('meta_title');
				$table->text('meta_keyword');
				$table->text('meta_content');
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
        Schema::dropIfExists('cms_pages');
    }
}
