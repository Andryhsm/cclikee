<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('blog_category', function (Blueprint $table) {
            $table->increments('blog_category_id');
			$table->string('english_name');
			$table->string('french_name')->nullable();
			$table->binary('is_active');
			$table->integer('created_by')->index('idx_created_by')->nullable()->unsigned();
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
        Schema::dropIfExists('blog_category');
    }
}
