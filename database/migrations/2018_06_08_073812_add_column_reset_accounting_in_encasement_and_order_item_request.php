<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnResetAccountingInEncasementAndOrderItemRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_request', function (Blueprint $table) {
            $table->smallInteger('reset_accounting');
		});
		Schema::table('encasement', function (Blueprint $table) {
            $table->smallInteger('reset_accounting');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
