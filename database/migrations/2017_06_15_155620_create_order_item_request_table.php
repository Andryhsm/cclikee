<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order_item_request', function (Blueprint $table) {
            $table->increments('order_item_request_id');
            $table->integer('item_id');
            $table->integer('customer_id');
            $table->integer('merchant_id');
            $table->string('message');
            $table->string('is_added_by');
            $table->integer('parent_id');
            $table->integer('is_booked');
            $table->timestamp('created_date');
            $table->timestamp('booked_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
