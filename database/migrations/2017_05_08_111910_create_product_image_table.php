<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_image', function (Blueprint $table) {
			$table->increments('product_image_id');
			$table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->string('image_name');
			$table->integer('sort_order')->nullable();
			$table->string('alt')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_image');
	}
}
