<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandToBrandCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_to_brand_category', function (Blueprint $table) {
            $table->integer('brand_id')->index('idx_brand_id')->unsigned();
			$table->foreign('brand_id')
				->references('brand_id')->on('brand')
				->onDelete('cascade');
			$table->integer('brand_category_id')->index('idx_brand_category_id')->unsigned();
			$table->foreign('brand_category_id')
				->references('brand_category_id')->on('brand_category')
				->onDelete('cascade');

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_to_brand_category');
    }
}
