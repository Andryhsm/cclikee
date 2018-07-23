<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_option_translation', function (Blueprint $table) {
        	$table->increments('attribute_option_translation_id');
            $table->integer('attribute_option_id')->index('idx_attribute_option_id')->unsigned();
			$table->foreign('attribute_option_id')
				->references('attribute_option_id')->on('attribute_option')
				->onDelete('cascade');
			$table->string('option_name')->nullable();
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
        Schema::dropIfExists('attribute_option_translation');
    }
}
