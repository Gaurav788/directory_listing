<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('company_details')) {
			Schema::create('company_details', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->mediumText('about');
				$table->string('contact_person_mobile');
				$table->string('contact_person_email')->unique();
				$table->string('toll_free_number');
				$table->string('customer_care_number');
				$table->string('google_plus_link');
				$table->string('facebook_link');
				$table->string('twitter_link');
				$table->string('instagram_link');
				$table->tinyInteger('custom_badge');
				$table->string('custom_badge_code');
				$table->string('profile_stats');
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('company_details');
    }
}
