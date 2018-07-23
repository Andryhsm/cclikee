<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostToTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_to_tag', function (Blueprint $table) {
        	$table->integer('blog_post_id')->index('idx_blog_post_id')->unsigned();
			$table->foreign('blog_post_id')
				->references('blog_post_id')->on('blog_post')
				->onDelete('cascade');
			$table->integer('blog_tag_id')->index('idx_blog_tag_id')->unsigned();
			$table->foreign('blog_tag_id')
				->references('blog_tag_id')->on('blog_tag')
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
        Schema::dropIfExists('blog_post_to_tag');
    }
}
