<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_post', function (Blueprint $table) {
            $table->integer('blog_post_id')->index('idx_blog_post_id')->unsigned();
			$table->foreign('blog_post_id')
				->references('blog_post_id')->on('blog_post')
				->onDelete('cascade');
			$table->integer('related_post_id')->index('idx_related_post_id')->unsigned();
			$table->foreign('related_post_id')
				->references('blog_post_id')->on('blog_post')
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
        Schema::dropIfExists('related_post');
    }
}
