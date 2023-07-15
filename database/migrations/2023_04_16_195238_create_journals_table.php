<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('Previsions_Production')->nullable();
            $table->float('Previsions_Vent')->nullable();
            $table->float('Previsions_ProductionVendue')->nullable();
            $table->float('Realisation_Production')->nullable();
            $table->float('Realisation_Vent')->nullable();
            $table->float('Realisation_ProductionVendue')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->unique(['unit_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
