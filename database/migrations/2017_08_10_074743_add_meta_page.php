<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('page', function (Blueprint $table) {
			$table->dropColumn('meta_keywords');
			$table->dropColumn('meta_description');
		});

		Schema::table('page_translation', function (Blueprint $table) {
			$table->string('meta_title')->nullable()->after('content');
		});
		Schema::table('page_translation', function (Blueprint $table) {
			$table->text('meta_description')->nullable()->after('meta_title');
		});
		Schema::table('page_translation', function (Blueprint $table) {
			$table->text('meta_keywords')->nullable()->after('meta_description');
		});
		Schema::table('page_translation', function (Blueprint $table) {
			$table->string('og_title')->nullable()->after('meta_keywords');
		});
		Schema::table('page_translation', function (Blueprint $table) {
			$table->text('og_description')->nullable()->after('og_title');
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
