<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_billing', function (Blueprint $table) {
            $table->increments('order_billing_id');
			$table->integer('order_id')->index('idx_order_id')->unsigned();
			$table->foreign('order_id')
				->references('order_id')->on('order')
				->onDelete('cascade');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('company')->nullable();
			$table->integer('phone')->nullable();
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('city');
			$table->string('zip');
			$table->integer('state_id')->index('idx_state_id')->unsigned();
			$table->integer('country_id')->index('idx_country_id')->unsigned();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_billing');
    }
}
