<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('store_id')->nullable();
			$table->string('sku');
			$table->decimal('original_price',12,2);
			$table->decimal('best_price',12,2);
			$table->binary('is_active');
			$table->integer('attribute_set_id')->index('idx_attribute_set_id')->unsigned();
			$table->foreign('attribute_set_id')
				->references('attribute_set_id')->on('attribute_set')
				->onDelete('restrict');
			$table->integer('created_by')->index('idx_created_by')->nullable()->unsigned();
			$table->foreign('created_by')
				->references('admin_id')->on('admin')
				->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
