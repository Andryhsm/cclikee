<?php

use Illuminate\Database\Seeder;

class CustomerStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(\App\CustomerStatus::class)->create([
            'status' => 'NoSubscribes'
        ]);

        factory(\App\CustomerStatus::class)->create([
            'status' => 'Subscribes'
        ]);
    }
}
