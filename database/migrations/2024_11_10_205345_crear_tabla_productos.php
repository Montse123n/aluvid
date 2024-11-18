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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del producto
            $table->text('descripcion')->nullable(); // Descripción del producto
            $table->decimal('precio', 8, 2); // Precio del producto
            $table->string('medidas')->nullable(); // Medidas del producto
            $table->foreignId('tipo_id')->constrained('tipos')->onDelete('cascade'); // Relación con tipos
            $table->string('imagen_url')->nullable(); // URL de la imagen del producto
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
