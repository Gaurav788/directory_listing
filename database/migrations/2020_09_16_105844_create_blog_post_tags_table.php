<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('blog_post_tags')) {
			Schema::create('blog_post_tags', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('blog_post_id');
				$table->unsignedBigInteger('tag_id');
				$table->timestamps();
				$table->foreign('blog_post_id')->references('id')->on('blog_posts');
				$table->foreign('tag_id')->references('id')->on('tags');
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
        Schema::dropIfExists('blog_post_tags');
    }
}
