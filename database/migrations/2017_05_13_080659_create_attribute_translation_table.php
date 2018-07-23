<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_translation', function (Blueprint $table) {
        	$table->increments('attribute_translation_id');
            $table->integer('attribute_id')->index('idx_attribute_id')->unsigned();
			$table->foreign('attribute_id')
				->references('attribute_id')->on('attribute')
				->onDelete('cascade');
			$table->string('attribute_name')->nullable();
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
        Schema::dropIfExists('attribute_translation');
    }
}
