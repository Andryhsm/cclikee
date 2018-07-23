<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(\App\Models\UserRole::class)->create([
			'role_name' => 'Customer',
			'note' => 'Customer Role',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);

		factory(\App\Models\UserRole::class)->create([
			'role_name' => 'Merchant',
			'note' => 'Merchant Role',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);
	}
}
