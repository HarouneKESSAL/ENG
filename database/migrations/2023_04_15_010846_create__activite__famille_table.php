<?php

use App\Models\Activite;
use App\Models\famille;
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
        Schema::create('_activite__famille', function (Blueprint $table) {
        
            $table->id();
      
            $table->foreignIdFor(famille::class);
            $table->foreignIdFor(Activite::class);
      
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_activite__famille');
    }
};
