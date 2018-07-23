<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlogUrlSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `sys_url_rewrite` CHANGE `type` `type` ENUM('1','2','3','4') CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => Category, 2 => Product, 3 => Pages, 4 => Blog'");
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
