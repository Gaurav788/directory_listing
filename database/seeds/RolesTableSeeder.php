<?php

use Illuminate\Database\Seeder;	
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('roles')->delete();
        DB::table('roles')->insert([
			'name' => 'Admin',
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
		]);

		DB::table('roles')->insert([
			'name' => 'User',
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
		]);

		DB::table('roles')->insert([
			'name' => 'Company',
			'status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
		]);
    }
}
