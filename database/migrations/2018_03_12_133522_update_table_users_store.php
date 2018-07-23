<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUsersStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_image');
            $table->dropColumn('position');
            $table->dropColumn('social_media_id');
            $table->dropColumn('register_by');
            $table->dropColumn('radius');
            $table->dropColumn('stripe_id');
        });
        Schema::table('store', function (Blueprint $table) {
            $table->dropColumn('registration_number');
            $table->dropColumn('shop_image');
            $table->dropColumn('short_description');
            $table->dropColumn('address2');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->date('created_date');
            $table->string('tva_number');
            $table->string('siret_number');
            $table->string('banque_number');
            $table->string('eban');
            $table->string('bic');            
            $table->string('banque_domicile');
            $table->string('banque_address');
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
