<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPriceAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_adjustment', function (Blueprint $table) {
            $table->increments('product_price_adjustment_id');
			$table->integer('product_id')->index('idx_product_id')->unsigned();
			$table->foreign('product_id')
				->references('product_id')->on('product')
				->onDelete('cascade');
			$table->decimal('original_price',12,2);
			$table->decimal('best_price',12,2);
			$table->integer('user_id')->index('idx_user_id')->unsigned();
			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('cascade');
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
        Schema::dropIfExists('product_price_adjustment');
    }
}
