<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('order_item', function (Blueprint $table) {
            $table->integer('radius')->nullable();
            $table->string('zip_code');
            $table->integer('brand_id')->nullable();
        });
        DB::statement('ALTER TABLE `order_item` CHANGE `product_sku` `product_sku` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
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
