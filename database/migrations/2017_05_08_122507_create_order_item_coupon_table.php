<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_coupon', function (Blueprint $table) {
            $table->integer('order_item_id')->index('idx_order_item_id')->unsigned();
			$table->foreign('order_item_id')
				->references('order_item_id')->on('order_item')
				->onDelete('cascade');
			$table->string('coupon_code');
            $table->decimal('amount',12,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_coupon');
    }
}
