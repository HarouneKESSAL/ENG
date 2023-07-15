<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Unit;
use App\Models\Activite;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_activite__unit', function (Blueprint $table) {
          $table->foreignIdFor(Activite::class);
          $table->foreignIdFor(Unit::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_activite__unit');
    }
};
