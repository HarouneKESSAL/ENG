<?php

use App\Models\Produit;
use App\Models\Unit;
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
    Schema::create('produit_unit', function (Blueprint $table) {
      $table->id();

      $table->foreignIdFor(Produit::class);
      $table->foreignIdFor(Unit::class);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('produit_unit');
  }
};
