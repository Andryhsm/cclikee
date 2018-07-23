<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVideoTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_video', function (Blueprint $table) {
			$table->increments('product_video_id');
			$table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->string('video_title')->nullable();
			$table->string('video_url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_video');
	}
}
