<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_replies')) {
			Schema::create('company_replies', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('company_review_id');
				$table->unsignedBigInteger('reply_by');
				$table->unsignedBigInteger('reply_to');
				$table->mediumText('reply');
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('company_review_id')->references('id')->on('company_reviews')->onDelete('cascade');
				$table->foreign('reply_by')->references('id')->on('users');
				$table->foreign('reply_to')->references('id')->on('users');
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
        Schema::dropIfExists('company_replies');
    }
}
