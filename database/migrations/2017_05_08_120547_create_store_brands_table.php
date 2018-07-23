<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreBrandsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_brands', function (Blueprint $table) {
			$table->integer('store_id')->index('idx_store_id')->unsigned();
			$table->foreign('store_id')
				->references('store_id')->on('store')
				->onDelete('cascade');
			$table->integer('brand_id')->index('idx_brand_id')->unsigned();
			$table->foreign('brand_id')
				->references('brand_id')->on('brand')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('store_brands');
	}
}
