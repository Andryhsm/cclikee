<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('order_item_id');
            $table->integer('order_id')->index('idx_order_id')->unsigned();
			$table->foreign('order_id')
				->references('order_id')->on('order')
				->onDelete('cascade');
			$table->integer('product_id')->index('idx_product_id')->unsigned()->nullable();
			$table->string('product_name');
			$table->string('product_sku');
			$table->integer('quantity');
			$table->decimal('price',12,2);
			$table->decimal('discount',12,2);
			$table->decimal('final_price',12,2);
			$table->string('attribute_sku')->nullable();
			$table->decimal('attribute_price',12,2);
			$table->decimal('tax',12,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
