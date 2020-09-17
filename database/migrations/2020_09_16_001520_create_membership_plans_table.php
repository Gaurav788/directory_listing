<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('membership_plans')) {
			Schema::create('membership_plans', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name');
				$table->mediumText('details');
				$table->float('price', 8, 2);
				$table->string('currency');
				$table->string('duration');
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
        Schema::dropIfExists('membership_plans');
    }
}
