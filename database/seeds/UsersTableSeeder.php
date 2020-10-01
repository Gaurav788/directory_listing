<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('users')->delete();
        DB::table('users')->insert([
			'role_id' => 1,
			'first_name' => 'Gaurav',
			'last_name' => 'Chauhan',
			'email' => 'admin@gmail.com',
			'password' => bcrypt('pass@dmin'),
			'social_type' => 'Website',
			'social_id' => 0,
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
		]);
    }
}