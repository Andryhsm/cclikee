<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists('brand_to_brand_category');
		Schema::dropIfExists('brand_category_to_tag');
		Schema::dropIfExists('brand_category');
		Schema::dropIfExists('brand_request_tag');
		Schema::table('brand', function (Blueprint $table) {
			$table->integer('parent_id')->after('is_active')->nullable();
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
