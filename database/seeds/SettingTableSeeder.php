<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Title",
			'value' => "AlterNateeve",
			'language_id'=>"1",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Description",
			'value' => "AlterNateeve",
			'language_id'=>"1",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Keywords",
			'value' => "AlterNateeve",
			'language_id'=>"1",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "OG Title",
			'value' => "AlterNateeve",
			'language_id'=>"1",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "OG Description",
			'value' => "AlterNateeve",
			'language_id'=>"1",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);


		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Title",
			'value' => "AlterNateeve",
			'language_id'=>"2",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Description",
			'value' => "AlterNateeve",
			'language_id'=>"2",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "Meta Keywords",
			'value' => "AlterNateeve",
			'language_id'=>"2",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "OG Title",
			'value' => "AlterNateeve",
			'language_id'=>"2",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);

		factory(\App\Models\Setting::class)->create([
			'name' => "OG Description",
			'value' => "AlterNateeve",
			'language_id'=>"2",
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		]);


	}
}
