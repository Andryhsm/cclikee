<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_translation', function (Blueprint $table) {
        	$table->increments('page_translation_id');
            $table->integer('page_id')->index('idx_page_id')->unsigned();
			$table->foreign('page_id')
				->references('page_id')->on('page')
				->onDelete('cascade');
			$table->string('page_title')->nullable();
			$table->string('content_heading')->nullable();
			$table->text('content')->nullable();
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
        Schema::dropIfExists('page_translation');
    }
}
