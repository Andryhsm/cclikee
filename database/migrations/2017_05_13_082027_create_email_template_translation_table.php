<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplateTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template_translation', function (Blueprint $table) {
        	$table->increments('email_template_translation_id');
            $table->integer('email_template_id')->index('idx_email_template_id')->unsigned();
			$table->foreign('email_template_id')
				->references('email_template_id')->on('email_template')
				->onDelete('cascade');
			$table->string('subject')->nullable();
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
        Schema::dropIfExists('email_template_translation');
    }
}
