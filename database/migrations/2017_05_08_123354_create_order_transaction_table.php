<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->increments('order_transaction_id');
			$table->integer('order_id')->index('idx_order_id')->unsigned();
			$table->foreign('order_id')
				->references('order_id')->on('order')
				->onDelete('cascade');
			$table->integer('order_billing_id')->index('idx_order_billing_id')->unsigned();
			$table->foreign('order_billing_id')
				->references('order_billing_id')->on('order_billing')
				->onDelete('cascade');
			$table->string('payment_method');
			$table->decimal('amount',12,2);
			$table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_transaction');
    }
}
