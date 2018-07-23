<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandCategoryToTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_category_to_tag', function (Blueprint $table) {
            $table->integer('brand_category_id')->index('idx_brand_category_id')->unsigned();
			$table->foreign('brand_category_id')
				->references('brand_category_id')->on('brand_category')
				->onDelete('cascade');
			$table->integer('brand_tag_id')->index('idx_brand_tag_id')->unsigned();
			$table->foreign('brand_tag_id')
				->references('brand_tag_id')->on('brand_tag')
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
        Schema::dropIfExists('brand_category_to_tag');
    }
}
