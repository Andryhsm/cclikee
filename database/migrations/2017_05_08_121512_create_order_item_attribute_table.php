<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_attribute', function (Blueprint $table) {
            $table->integer('order_item_id')->index('idx_order_item_id')->unsigned();
			$table->foreign('order_item_id')
				->references('order_item_id')->on('order_item')
				->onDelete('cascade');
			$table->integer('attribute_id')->index('idx_attribute_id')->unsigned()->nullable();
			$table->foreign('attribute_id')
				->references('attribute_id')->on('attribute')
				->onDelete('set null');
			$table->string('attribute_label');
            $table->integer('product_attribute_option_id')->index('idx_product_attribute_option_id')->unsigned()->nullable();
			$table->foreign('product_attribute_option_id')
				->references('product_attribute_option_id')->on('product_attribute_value')
				->onDelete('set null');
			$table->string('attribute_name');
			$table->string('attribute_selected_value');
			$table->decimal('attribute_selected_value_price',12,2);
			$table->string('attribute_selected_value_sku');
			$table->integer('attribute_option_id')->index('idx_attribute_option_id')->unsigned()->nullable();
			$table->foreign('attribute_option_id')
				->references('attribute_option_id')->on('attribute_option')
				->onDelete('set null');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_attribute');
    }
}
