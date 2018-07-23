<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('order_status_history', function (Blueprint $table) {
			$table->increments('order_status_history_id');
			$table->integer('order_id')->index('idx_order_id')->unsigned()->nullable();
			$table->foreign('order_id')
				->references('order_id')->on('order')
				->onDelete('cascade');
			$table->integer('order_item_id')->index('idx_order_item_id')->unsigned()->nullable();
			$table->foreign('order_item_id')
				->references('order_item_id')->on('order_item')
				->onDelete('cascade');
			$table->integer('order_status_id')->index('idx_order_status_id')->unsigned()->nullable();
			$table->foreign('order_status_id')
				->references('order_status_id')->on('order_status')
				->onDelete('set null');
			$table->string('status_name')->nullable();
			$table->text('comments')->nullable();
			$table->integer('user_id')->index('idx_user_id')->unsigned()->nullable();
			$table->foreign('user_id')
				->references('user_id')->on('users')
				->onDelete('set null');
			$table->string('user_name')->nullable();
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
		Schema::dropIfExists('order_status_history');
	}
}
