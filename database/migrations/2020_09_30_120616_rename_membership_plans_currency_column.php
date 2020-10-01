<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMembershipPlansCurrencyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (Schema::hasTable('membership_plans')) {
        Schema::table('membership_plans', function (Blueprint $table) {
            //
			$table->renameColumn('currency', 'currency_id');
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
        Schema::table('membership_plans', function (Blueprint $table) {
            //
			$table->renameColumn('currency_id', 'currency');
        });
    }
}
