<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
			$table->text('server_info')->nullable();
			$table->integer('user_id')->index('idx_user_id')->unsigned()->nullable();
			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('set null');
			$table->timestamp('order_date');
			$table->integer('order_status_id')->index('idx_order_status_id')->unsigned()->nullable();
			$table->decimal('subtotal',12,2);
			$table->decimal('discount',12,2);
			$table->decimal('tax',12,2);
			$table->decimal('total',12,2);
			$table->text('other_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
