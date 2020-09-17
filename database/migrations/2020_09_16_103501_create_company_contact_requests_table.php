<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyContactRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_contact_requests')) {
			Schema::create('company_contact_requests', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('company_id');
				$table->string('user_name');
				$table->string('user_email');
				$table->string('user_mobile');
				$table->mediumText('user_message');
				$table->string('request_type');
				$table->tinyInteger('status');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('company_id')->references('id')->on('users');
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
        Schema::dropIfExists('company_contact_requests');
    }
}
