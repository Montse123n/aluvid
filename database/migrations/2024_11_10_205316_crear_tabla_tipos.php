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
        Schema::create('tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del tipo
            $table->text('descripcion')->nullable(); // Descripción del tipo
            $table->foreignId('sector_id')->constrained('sectores')->onDelete('cascade'); // Relación con sectores
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos');
    }
};
