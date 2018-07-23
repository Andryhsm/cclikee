<?php

use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\OrderStatus::class)->create([
			'status_name' => "On Going",
			'customer_status' => "In Progress",
			'sort_order' => "1",
			'is_default' => 1,
			'created_by' => null,
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\OrderStatus::class)->create([
			'status_name' => "Completed",
			'customer_status' => "Closed",
			'sort_order' => "2",
			'is_default' => 0,
			'created_by' => null,
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

	}
}
