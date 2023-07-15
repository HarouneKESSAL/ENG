<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->unique(['unit_id', 'date', 'produit_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('journals', function (Blueprint $table) {
        $table->dropUnique(['unit_id', 'date', 'produit_id']);
    });
}
};
