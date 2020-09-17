<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('users')) {
			Schema::create('users', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->bigInteger('role_id')->unsigned();
				$table->foreign('role_id')->references('id')->on('roles');
				$table->string('first_name');
				$table->string('last_name');
				$table->string('email')->unique();
				$table->timestamp('email_verified_at')->nullable();
				$table->string('password');
				$table->string('social_type');
				$table->bigInteger('social_id');
				$table->tinyInteger('status');
				$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
