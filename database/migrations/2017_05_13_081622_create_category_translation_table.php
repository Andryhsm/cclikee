<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translation', function (Blueprint $table) {
        	$table->increments('category_translation_id');
            $table->integer('category_id')->index('idx_category_id')->unsigned();
			$table->foreign('category_id')
				->references('category_id')->on('category')
				->onDelete('cascade');
			$table->string('category_name')->nullable();
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
        Schema::dropIfExists('category_translation');
    }
}
