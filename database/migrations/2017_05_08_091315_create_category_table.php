<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('category_id');
			$table->integer('parent_id')->nullable()->index('idx_parent_id');
			$table->binary('is_active');
			$table->string('category_image')->nullable();
			$table->integer('created_by')->index('idx_created_by')->unsigned()->nullable();
			$table->foreign('created_by')
				->references('admin_id')->on('admin')
				->onDelete('set null');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
