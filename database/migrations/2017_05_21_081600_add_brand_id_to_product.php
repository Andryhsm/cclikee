<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrandIdToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('product', function (Blueprint $table) {
			$table->integer('brand_id')->after('store_id')->nullable()->unsigned();
			$table->foreign('brand_id')
				->references('brand_id')->on('brand')
				->onDelete('set null');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('product', function (Blueprint $table) {
			$table->dropColumn('brand_id');
		});
    }
}
