<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('order', function (Blueprint $table) {
			$table->dropColumn('server_info');
		});

		DB::statement('ALTER TABLE `order_transaction` DROP COLUMN `order_billing_id`, DROP INDEX `idx_order_billing_id`, DROP FOREIGN KEY `order_transaction_order_billing_id_foreign`');
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
