<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSetToAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_set_to_attribute', function (Blueprint $table) {
            $table->integer('attribute_set_id')->unsigned()->index('idx_attribute_set_id');
			$table->foreign('attribute_set_id')
				->references('attribute_set_id')->on('attribute_set')
				->onDelete('cascade');
			$table->integer('attribute_id')->unsigned()->index('idx_attribute_id');
			$table->foreign('attribute_id')
				->references('attribute_id')->on('attribute')
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
        Schema::dropIfExists('attribute_set_to_attribute');
    }
}
