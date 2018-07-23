<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaInProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('product_translation', function (Blueprint $table) {
			$table->string('meta_title')->nullable()->after('description');
		});
		Schema::table('product_translation', function (Blueprint $table) {
			$table->text('meta_description')->nullable()->after('meta_title');
		});
		Schema::table('product_translation', function (Blueprint $table) {
			$table->text('meta_keywords')->nullable()->after('meta_description');
		});
		Schema::table('product_translation', function (Blueprint $table) {
			$table->string('og_title')->nullable()->after('meta_keywords');
		});
		Schema::table('product_translation', function (Blueprint $table) {
			$table->text('og_description')->nullable()->after('og_title');
		});


	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
