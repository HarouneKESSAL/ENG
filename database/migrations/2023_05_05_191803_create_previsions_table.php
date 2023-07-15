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
    Schema::create('previsions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('unit_id');
        $table->unsignedBigInteger('produit_id');
        $table->decimal('Previsions_Production', 8, 2);
        $table->decimal('Previsions_Vent', 8, 2);
        $table->decimal('Previsions_ProductionVendue', 8, 2);
        $table->date('date');
        $table->integer('number_of_working_days');
        $table->timestamps();

        $table->foreign('unit_id')->references('id')->on('units');
        $table->foreign('produit_id')->references('id')->on('produits');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('previsions');
}

};
