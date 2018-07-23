<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaBlogPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('blog_post', function (Blueprint $table) {
			$table->string('en_meta_title')->nullable()->after('is_popular');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->string('fr_meta_title')->nullable()->after('en_meta_title');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('en_meta_description')->nullable()->after('fr_meta_title');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('fr_meta_description')->nullable()->after('en_meta_description');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('en_meta_keywords')->nullable()->after('fr_meta_description');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('fr_meta_keywords')->nullable()->after('en_meta_keywords');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->string('en_og_title')->nullable()->after('fr_meta_keywords');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->string('fr_og_title')->nullable()->after('en_og_title');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('en_og_description')->nullable()->after('fr_og_title');
		});
		Schema::table('blog_post', function (Blueprint $table) {
			$table->text('fr_og_description')->nullable()->after('en_og_description');
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
