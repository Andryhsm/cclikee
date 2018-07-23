<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_value', function (Blueprint $table) {
            $table->increments('product_attribute_option_id');
			$table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->integer('attribute_id')->index('idx_attribute_id')->unsigned();
			$table->foreign('attribute_id')
				->references('attribute_id')->on('attribute')
				->onDelete('cascade');
			$table->integer('attribute_option_id')->index('idx_attribute_option_id')->unsigned();
			$table->foreign('attribute_option_id')
				->references('attribute_option_id')->on('attribute_option')
				->onDelete('cascade');
			$table->string('option_value')->nullable();
			$table->decimal('price',12,2);
			$table->enum('per_quantity',['0','1'])->default('0');
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
        Schema::dropIfExists('product_attribute_value');
    }
}
