<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductTranslationAddMetaAdvice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_translation', function (Blueprint $table) {
            $table->dropColumn('og_title');
            $table->dropColumn('og_description');
            $table->dropColumn('summary');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('language_id');
            $table->text('meta_advice')->nullable();    
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
