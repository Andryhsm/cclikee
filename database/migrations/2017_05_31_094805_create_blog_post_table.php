<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post', function (Blueprint $table) {
            $table->increments('blog_post_id');
			$table->string('english_title');
			$table->string('french_title')->nullable();
			$table->longText('english_article')->nullable();
			$table->longText('french_article')->nullable();
			$table->integer('blog_category_id')->nullable()->index('idx_blog_category_id')->unsigned();
			$table->foreign('blog_category_id')
				->references('blog_category_id')->on('blog_category')
				->onDelete('set null');
			$table->string('banner_image')->nullable();
			$table->integer('created_by')->index('idx_created_by')->nullable()->unsigned();
			$table->foreign('created_by')
				->references('admin_id')->on('admin')
				->onDelete('set null');
			$table->binary('is_active');
			$table->binary('is_popular');
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
        Schema::dropIfExists('blog_post');
    }
}
