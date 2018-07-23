<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_option', function (Blueprint $table) {
            $table->increments('attribute_option_id');
            $table->integer('attribute_id')->index('idx_attribute_id')->unsigned();
			$table->foreign('attribute_id')
				->references('attribute_id')->on('attribute')
				->onDelete('cascade');
			$table->string('option_value')->nullable();
			$table->string('sku')->nullable();
			$table->string('color_code');
			$table->integer('sort_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_option');
    }
}
