<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translation', function (Blueprint $table) {
        	$table->increments('product_translation_id');
            $table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->string('product_name')->nullable();
			$table->text('summary')->nullable();
			$table->text('description')->nullable();
			$table->integer('language_id')->index('idx_language_id')->unsigned();
			$table->foreign('language_id')
				->references('language_id')->on('language')
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
        Schema::dropIfExists('product_translation');
    }
}
