<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandRequestTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_request_tag', function (Blueprint $table) {
            $table->integer('brand_id')->index('idx_brand_id')->unsigned();
			$table->foreign('brand_id')
				->references('brand_id')->on('brand')
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
        Schema::dropIfExists('brand_request_tag');
    }
}
