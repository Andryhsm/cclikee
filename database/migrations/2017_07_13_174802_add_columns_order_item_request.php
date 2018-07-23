<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOrderItemRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('order_item_request', function (Blueprint $table) {
			$table->tinyInteger('available_type')->nullable()->after('is_booked');
			$table->string('available_time')->nullable()->after('available_type');
			$table->string('product_name')->nullable()->after('available_time');
			$table->string('product_link')->nullable()->after('product_name');
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
