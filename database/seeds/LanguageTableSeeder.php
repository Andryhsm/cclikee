<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(\App\Models\Language::class)->create([
			'language_name' => 'English',
			'language_code' => 'en'
		]);

		factory(\App\Models\Language::class)->create([
			'language_name' => 'French',
			'language_code' => 'fr'
		]);

	}
}
