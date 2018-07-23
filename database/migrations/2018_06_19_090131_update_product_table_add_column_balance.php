<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductTableAddColumnBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['sku', 'best_price', 'responsible', 'question_note']);
            $table->string('range')->nullable();  // (Gamme)
            $table->tinyInteger('balance')->nullable(); // (Soldé)
            $table->tinyInteger('discount')->nullable(); // (Réduction)
            $table->decimal('promotional_price', 12, 2)->nullable()->after('original_price'); // (Tarif promotionnel) 
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
