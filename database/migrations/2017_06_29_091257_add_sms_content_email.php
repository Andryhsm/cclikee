<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSmsContentEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('email_template', function (Blueprint $table) {
			$table->dropColumn('template_type');
		});
		Schema::table('email_template_translation', function (Blueprint $table) {
			$table->longText('sms_content')->nullable()->after('content');
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
