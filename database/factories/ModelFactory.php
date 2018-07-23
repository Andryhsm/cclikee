<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\UserRole::class, function (Faker\Generator $faker) {
	return [
		'role_name' => $faker->name,
		'note' => $faker->text,
		'created_at' => \Carbon\Carbon::now(),
		'updated_at' => \Carbon\Carbon::now()
	];
});
$factory->define(\App\Models\Language::class, function (Faker\Generator $faker) {
	return [
		'language_name' => $faker->name,
		'language_code' => $faker->languageCode
	];
});

$factory->define(\App\Models\Admin::class, function (Faker\Generator $faker) {
	static $password;
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'email' => $faker->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'is_active' => $faker->boolean,
		'remember_token' => str_random(10),
		'created_by'=>null,
		'created_at' => \Carbon\Carbon::now(),
		'updated_at' => \Carbon\Carbon::now(),
	];
});

$factory->define(\App\Models\Permission::class, function (Faker\Generator $faker) {
	return [
		'module_name' => $faker->name,
		'parent_id' => $faker->randomDigit
	];
});

$factory->define(\App\Models\OrderStatus::class, function (Faker\Generator $faker) {
	return [
		'status_name' => $faker->name,
		'customer_status' => $faker->name,
		'sort_order' => $faker->randomDigit,
		'is_default' => $faker->boolean,
		'created_by' => null,
		'created_at' => \Carbon\Carbon::now(),
		'updated_at' => \Carbon\Carbon::now(),
	];
});

$factory->define(\App\Models\EmailTemplate::class, function (Faker\Generator $faker) {
	return [
		'template_type' => $faker->boolean,
		'template_name' => $faker->name,
		'created_by' => null,
		'created_at' => \Carbon\Carbon::now(),
		'updated_at' => \Carbon\Carbon::now(),
	];
});

$factory->define(\App\Models\Setting::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'value' => $faker->name,
		'language_id'=> $faker->numberBetween(1,2),
		'created_at' => \Carbon\Carbon::now(),
		'updated_at' => \Carbon\Carbon::now(),
	];
});

$factory->define(\App\ProductStatus::class, function(Faker\Generator $faker){
	return [
		'id' => $faker->name,
		'status' => $faker->name
	];
});
  $factory->define(\App\StoreOpeningDay::class, function (Faker\Generator $faker) {
                return [
                    'opening_day_id' => $faker->name,
                    'day_name' => $faker->name
                ];
   });
   $factory->define(\App\Models\ProductStockStatus::class, function (Faker\Generator $faker) {
                return [
                    'product_stock_status_id' => $faker->name,
                    'status_name' => $faker->name
                ];
   });